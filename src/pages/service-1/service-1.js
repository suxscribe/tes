import Barba from 'barba.js';
import { commonComponents } from '../../common/js/commonComponents';
import { getDeviceType, nFindComponent, nGetBody } from '../../common/js/helpers';
import InfoBlock8 from '../../components/info-block-8/info-block-8';
import Gallery from '../../components/gallery/gallery';
import Competence from '../../components/competence/competence';
import CompetenceMobile from '../../components/competence-mobile/competence-mobile';
import Advantages from '../../components/advantages/advantages';
import Projects from '../../components/projects/projects';
import Feedback from '../../components/feedback/feedback';
import { prepareForShiftBottomAnim, destroyShiftBottomAnim } from '../../components/header/animations';
import ScrollingMobile from '../../components/full-height/scrolling-mobile';

let scrolling;

Barba.BaseView.extend({
  namespace: 'service',
  onEnter: () => {

  },
  async onEnterCompleted() {
    nGetBody().classList.add('service-page');
    if (nFindComponent('info-block-8', this.nRoot)) {
      this.infoBlock8 = new InfoBlock8(nFindComponent('info-block-8', this.nRoot));
    }
    if (nFindComponent('gallery', this.nRoot)) {
      this.gallery = new Gallery(nFindComponent('gallery', this.nRoot));
    }
    if (nFindComponent('competence', this.nRoot)) {
      this.competence = new Competence(nFindComponent('competence', this.nRoot));
    }
    if (nFindComponent('competence-mobile', this.nRoot)) {
      this.competenceMobile = new CompetenceMobile(nFindComponent('competence-mobile', this.nRoot));
    }
    commonComponents.footer.fixToContainerBottom(nGetBody());
    if (nFindComponent('advantages', this.nRoot)) {
      this.advantages = new Advantages(nFindComponent('advantages', this.nRoot));
    }
    if (nFindComponent('projects', this.nRoot)) {
      this.projects = new Projects(nFindComponent('projects', this.nRoot));
    }
    if (nFindComponent('feedback', this.nRoot)) {
      this.feedback = new Feedback(nFindComponent('feedback', this.nRoot));
    }
    prepareForShiftBottomAnim(nGetBody(), window.innerHeight / 2, true);
    await commonComponents.preloader.preloading;
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
    if (this.infoBlock8) {
      this.infoBlock8.destroy();
    }
    if (this.gallery) {
      this.gallery.destroy();
    }
    if (this.competence) {
      this.competence.destroy();
    }
    if (this.competenceMobile) {
      this.competenceMobile.destroy();
    }
    if (this.advantages) {
      this.advantages.destroy();
    }
    if (this.projects) {
      this.projects.destroy();
    }
    if (this.feedback) {
      this.feedback.destroy();
    }
    nGetBody().classList.remove('service-page');
  },
  onLeaveCompleted: () => {

  },
}).init();
