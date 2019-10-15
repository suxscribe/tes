import _ from 'lodash';
import p2 from 'p2/build/p2';
import Component from '../../common/js/component';
import {
  calcDistance,
  offset,
  polarToDecart,
  calcAngleBetween,
  isIE, pickRandomElement
} from '../../common/js/helpers';
import particleImgUrl from './images/particle.png';
import { DEBOUNCE_INTERVAL_MS } from '../../common/js/variables';
import UniversalTilt from 'universal-tilt.js';
import $ from 'jquery';

class ElectroLines extends Component {
  static get STEP_LENGTH() { return 8; }

  static get STEP_COUNT() { return 750; }

  static get FIELD_LINES_COUNT() { return 19; }

  static get FIELD_LINES_WIDTH() { return 2; }

  static get FIELD_LINES_COLOR() { return '175, 250, 254'; }

  static get CHARGE_RADIUS_PX() { return window.innerWidth / 40; }

  static get CHARGE_ALLOWED_AREA_RADIUS_PX() { return window.innerWidth / 250; }

  static get LINES_MIN_POSITION_DIFFERENCE() { return 5; }

  static get CHARGE_FORCE_VALUE() { return 10; }

  static get CHARGE_OPPOSITE_FORCE_FACTOR() { return 40; }

  static get FIXED_TIME_STEP() { return ElectroLines.TIME_BETWEEN_FRAMES_MS / 1000; }

  static get MAX_SUB_STEPS() { return 2; }

  static get CHARGE_OSCILLATION_TIME_OFFSET_MS() { return 1000; }

  static get CANVAS_SIZE_MULTIPLIER() { return 1.3; }

  static get CANVAS_ANGLE_CHANGE_INTERVAL_MS() { return 15000; }

  static get TILT_TRANSITION_S() { return 1; }

  static get CANVAS_ANGLE_CHANGE_MAX_DEG() { return 10; }

  static get CANVAS_INIT_ANGLE_DEG() { return { x: ElectroLines.CANVAS_ANGLE_CHANGE_MAX_DEG, y: 0, } }

  static get LINE_GRADIENT_PERIOD_MS() { return 15000; }

  static get LINE_GRADIENT_TIME_MAX_OFFSET_MS() { return 3000; }

  static get TRESHOLD() { return 15; }

  static get INTERACTIVE_CHARGE_VELOCITY() { return 350; }

  static get TIME_BETWEEN_FRAMES_MS() { return 30; }

  static get CANVAS_ANGLE_KEYFRAMES() {
    return [
      {x: ElectroLines.CANVAS_ANGLE_CHANGE_MAX_DEG, y: 0},
      {x: 0, y: ElectroLines.CANVAS_ANGLE_CHANGE_MAX_DEG},
      {x: -ElectroLines.CANVAS_ANGLE_CHANGE_MAX_DEG, y: 0},
      {x: 0, y: -ElectroLines.CANVAS_ANGLE_CHANGE_MAX_DEG},
    ]
  }

  get nCanvas() {
    if (!this._nCanvas) {
      this._nCanvas = this.nFindSingle('canvas');
    }
    return this._nCanvas;
  }

  constructor(nRoot, parent) {
    super(nRoot, 'electro-lines');
    this.parent = parent;
    this.clickCounter = 0;
    this.pickRandomChargeOnMove = true;
    this.world = new p2.World({
      gravity: [0, 0],
    });
    if (!isIE()) {
      new UniversalTilt(
        this.nFindSingle('canvas-wrapper'),
        {
          speed: 1000,
          max: ElectroLines.CANVAS_ANGLE_CHANGE_MAX_DEG,
          'position-base': 'window',
        }
      );
    }
    this.lastRecalculationTime = null;
    this.lastRedrawTime = null;
    this.recalculateChargesForces = this.recalculateChargesForces.bind(this);
    this.world.on('postStep', this.recalculateChargesForces);
    this.charges = [];
    this.updateCanvasSize();
    const canvasWindowDifference = { width: (this.nCanvas.width - window.innerWidth) / 2, height: (this.nCanvas.height - window.innerHeight) / 2 };
    this.charges = [
      {
        originalPosition: [canvasWindowDifference.width + window.innerWidth * 0.65, canvasWindowDifference.height + window.innerHeight * 0.27],
        value: 1,
      },
      {
        originalPosition: [canvasWindowDifference.width + window.innerWidth * 0.4, canvasWindowDifference.height + window.innerHeight * 0.27],
        value: 1,
      },
      {
        originalPosition: [canvasWindowDifference.width + window.innerWidth * 0.3, canvasWindowDifference.height + window.innerHeight * 0.6],
        value: -1,
      },
      {
        originalPosition: [canvasWindowDifference.width + window.innerWidth * 0.5, canvasWindowDifference.height + window.innerHeight * 0.48],
        value: -1,
      },
    ];
    this.charges = this.charges.map((charge, i) => {
      charge.body = new p2.Body({ mass: 1, position: charge.originalPosition });
      charge.forceAngle = null;
      charge.insideAllowedArea = true;
      charge.lastVelocity = null;
      charge.lastForceChange = null;
      setTimeout(() => {
        charge.forceAngle = Math.random() * Math.PI * 2;
      }, i * ElectroLines.CHARGE_OSCILLATION_TIME_OFFSET_MS);
      this.world.addBody(charge.body);
      return charge;
    });
    this.lines = [];
    this.interactiveCharge = null;
    this.ctx = this.nCanvas.getContext('2d');
    this.nRootRect = this.nRoot.getBoundingClientRect();
    this.nParticleImg = new Image();
    this.nParticleImg.src = particleImgUrl;
    this.updateCanvasSize = _.debounce(this.updateCanvasSize.bind(this), DEBOUNCE_INTERVAL_MS);
    window.addEventListener('resize', this.updateCanvasSize);
    this.runRenderLoop = this.runRenderLoop.bind(this);
    this.onMouseMove = this.onMouseMove.bind(this);
    this.parent.nRoot.addEventListener('mousemove', this.onMouseMove);
    this.onClick = this.onClick.bind(this);
    this.parent.nRoot.addEventListener('click', this.onClick);
    this.canvasOriginalTransformations = 'perspective(1000px)';
    this.canvasCurrentAngle = null;
    this.canvasAngleKeyframes = ElectroLines.CANVAS_ANGLE_KEYFRAMES;
    this.setNewCanvasAngle = this.setNewCanvasAngle.bind(this);
    this.setNewCanvasAngle();
    this.enableCanvasAngleOscillation();
    this._paused = false;
    this.renderLoopIterIndex = 0;
    this.terminated = false;
    this.runRenderLoop();
  }

  runRenderLoop(time) {
    if (this.terminated) {
      return;
    }
    requestAnimationFrame(this.runRenderLoop);
    if (this.paused) {
      return;
    }
    const timeDeltaMs = this.lastRecalculationTime ? time - this.lastRecalculationTime : 0;
    if (timeDeltaMs >= ElectroLines.TIME_BETWEEN_FRAMES_MS || !this.lastRecalculationTime) {
      const now = +new Date();
      this.recalculateCharges(now, timeDeltaMs);
      this.recalculateLines();
      this.recalculateLineGradients(now);
      this.lastRecalculationTime = time;
    }

    const redrawTimeDeltaMs = this.lastRedrawTime ? time - this.lastRedrawTime : 0;
    if (redrawTimeDeltaMs >= 10 || !this.lastRedrawTime) {
      this.redraw();
      this.lastRedrawTime = time;
    }
  }

  enableCanvasAngleOscillation() {
    this.nFindSingle('canvas-wrapper').style.transition =
      `transform ${ElectroLines.CANVAS_ANGLE_CHANGE_INTERVAL_MS / 1000}s linear`;
    this.setNewCanvasAngle();
    this.canvasAngleInterval = setInterval(
      this.setNewCanvasAngle,
      ElectroLines.CANVAS_ANGLE_CHANGE_INTERVAL_MS,
    );
  }

  disableCanvasAngleOscillation() {
    this.nFindSingle('canvas-wrapper').style.transition =
      `transform ${ElectroLines.TILT_TRANSITION_S}s linear`;
    clearInterval(this.canvasAngleInterval);
  }

  setNewCanvasAngle() {
    if (!this.canvasCurrentAngle) {
      this.canvasCurrentAngle = ElectroLines.CANVAS_INIT_ANGLE_DEG;
    } else {
      this.canvasCurrentAngle = this.canvasAngleKeyframes[0];
      this.canvasAngleKeyframes.push(this.canvasAngleKeyframes.shift());
    }

    this.nFindSingle('canvas-wrapper').style.transform =
      `${this.canvasOriginalTransformations} rotateX(${this.canvasCurrentAngle.x}deg) rotateY(${this.canvasCurrentAngle.y}deg)`;
  }

  onMouseMove(e) {
    const iScroll = $.fn.fullpage.test.options.scrollOverflowHandler.iScrollInstances[0];
    this.mousePos = {
      x: e.clientX,
      y: e.clientY - iScroll.y,
    };
    if (!this.interactiveCharge && this.pickRandomChargeOnMove) {
      this.setRandomInteractiveCharge();
      this.disableCanvasAngleOscillation();
      this.pickRandomChargeOnMove = false;
    }
  }

  onClick() {
    if (this.interactiveCharge) {
      this.interactiveCharge.body.velocity[0] = 0;
      this.interactiveCharge.body.velocity[1] = 0;
    }
    this.clickCounter = (this.clickCounter + 1) % (this.charges.length + 1);
    if (this.clickCounter === 0) {
      this.interactiveCharge = null;
    } else if (this.mousePos) {
      this.setRandomInteractiveCharge();
    }
  }

  getMousePosOnCanvas() {
    const rootBox = offset(this.nRoot);
    return {
      x: (this.nCanvas.width - rootBox.width) / 2 + this.mousePos.x,
      y: (this.nCanvas.height - rootBox.height) / 2 + this.mousePos.y,
    };
  }

  setRandomInteractiveCharge() {
    const chargesWithoutCurrent = this.charges.concat();
    chargesWithoutCurrent.splice(this.charges.indexOf(this.interactiveCharge), 1);
    this.interactiveCharge = pickRandomElement(chargesWithoutCurrent);
  }

  updateCanvasSize() {
    const parentBox = offset(this.nRoot);
    const width = (parentBox.right - parentBox.left) * ElectroLines.CANVAS_SIZE_MULTIPLIER;
    const height = (parentBox.bottom - parentBox.top) * ElectroLines.CANVAS_SIZE_MULTIPLIER;
    this.nCanvas.width = width;
    this.nCanvas.height = height;
    this.nCanvas.style.width = `${width}px`;
    this.nCanvas.style.height = `${height}px`;
    const widthFactor = this.prevWindowSize ? this.nCanvas.width / this.prevWindowSize.width : 1;
    const heightFactor = this.prevWindowSize ? this.nCanvas.height / this.prevWindowSize.height : 1;
    this.charges.forEach(charge => {
      charge.originalPosition[0] *= widthFactor;
      charge.originalPosition[1] *= heightFactor;
      charge.body.position[0] = charge.originalPosition[0];
      charge.body.position[1] = charge.originalPosition[1];
    });
    this.prevWindowSize = { width: this.nCanvas.width, height: this.nCanvas.height };
    this.nRootRect = this.nRoot.getBoundingClientRect();
  }

  redraw() {
    this.ctx.clearRect(0, 0, this.nCanvas.width, this.nCanvas.height);
    this.ctx.restore();
    this.redrawLines();
    this.redrawCharges();
  }

  redrawLines() {
    this.lines.forEach((line) => {
      if (line.points.length === 0) {
        return;
      }
      this.ctx.beginPath();
      line.points.forEach((point, i) => {
        if (i === 0) {
          this.ctx.moveTo(point.x, point.y);
        } else {
          this.ctx.lineTo(point.x, point.y);
        }
      });
      this.ctx.lineWidth = ElectroLines.FIELD_LINES_WIDTH;
      if (line.gradientSize === 0) {
        this.ctx.strokeStyle = `${ElectroLines.FIELD_LINES_COLOR}30`;
      } else {
        const gradient = this.ctx.createRadialGradient(
          line.gradient.x,
          line.gradient.y,
          line.gradientSize,
          line.gradient.x,
          line.gradient.y,
          line.gradientSize * 5,
        );
        gradient.addColorStop(0, `rgba(${ElectroLines.FIELD_LINES_COLOR}, 0.75)`);
        gradient.addColorStop(1, `rgba(${ElectroLines.FIELD_LINES_COLOR}, 0.3)`);
        this.ctx.strokeStyle = gradient;
      }
      this.ctx.stroke();
    });
  }

  redrawCharges() {
    this.ctx.globalAlpha = 0.55;
    this.charges.forEach((charge, i) => {
      this.ctx.drawImage(
        this.nParticleImg,
        charge.body.interpolatedPosition[0] - ElectroLines.CHARGE_RADIUS_PX,
        charge.body.interpolatedPosition[1] - ElectroLines.CHARGE_RADIUS_PX,
        ElectroLines.CHARGE_RADIUS_PX * 2,
        ElectroLines.CHARGE_RADIUS_PX * 2,
      );
    });
    this.ctx.globalAlpha = 1;
  }

  recalculateLines() {
    let x = 0.0;
    let y = 0.0;
    let currentLineIndex = 0;
    for (let j = 0; j < this.charges.length; j++) {
      const xa = parseFloat(this.charges[j].body.position[0].toFixed(4));
      const ya = parseFloat(this.charges[j].body.position[1].toFixed(4));
      const sign = this.charges[j].value > 0 ? 1 : -1;
      const nLines = ElectroLines.FIELD_LINES_COUNT * Math.abs(this.charges[j].value);
      for (let a = 0; a < nLines; a++) {
        let removeLine = this.charges[j].value < 0;
        let currentLine = this.lines[currentLineIndex];
        if (currentLine) {
          currentLine.points = [{x: this.charges[j].body.position[0], y: this.charges[j].body.position[1], passedLength: 0 }];
        } else {
          currentLine = {
            particleCreationInProgress: true,
            index: this.lines.length,
            points: [{x: this.charges[j].body.position[0], y: this.charges[j].body.position[1], passedLength: 0 }],
            creationTime: +new Date() + Math.random() * ElectroLines.LINE_GRADIENT_TIME_MAX_OFFSET_MS,
            gradient: { x: 0, y: 0, },
            gradientSize: 0,
          };
          this.lines.push(currentLine);
        }
        x = xa + Math.cos(a / nLines * 2 * Math.PI);
        y = ya + Math.sin(a / nLines * 2 * Math.PI);
        for (let i = 1; i < ElectroLines.STEP_COUNT; i++) {
          const field = this.e([x, y]);
          const stepx = field[0];
          const stepy = field[1];
          const E_mod = Math.sqrt(stepx * stepx + stepy * stepy);

          x += sign * ElectroLines.STEP_LENGTH * stepx / E_mod;
          y += sign * ElectroLines.STEP_LENGTH * stepy / E_mod;
          const newPoint = { x, y };
          const prevPoint = currentLine.points[currentLine.points.length - 1];
          const pointsDistance = calcDistance(prevPoint.x, prevPoint.y, newPoint.x, newPoint.y);
          if (pointsDistance < ElectroLines.LINES_MIN_POSITION_DIFFERENCE ) {
            continue;
          }
          newPoint.passedLength = prevPoint.passedLength
            + calcDistance(prevPoint.x, prevPoint.y, newPoint.x, newPoint.y);
          currentLine.points.push(newPoint);
          if (x > this.nCanvas.width || x < 0) {
            removeLine = false;
            break;
          }
          if (y > this.nCanvas.height || y < 0) {
            removeLine = false;
            break;
          }
          const nearChargeIndex = this.isPointNearCharge(x, y, j);
          if (nearChargeIndex !== -1) {
            newPoint.x = this.charges[nearChargeIndex].body.position[0];
            newPoint.y = this.charges[nearChargeIndex].body.position[1];
            break;
          }
        }
        if (removeLine) {
          currentLine.points = [];
        }
        currentLineIndex++;
      }
    }
  }

  isPointNearCharge(x, y, sourceChargeIndex) {
    let nearChargeIndex = -1;
    this.charges.some((charge, i) => {
      if (i === sourceChargeIndex) {
        return false;
      }
      const isNear = Math.abs(charge.body.position[0] - x) < 10 && Math.abs(charge.body.position[1] - y) < 10;
      if (isNear) {
        nearChargeIndex = i;
      }
    });
    return nearChargeIndex;
  }

  recalculateLineGradients(now) {
    this.lines.forEach(line => {
      if (line.points.length === 0) {
        return;
      }
      const lastPoint = line.points.slice(-1)[0];
      const gradientSpeed = lastPoint.passedLength / ElectroLines.LINE_GRADIENT_PERIOD_MS;
      const gradientOffset =
        ((now - line.creationTime) % ElectroLines.LINE_GRADIENT_PERIOD_MS) * gradientSpeed;
      const nextPointIndex = line.points.findIndex(point => point.passedLength > gradientOffset);
      if (nextPointIndex < 1) {
        return;
      }
      const passedPoint = line.points[nextPointIndex - 1];
      const nextPoint = line.points[nextPointIndex];
      const alpha = calcAngleBetween(nextPoint.x - passedPoint.x, nextPoint.y - passedPoint.y, 1, 0);
      const r = gradientOffset - passedPoint.passedLength;
      const dx = r * Math.cos(alpha);
      const dy = r * Math.sin(alpha);
      line.gradient = { x: passedPoint.x + dx, y: passedPoint.y + dy, };
      const normalizedOffsetGradient = gradientOffset / lastPoint.passedLength;
      line.gradientSize = 50 * Math.abs(Math.sin(normalizedOffsetGradient * Math.PI));
    });
  }

  recalculateCharges(now, timeDeltaMs) {
    this.world.step(ElectroLines.FIXED_TIME_STEP, timeDeltaMs / 1000, ElectroLines.MAX_SUB_STEPS);
    if (this.interactiveCharge) {
      const mousePosOnCanvas = this.getMousePosOnCanvas();
      if (calcDistance(
        mousePosOnCanvas.x,
        mousePosOnCanvas.y,
        this.interactiveCharge.body.interpolatedPosition[0],
        this.interactiveCharge.body.interpolatedPosition[1]) <= ElectroLines.TRESHOLD
      ) {
        this.interactiveCharge.body.velocity[0] = 0;
        this.interactiveCharge.body.velocity[1] = 0;
      } else {
        const velocity = polarToDecart(
          ElectroLines.INTERACTIVE_CHARGE_VELOCITY,
          calcAngleBetween(
            mousePosOnCanvas.x - this.interactiveCharge.body.interpolatedPosition[0],
            mousePosOnCanvas.y - this.interactiveCharge.body.interpolatedPosition[1],
            1,
            0,
          ),
        );
        this.interactiveCharge.body.velocity[0] = velocity.x;
        this.interactiveCharge.body.velocity[1] = velocity.y;
      }
    }
  }

  recalculateChargesForces() {
    this.charges.forEach((charge, i) => {
      if (charge.forceAngle === null) {
        return;
      }
      const distanceToOrigin = calcDistance(
        charge.originalPosition[0],
        charge.originalPosition[1],
        charge.body.position[0],
        charge.body.position[1],
      );
      const insideAllowedArea = distanceToOrigin <= ElectroLines.CHARGE_ALLOWED_AREA_RADIUS_PX;
      let force = { x: 0, y: 0 };
      if (charge !== this.interactiveCharge) {
        if (!insideAllowedArea) {
          charge.forceAngle = calcAngleBetween(
            charge.originalPosition[0] - charge.body.interpolatedPosition[0],
            charge.originalPosition[1] - charge.body.interpolatedPosition[1],
            1,
            0,
          );
        }
        let forceValue = ElectroLines.CHARGE_FORCE_VALUE;
        if (!insideAllowedArea && charge.insideAllowedArea) {
          charge.forceAngle += Math.PI;
          charge.forceAngle %= 2 * Math.PI;
          forceValue = ElectroLines.CHARGE_OPPOSITE_FORCE_FACTOR * ElectroLines.CHARGE_FORCE_VALUE;
        }
        force = polarToDecart(forceValue, charge.forceAngle);
      }
      charge.body.force = [force.x, force.y];
      charge.insideAllowedArea = insideAllowedArea;
    });
  }

  e(position) {
    let Ex = 0.0;
    let Ey = 0.0;
    let sign = 1;
    for (let j = 0; j < this.charges.length; j++) {
      const xdiff = position[0] - this.charges[j].body.position[0];
      const ydiff = position[1] - this.charges[j].body.position[1];

      const distanceSquared = xdiff * xdiff + ydiff * ydiff;
      const distance = Math.sqrt(distanceSquared);

      sign = -sign;

      Ex += this.charges[j].value * xdiff / (distance * distanceSquared);
      Ey += this.charges[j].value * ydiff / (distance * distanceSquared);
    }

    return [Ex, Ey];
  }

  get paused() {
    return this._paused;
  }

  set paused(value) {
    this._paused = value;
    if (!value) {
      this.runRenderLoop();
    }
  }

  destroy() {
    this._paused = true;
    this.world.off('postStep', this.recalculateChargesForces);
    this.parent.nRoot.removeEventListener('onmousemove', this.onMouseMove);
    this.parent.nRoot.removeEventListener('click', this.onClick);
    this.disableCanvasAngleOscillation();
    window.removeEventListener('resize', this.updateCanvasSize);
    this.terminated = true;
  }
}

export default ElectroLines;
