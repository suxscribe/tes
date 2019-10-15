import Barba from 'barba.js';
import { commonComponents } from '../../common/js/commonComponents';
import {
  getDeviceType,
  isIE,
  nFindComponent,
  nFindComponents,
  nGetBody,
} from '../../common/js/helpers';
import Feedback from '../../components/feedback/feedback';
import { destroyAnim, prepareAnim } from './animations';
import { hide as hideInfoBlock1 } from '../../components/info-block-1/animations';
import { hide as hideSolutionInner } from '../../components/solution-inner/animations';
import InfoBlock1 from '../../components/info-block-1/info-block-1';
import SolutionInner from '../../components/solution-inner/solution-inner';
import PageNavigationController from '../../components/product-tail/page-navigation-controller';
import { prepareForShiftBottomAnim, destroyShiftBottomAnim } from '../../components/header/animations';
import ScrollingMobile from '../../components/full-height/scrolling-mobile';

let scrolling;

Barba.BaseView.extend({
  namespace: 'solutions',
  onEnter: () => {},
  async onEnterCompleted() {
    commonComponents.footer.fixToContainerBottom(nGetBody());
    this.feedback = new Feedback(nFindComponent('feedback'));
    this.infoBlocks1 = nFindComponents('info-block-1')
      .map(nInfoBlock1 => new InfoBlock1(nInfoBlock1));
    this.infoBlocks1.forEach(infoBlock => hideInfoBlock1(infoBlock));
    this.solutionsInner = nFindComponents('solution-inner')
      .map(nSolutionInner => new SolutionInner(nSolutionInner));
    this.solutionsInner.forEach(solutionInner => hideSolutionInner(solutionInner));
    await commonComponents.preloader.preloading;
    if (!isIE()) {
      this.pageNavigationController = new PageNavigationController(nGetBody(), false);
    }
    prepareAnim(this.infoBlocks1, this.solutionsInner);
    prepareForShiftBottomAnim(nGetBody(), window.innerHeight / 2, true);
    if (getDeviceType() === 'mobile') {
      this.initMobile();
    }
  },
  initMobile() {
    scrolling = new ScrollingMobile();
  },
  onLeave() {
    destroyAnim();
    destroyShiftBottomAnim();
    this.infoBlocks1.forEach(infoBlock1 => infoBlock1.destroy());
    this.solutionsInner.forEach(solutionInner => solutionInner.destroy());
    this.feedback.destroy();
    if (!isIE()) {
      this.pageNavigationController.destroy();
    }
  },
  onLeaveCompleted: () => {

  },
}).init();
