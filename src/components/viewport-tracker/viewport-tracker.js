import Component from '../../common/js/component';
import ScrollMagic from 'scrollmagic';
import { emit, offset } from '../../common/js/helpers';
import _ from 'lodash';
import { DEBOUNCE_INTERVAL_MS } from '../../common/js/variables';

class ViewportTracker extends Component {
  static get TRASHOLD() { return 5; }

  constructor(nRoot) {
    super(nRoot, 'viewport-tracker');
    this.ctrl = new ScrollMagic.Controller();
    this.topScene = new ScrollMagic.Scene({
      triggerElement: this.nRoot,
      triggerHook: 1,
      offset: ViewportTracker.TRASHOLD,
    })
      .on('enter', () => emit('viewport-tracker:inside', null, false, this.nRoot))
      .on('leave', () => emit('viewport-tracker:outside', null, false, this.nRoot))
      .addTo(this.ctrl);
    this.bottomScene = new ScrollMagic.Scene({
      triggerElement: this.nRoot,
      triggerHook: 0,
    })
      .on('enter', () => emit('viewport-tracker:outside', null, false, this.nRoot))
      .on('leave', () => emit('viewport-tracker:inside', null, false, this.nRoot))
      .addTo(this.ctrl);
    this.updateBottomSceneOffset();
    this.updateBottomSceneOffset = _.debounce(
      this.updateBottomSceneOffset.bind(this),
      DEBOUNCE_INTERVAL_MS,
    );
    window.addEventListener('resize', this.updateBottomSceneOffset);
  }

  updateBottomSceneOffset() {
    const rootHeight = offset(this.nRoot).height;
    this.bottomScene.offset(rootHeight);
  }

  destroy() {
    window.removeEventListener('resize', this.updateBottomSceneOffset);
    this.bottomScene.destroy();
    this.topScene.destroy();
    this.ctrl.destroy();
  }
}

export default ViewportTracker;
