import Component from '../../common/js/component';

class ValueIncreaser extends Component {
  constructor(nRoot, durationMs) {
    super(nRoot, 'value-increaser');
    this.durationMs = durationMs;
    this.targetValue = +this.nRoot.getAttribute('data-value');
    this.nRoot.innerHTML = '0';
  }

  run() {
    for (let i = 0; i < this.targetValue; i += 1) {
      setTimeout(() => this.nRoot.innerHTML = i + 1, this.durationMs * i);
    }
  }

  reverse() {
    for (let i = 0; i < this.targetValue; i += 1) {
      setTimeout(() => this.nRoot.innerHTML = this.targetValue - i - 1, this.durationMs * i);
    }
  }

  switchToTargetValue() {
    this.nRoot.innerHTML = this.targetValue;
  }

  destroy() {

  }
}

export default ValueIncreaser;
