import $ from 'jquery';
import Barba from 'barba.js';
import TimelineMax from 'TimelineMax';
import { commonComponents } from '../../common/js/commonComponents';
import ProductHead from '../../components/product-head/product-head';
import ProductTail from '../../components/product-tail/product-tail';
import {
  getDeviceType, isIE,
  nFindComponent,
  nGetBody,
  waitForGSAPAnimationEnd,
  listen,
  unlisten, isDirectEnter, removeTransitionPeventer, deviceTypeConfig,
} from '../../common/js/helpers';
import Scrolling from '../../components/full-height/scrolling';
import {
  appearAnimStart as appearAnimSec1,
} from '../../components/product-head/animations';
import transitionHandlers from './transitionHandlers';
import {
  appearAnim as appearAnimHeader, destroyShiftBottomAnim,
  prepareForShiftBottomAnim,
} from '../../components/header/animations';
import ScrollingMobile from '../../components/full-height/scrolling-mobile';
import PageNavigationController from '../../components/product-tail/page-navigation-controller';
import { rollbackPrepareForAnim as rollbackPrepareForAnimSec2 } from '../../components/index-section-3/animations';
import _ from 'lodash';
import { DEBOUNCE_INTERVAL_MS } from '../../common/js/variables';
import {
  appearAnimTransitRollback,
} from '../../components/product-head/animations';

let sections;
let scrolling;

Barba.BaseView.extend({
  namespace: 'solution',
  onEnter: () => {

  },
  async onEnterCompleted(sync) {
    this.nonFHSectionIndex = 1;
    this.onResize = this.onResize.bind(this);
    this.lastDeviceType = getDeviceType();
    this.beforeOldContainerRemove = this.beforeOldContainerRemove.bind(this);
    this.afterResize = this.afterResize.bind(this);
    this.onSandwichOpen = this.onSandwichOpen.bind(this);
    this.onSandwichClose = this.onSandwichClose.bind(this);
    this.onScrollingResize = this.onScrollingResize.bind(this);
    nGetBody().classList.add('products-page');
    nGetBody().classList.add('page-inner');
    sections = [
      new ProductHead(nFindComponent('product-head')),
      new ProductTail(nFindComponent('product-tail')),
    ];
    if (getDeviceType() === 'mobile') {
      this.initMobile();
    } else {
      this.initDesktop(sync);
    }
    listen('fullpage:after-resize', this.afterResize);
    removeTransitionPeventer();
  },
  async initDesktop(sync = false) {
    commonComponents.callbacks.add('beforeOldContainerRemove', this.beforeOldContainerRemove);
    commonComponents.callbacks.add('onScrollingResize', this.onScrollingResize);
    if (!sync) {
      await commonComponents.preloader.preloading;
    }
    commonComponents.footer.fixToContainerBottom(sections[1].nFindSingle('wrapper'));
    scrolling = new Scrolling(sections, transitionHandlers, this.nonFHSectionIndex);
    commonComponents.callbacks.add('sandwich-open', this.onSandwichOpen);
    commonComponents.callbacks.add('sandwich-close', this.onSandwichClose);
    $.fn.fullpage.setAllowScrolling(false);
    $.fn.fullpage.test.options.keyboardScrolling = false;
    const tll = new TimelineMax();
    if (isDirectEnter()) {
      tll.add(appearAnimHeader(1), -1);
    }
    tll.add(appearAnimSec1(sections[0], -0.3));
    if (sync) {
      waitForGSAPAnimationEnd(tll);
    } else {
      await waitForGSAPAnimationEnd(tll);
    }
    $.fn.fullpage.test.options.keyboardScrolling = true;
    $.fn.fullpage.setAllowScrolling(true);
    scrolling.moveNext(sections[0].nFindSingle('arrow-down'));
    if (!isIE()) {
      this.pageNavigationController = new PageNavigationController(nGetBody(), true);
    }
    objectFitPolyfill();
  },

  onResize() {
    const currentDeviceType = getDeviceType();
    if (currentDeviceType !== this.lastDeviceType) {
      this.reInitView(this.lastDeviceType, currentDeviceType);
    }
    this.lastDeviceType = currentDeviceType;
  },

  reInitView(fromForceDevice, toForceDevice) {
    deviceTypeConfig.forceDevice = fromForceDevice;
    this.onLeave();
    this.beforeOldContainerRemove();
    this.onLeaveCompleted(false);
    deviceTypeConfig.forceDevice = toForceDevice;
    this.onEnter();
    this.onEnterCompleted(true);
    deviceTypeConfig.forceDevice = null;
  },

  onScrollingResize() {
    this.productMapSliderState = sections[1].productSection1.productMap && sections[1].productSection1.productMap.productMapSlider.getState();
    deviceTypeConfig.forceDevice = this.lastDeviceType;
    sections[0].destroy();
    sections[1].destroy();
    deviceTypeConfig.forceDevice = null;
  },

  afterResize() {
    const currentDeviceType = getDeviceType();
    if (currentDeviceType !== this.lastDeviceType) {
      this.onResize();
    } else {
      sections[0] = new ProductHead(nFindComponent('product-head'));
      sections[1] = new ProductTail(nFindComponent('product-tail'));
    }
    if (sections[1].productSection1.productMap && this.productMapSliderState) {
      sections[1].productSection1.productMap.productMapSlider.restoreState(this.productMapSliderState);
    }
  },

  initMobile() {
    appearAnimTransitRollback(sections[0]);
    document.querySelector('.product-tail__wrapper').appendChild(commonComponents.footer.nRoot);
    commonComponents.footer.nRoot.style.position = 'absolute';
    scrolling = new ScrollingMobile();
    window.addEventListener('resize', _.debounce(this.onResize, DEBOUNCE_INTERVAL_MS));
  },

  onLeave() {
    if (getDeviceType() !== 'mobile') {
      $.fn.fullpage.setAllowScrolling(false);
      commonComponents.callbacks.remove('sandwich-open', this.onSandwichOpen);
      commonComponents.callbacks.remove('sandwich-close', this.onSandwichClose);
      commonComponents.callbacks.remove('onScrollingResize', this.onScrollingResize);
      destroyShiftBottomAnim(sections[this.nonFHSectionIndex], false);
    } else {
      window.removeEventListener('resize', _.debounce(this.onResize, DEBOUNCE_INTERVAL_MS));
    }
    unlisten('fullpage:after-resize', this.afterResize);
  },

  onSandwichOpen() {
    $.fn.fullpage.setAllowScrolling(false);
  },

  onSandwichClose() {
    $.fn.fullpage.setAllowScrolling(true);
  },

  beforeOldContainerRemove() {
    commonComponents.footer.cancelFix();
    commonComponents.callbacks.remove('beforeOldContainerRemove', this.beforeOldContainerRemove);
    sections.forEach(section => section.destroy());
    scrolling.destroy();
  },

  onLeaveCompleted(removePageNavigation) {
    if (getDeviceType() !== 'mobile') {
      nGetBody().classList.remove('products-page');
      if (!isIE()) {
        this.pageNavigationController.destroy(removePageNavigation);
      }
    }
  },
}).init();
