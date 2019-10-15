import Barba from 'barba.js';
import { commonComponents } from '../../common/js/commonComponents';
import { getDeviceType, nFindComponent, nGetBody } from '../../common/js/helpers';
import TrastSlider from '../../components/trust-slider/trust-slider';
import Filters from '../../components/filters/filters';
import CommentPreviewGrid from '../../components/comment-preview-grid/comment-preview-grid';
import EndlessBtn from '../../components/endless-btn/endless-btn';
import { prepareForShiftBottomAnim, destroyShiftBottomAnim } from '../../components/header/animations';
import ScrollingMobile from '../../components/full-height/scrolling-mobile';

let scrolling;

Barba.BaseView.extend({
  namespace: 'trust',
  onEnter() {

  },
  async onEnterCompleted() {
    prepareForShiftBottomAnim(nGetBody(), window.innerHeight / 2, true);
    await commonComponents.preloader.preloading;

    commonComponents.footer.fixToContainerBottom(nGetBody());

    this.TrastSlider = new TrastSlider(nFindComponent('trust-slider', this.nRoot));
    this.commentPrevGrid = new CommentPreviewGrid(nFindComponent('comment-preview-grid', this.nRoot));

    this.filters = new Filters(nFindComponent('filters', this.nRoot), this.commentPrevGrid.CommentPreviewInit);
    this.endLessBnt = new EndlessBtn(nFindComponent('endless-btn', this.nRoot), this.commentPrevGrid.newCommentPreviewInit);
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
    this.TrastSlider.destroy();
    this.endLessBnt.destroy();
    this.commentPrevGrid.destroy();
  },
  onLeaveCompleted() {

  },
}).init();
