import Barba from 'barba.js';
import { commonComponents } from '../../common/js/commonComponents';
import { getDeviceType, nFindComponent, nGetBody } from '../../common/js/helpers';
import Subscribe from '../../components/subscribe/subscribe';
import InfoBlock8 from '../../components/info-block-8/info-block-8';
import Gallery from '../../components/gallery/gallery';
import VidoBlock from '../../components/video-block/video-block';
import { prepareForShiftBottomAnim, destroyShiftBottomAnim } from '../../components/header/animations';
import ScrollingMobile from '../../components/full-height/scrolling-mobile';
import NewsModalList from '../../components/news-modal-list/news-modal-list';


let scrolling;

Barba.BaseView.extend({
  namespace: 'newsCard',
  onEnter() {
  },
  async onEnterCompleted() {
    prepareForShiftBottomAnim(nGetBody(), window.innerHeight / 2, true);
    await commonComponents.preloader.preloading;

    commonComponents.footer.fixToContainerBottom(nGetBody());

    if (nFindComponent('subscribe', this.nRoot)) {
      this.subscribe = new Subscribe(nFindComponent('subscribe', this.nRoot));
    }

    if (nFindComponent('info-block-8', this.nRoot)) {
      this.infoBlock8 = new InfoBlock8(nFindComponent('info-block-8', this.nRoot));
    }
    if (nFindComponent('gallery', this.nRoot)) {
      this.gallery = new Gallery(nFindComponent('gallery', this.nRoot));
    }
    if (nFindComponent('video-block', this.nRoot)) {
      this.videoBlock = new VidoBlock(nFindComponent('video-block', this.nRoot));
    }
    if(nFindComponent('news-modal-list', this.nRoot)) {
      this.newsModalList = new NewsModalList(nFindComponent('news-modal-list', this.nRoot));
    }

    if (getDeviceType() === 'mobile') {
      this.initMobile();
    }
    objectFitPolyfill();
  },
  initMobile() {
    scrolling = new ScrollingMobile();
  },
  onLeave() {
    if (this.subscribe) {
      this.subscribe.destroy();
    }
    destroyShiftBottomAnim();
    this.subscribe.destroy();
    if (this.gallery) {
      this.gallery.destroy();
    }
    if (this.videoBlock) {
      this.videoBlock.destroy();
    }
    if (this.newsModalList) {
      this.newsModalList.destroy();
    }

  },
  onLeaveCompleted() {

  },
}).init();
