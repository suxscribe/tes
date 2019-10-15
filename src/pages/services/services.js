import Barba from 'barba.js';
import { commonComponents } from '../../common/js/commonComponents';
import ServicesInner from '../../components/services-inner/services-inner';
import Competence from '../../components/competence/competence';
import CompetenceMobile from '../../components/competence-mobile/competence-mobile';
import { getDeviceType, nFindComponent, nGetBody } from '../../common/js/helpers';
import Advantages from '../../components/advantages/advantages';
import Feedback from '../../components/feedback/feedback';
import { prepareForShiftBottomAnim, destroyShiftBottomAnim } from '../../components/header/animations';
import ScrollingMobile from '../../components/full-height/scrolling-mobile';

let scrolling;

Barba.BaseView.extend({
  namespace: 'services',
  onEnter: () => {

  },
  async onEnterCompleted() {
    this.servicesInner = new ServicesInner(nFindComponent('services-inner', this.nRoot));
    this.competence = new Competence(nFindComponent('competence', this.nRoot));
    this.competenceMobile = new CompetenceMobile(nFindComponent('competence-mobile', this.nRoot));
    commonComponents.footer.fixToContainerBottom(nGetBody());
    this.advantages = new Advantages(nFindComponent('advantages', this.nRoot));
    this.feedback = new Feedback(nFindComponent('feedback', this.nRoot));
    prepareForShiftBottomAnim(nGetBody(), window.innerHeight / 2, true);
    await commonComponents.preloader.preloading;
    objectFitPolyfill();
    if (getDeviceType() === 'mobile') {
      this.initMobile();
    }
  },
  initMobile() {
    scrolling = new ScrollingMobile();
  },
  onLeave() {
    destroyShiftBottomAnim();
    this.advantages.destroy();
    this.competence.destroy();
    this.competenceMobile.destroy();
    this.servicesInner.destroy();
    this.feedback.destroy();
  },
  onLeaveCompleted: () => {

  },
}).init();
