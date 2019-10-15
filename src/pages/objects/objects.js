import Barba from 'barba.js';
import { commonComponents } from '../../common/js/commonComponents';
import Filters from '../../components/filters/filters';
import { getDeviceType, nFindComponent, nGetBody } from '../../common/js/helpers';
import Subscribe from '../../components/subscribe/subscribe';
import EndlessBtn from '../../components/endless-btn/endless-btn';
import { prepareForShiftBottomAnim, destroyShiftBottomAnim } from '../../components/header/animations';
import ScrollingMobile from '../../components/full-height/scrolling-mobile';

let scrolling;

Barba.BaseView.extend({
  namespace: 'objects',
  onEnter() {

  },
  async  onEnterCompleted() {
    prepareForShiftBottomAnim(nGetBody(), window.innerHeight / 2, true);
    await commonComponents.preloader.preloading;
    commonComponents.footer.fixToContainerBottom(nGetBody());

    this.subscribe = new Subscribe(nFindComponent('subscribe', this.nRoot));

    this.filters = new Filters(nFindComponent('filters', this.nRoot), objectFitPolyfill);

    this.endLessBnt = new EndlessBtn(
      nFindComponent('endless-btn', this.nRoot),
      nodes => objectFitPolyfill(nodes.map(node => node.querySelector('img')))
    );
    if (getDeviceType() === 'mobile') {
      this.initMobile();
    }
    objectFitPolyfill();
  },
  initMobile() {
    scrolling = new ScrollingMobile();
  },
  onLeave() {
    destroyShiftBottomAnim();
    this.subscribe.destroy();
    this.endLessBnt.destroy();
  },
  onLeaveCompleted() {

  },
}).init();
