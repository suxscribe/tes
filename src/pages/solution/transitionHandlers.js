import TweenMax from 'TweenMax';
import { commonComponents } from '../../common/js/commonComponents';
import {
  appearAnimTransit as transitAnimSec1,
} from '../../components/product-head/animations';
import {
  appearAnimTransit as transitAnimSec2,
} from '../../components/product-section-1/animations';
import { HEIGHT_PRODUCT_HEAD_MAX, SCREEN_MD_MAX_PX } from '../../common/js/variables';
import { nGetBody, prependChild, waitForGSAPAnimationEnd, delay } from '../../common/js/helpers';
import {
  destroyShiftBottomAnim as destroyShiftBottomAnimHeader,
  prepareForShiftBottomAnim as prepareForShiftBottomAnimHeader,
} from '../../components/header/animations';

const before = {
  0: async (scrolling, prevSlideIndex, currentSlideIndex) => {
    const section1 = scrolling.sections[1];
    destroyShiftBottomAnimHeader(section1.nRoot, false);
    if (matchMedia(`(max-width: ${SCREEN_MD_MAX_PX}px)`).matches) {
      return false;
    }
    const section1Product = scrolling.sections[1].productSection1;
    TweenMax.set(scrolling.sections[0].nFind('bottom'), { autoAlpha: 1 });
    try {
      await waitForGSAPAnimationEnd(transitAnimSec2(section1Product).reverse(0).timeScale(1));
    } catch (e) {}
  },
  1: async (scrolling, prevSlideIndex, currentSlideIndex) => {
    if (matchMedia(`(max-width: ${SCREEN_MD_MAX_PX}px)`).matches) {
      return false;
    }
    const section0 = scrolling.sections[0];
    const appearAnimSec1Inst = transitAnimSec1(section0);
    appearAnimSec1Inst.timeScale(1);
    TweenMax.set(section0.nFind('bottom'), { className: '+=product-head__bottom_fixed' });
    TweenMax.set(section0.nFind('content'), { paddingBottom: '29.5vh' });
    await waitForGSAPAnimationEnd(appearAnimSec1Inst);
  },
};

const after = {
  0: async (scrolling, prevSlideIndex, currentSlideIndex) => {
    prependChild(nGetBody(), commonComponents.header.nRoot);
    commonComponents.header.nRoot.style.position = 'fixed';
    if (matchMedia(`(max-width: ${SCREEN_MD_MAX_PX}px)`).matches) {
      return false;
    }
    const section0 = scrolling.sections[0];
    await waitForGSAPAnimationEnd(transitAnimSec1(section0).reverse(0).timeScale(1));
    TweenMax.set(section0.nFind('bottom'), { className: '-=product-head__bottom_fixed' });
    TweenMax.set(section0.nFind('content'), { paddingBottom: 0 });
  },
  1: async (scrolling, prevSlideIndex, currentSlideIndex) => {
    const section1 = scrolling.sections[1];
    prepareForShiftBottomAnimHeader(section1.productSection1.nRoot);
    objectFitPolyfill(section1.productSection1.nFindSingle('img'));
    prependChild(nGetBody(), commonComponents.header.nRoot);
    commonComponents.header.nRoot.style.position = 'fixed';
    if (matchMedia(`(max-width: ${SCREEN_MD_MAX_PX}px)`).matches) {
      return false;
    }
    TweenMax.set(scrolling.sections[0].nFind('bottom'), { autoAlpha: 0 });
    const section1Product = scrolling.sections[1].productSection1;
    try {
      await waitForGSAPAnimationEnd(transitAnimSec2(section1Product));
    } catch (e) {}
  },
};

export default {
  before,
  after,
};
