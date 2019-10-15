import Barba from 'barba.js';
import { commonComponents } from '../../common/js/commonComponents';
import { Clamper, getDeviceType, nFindComponent, nGetBody } from '../../common/js/helpers';
import Subscribe from '../../components/subscribe/subscribe';
import NewsSlider from '../../components/news-slider/news-slider';
import EndlessBtn from '../../components/endless-btn/endless-btn';
import { prepareForShiftBottomAnim, destroyShiftBottomAnim } from '../../components/header/animations';
import ScrollingMobile from '../../components/full-height/scrolling-mobile';

let scrolling;

Barba.BaseView.extend({
  namespace: 'news',
  onEnter: () => {

  },
  async onEnterCompleted() {
    commonComponents.footer.fixToContainerBottom(nGetBody());
    this.newsSlider = new NewsSlider(nFindComponent('news-slider', this.nRoot));
    this.subscribe = new Subscribe(nFindComponent('subscribe', this.nRoot));
    this.text = [...document.querySelectorAll('.news-preview__text')];
    this.clampers = this.text.map(nText => new Clamper(nText, 4));
    prepareForShiftBottomAnim(nGetBody(), window.innerHeight / 2, true);
    await commonComponents.preloader.preloading;
    this.endLessBnt = new EndlessBtn(nFindComponent('endless-btn', this.nRoot));
    if (getDeviceType() === 'mobile') {
      this.initMobile();
    }
    objectFitPolyfill();
  },
  initMobile() {
    scrolling = new ScrollingMobile();
  },
  onLeave() {
    this.clampers.forEach(clamper => clamper.destroy());
    destroyShiftBottomAnim();
    this.newsSlider.destroy();
    this.endLessBnt.destroy();
    this.subscribe.destroy();
  },
  onLeaveCompleted: () => {

  },
}).init();
