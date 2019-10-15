import Barba from 'barba.js';
import { commonComponents } from '../../common/js/commonComponents';
import CompanyList from '../../components/company-list/company-list';
import { getDeviceType, nFindComponent, nFindComponents, nGetBody } from '../../common/js/helpers';
import Clock from '../../components/clock/clock';
import { prepareForShiftBottomAnim, destroyShiftBottomAnim } from '../../components/header/animations';
import Feedback from '../../components/feedback/feedback';
import ScrollingMobile from '../../components/full-height/scrolling-mobile';

let scrolling;

Barba.BaseView.extend({
  namespace: 'contacts',
  onEnter: () => {

  },
  async onEnterCompleted() {
    this.companyLists = nFindComponents('company-list').map(nComp => new CompanyList(nComp));
    this.clock = new Clock(nFindComponent('clock'));
    commonComponents.footer.fixToContainerBottom(nGetBody());
    prepareForShiftBottomAnim(nGetBody(), window.innerHeight / 2, true);
    this.feedback = new Feedback(nFindComponent('feedback'));
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
    this.feedback.destroy();
    destroyShiftBottomAnim();
    this.clock.destroy();
    this.companyLists.forEach(item => item.destroy());
  },
  onLeaveCompleted: () => {

  },
}).init();
