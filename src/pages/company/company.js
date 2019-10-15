import Barba from 'barba.js';
import { commonComponents } from '../../common/js/commonComponents';
import { getDeviceType, isIE, nFindComponent, nGetBody } from '../../common/js/helpers';
import InfoBlock8 from '../../components/info-block-8/info-block-8';
import VideoSlider from '../../components/video-slider/video-slider';
import Competence from '../../components/competence/competence';
import CompetenceMobile from '../../components/competence-mobile/competence-mobile';
import Advantages from '../../components/advantages/advantages';
import Partners from '../../components/partners/partners';
import PageNavigationController from '../../components/product-tail/page-navigation-controller';
import { prepareForShiftBottomAnim, destroyShiftBottomAnim } from '../../components/header/animations';
import ScrollingMobile from '../../components/full-height/scrolling-mobile';

let scrolling;

Barba.BaseView.extend({
  namespace: 'company',
  onEnter: () => {

  },
  async onEnterCompleted() {
    nGetBody().classList.add('service-page');
    this.infoBlock8 = new InfoBlock8(nFindComponent('info-block-8', this.nRoot));
    this.videoSlider = new VideoSlider(nFindComponent('video-slider', this.nRoot));
    this.competence = new Competence(nFindComponent('competence', this.nRoot));
    this.competenceMobile = new CompetenceMobile(nFindComponent('competence-mobile', this.nRoot));
    commonComponents.footer.fixToContainerBottom(nGetBody());
    this.advantages = new Advantages(nFindComponent('advantages', this.nRoot));
    this.partners = new Partners(nFindComponent('partners', this.nRoot));
    await commonComponents.preloader.preloading;
    if (!isIE()) {
      this.pageNavigationController = new PageNavigationController(nGetBody(), false);
    }
    prepareForShiftBottomAnim(nGetBody(), window.innerHeight / 2, true);
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
    this.competence.destroy();
    this.competenceMobile.destroy();
    this.partners.destroy();
    this.advantages.destroy();
    if (!isIE()) {
      this.pageNavigationController.destroy();
    }
    nGetBody().classList.remove('service-page');
  },
  onLeaveCompleted: () => {

  },
}).init();
