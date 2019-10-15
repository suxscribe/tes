import Barba from 'barba.js';
import TimelineMax from 'TimelineMax';
import { commonComponents } from '../../common/js/commonComponents';
import IndexSection1 from '../../components/index-section-1/index-section-1';
import IndexSection2 from '../../components/index-section-2/index-section-2';
import IndexSection3 from '../../components/index-section-3/index-section-3';
import {
  nFindComponent,
  waitForGSAPAnimationEnd,
  isIE,
  nGetBody,
  isDirectEnter, addTransitionPeventer, removeTransitionPeventer
} from '../../common/js/helpers';
import Scrolling from '../../components/full-height/scrolling';
import ScrollingMobile from '../../components/full-height/scrolling-mobile';
import {
  appearAnim as appearAnimSec1,
  clearProps as clearPropsSec1,
} from '../../components/index-section-1/animations';
import {
  appearAnim as appearAnimHeader, prepareForShiftBottomAnim, destroyShiftBottomAnim,
} from '../../components/header/animations';
import transitionHandlers from './transitionHandlers';
import {
  prepareForAnim as prepareForAnimSec2,
  initAppearAnim as initAppearAnimSec2,
  rollbackPrepareForAnim as rollbackPrepareForAnimSec2,
  destroyAppearAnim as destroyAppearAnimSec2
} from '../../components/index-section-3/animations';
import { listen, unlisten, getDeviceType, deviceTypeConfig } from '../../common/js/helpers';
import $ from 'jquery';
import { DEBOUNCE_INTERVAL_MS } from '../../common/js/variables';
import _ from 'lodash';
import ProductHead from '../../components/product-head/product-head';
import ProductTail from '../../components/product-tail/product-tail';

let scrolling;
let sections;
const nonFHSectionIndex = 2;

Barba.BaseView.extend({
  namespace: 'index',
  onEnter: () => {
    addTransitionPeventer();
  },
  async onEnterCompleted(sync = false) {
    this.beforeOldContainerRemove = this.beforeOldContainerRemove.bind(this);
    this.afterResize = this.afterResize.bind(this);
    this.onSandwichOpen = this.onSandwichOpen.bind(this);
    this.onSandwichClose = this.onSandwichClose.bind(this);
    commonComponents.header.nFindSingle('logo-link').classList.add('contrast');
    commonComponents.header.menu.switchToContrast();
    commonComponents.header.sandwichButton.switchToContrast();
    commonComponents.header.nFindSingle('phone').classList.add('contrast');
    if (!sync) {
      await commonComponents.preloader.preloading;
    }
    sections = [
      new IndexSection1(nFindComponent('index-section-1')),
      new IndexSection2(nFindComponent('index-section-2')),
      new IndexSection3(nFindComponent('index-section-3')),
    ];
    listen('fullpage:after-resize', this.afterResize);
    this.onResize = this.onResize.bind(this);
    if (getDeviceType() === 'mobile') {
      this.initMobile();
    } else {
      if (sync) {
        this.initDesktop(sync);
      } else {
        await this.initDesktop();
      }
      if (isIE()) {
        // чтобы убрать скролл на втором экране
        scrolling.onResize();
      }
    }
    this.updateSolutionsHeight();
    removeTransitionPeventer();
    this.lastDeviceType = getDeviceType();
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
    if (fromForceDevice === 'desktop') {
      rollbackPrepareForAnimSec2(sections[nonFHSectionIndex]);
    }
    this.onLeave();
    this.beforeOldContainerRemove();
    this.onLeaveCompleted();
    deviceTypeConfig.forceDevice = toForceDevice;
    this.onEnter();
    this.onEnterCompleted(true);
    deviceTypeConfig.forceDevice = null;
  },

  afterResize() {
    const currentDeviceType = getDeviceType();
    if (currentDeviceType !== this.lastDeviceType) {
      this.onResize();
    } else if (getDeviceType() !== 'mobile') {
      // todo: иногда валится эта строка
      objectFitPolyfill(sections[0].nFindSingle('bg'));
      sections[0] = new IndexSection1(nFindComponent('index-section-1'));
      sections[0].valueIncreasers
        .forEach(valueIncreaser => valueIncreaser.switchToTargetValue());
      sections[1] = new IndexSection2(nFindComponent('index-section-2'));
      this.updateSolutionsHeight();
    }
  },

  updateSolutionsHeight() {
    const height = sections[1].nRoot.style.height;
    sections[1].solutions.slides.forEach(slide => {
      slide.nRoot.style.height = height;
    });
  },

  async initDesktop(sync = false) {
    commonComponents.footer.cancelFix();
    commonComponents.callbacks.add('beforeOldContainerRemove', this.beforeOldContainerRemove);
    commonComponents.callbacks.add('onScrollingResize', this.onScrollingResize);
    scrolling = new Scrolling(sections, transitionHandlers, nonFHSectionIndex);
    commonComponents.callbacks.add('sandwich-open', this.onSandwichOpen);
    commonComponents.callbacks.add('sandwich-close', this.onSandwichClose);
    $.fn.fullpage.test.options.keyboardScrolling = false;
    $.fn.fullpage.setAllowScrolling(false);
    if (!history.state) {
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
    } else {
      sections[0].valueIncreasers.forEach(valueIncreaser => valueIncreaser.switchToTargetValue());
      if (history.state.screenIndex === nonFHSectionIndex) {
        sections[history.state.screenIndex].services.enableElectroLines();
      }
    }
    $.fn.fullpage.setAllowScrolling(true);
    $.fn.fullpage.test.options.keyboardScrolling = true;
    commonComponents.header.disableLogo();
    prepareForAnimSec2(sections[nonFHSectionIndex]);
    initAppearAnimSec2(sections[nonFHSectionIndex]);
    objectFitPolyfill();
  },
  initMobile() {
    document.querySelector('.index-section-3__wrapper').appendChild(commonComponents.footer.nRoot);
    commonComponents.footer.nRoot.style.position = 'absolute';
    scrolling = new ScrollingMobile();
    this.onResize = _.debounce(this.onResize, DEBOUNCE_INTERVAL_MS)
    window.addEventListener('resize', this.onResize);
  },

  onScrollingResize() {
    sections[0].destroy();
    sections[1].destroy();
  },

  onLeave() {
    if (getDeviceType() !== 'mobile') {
      $.fn.fullpage.setAllowScrolling(false);
      commonComponents.callbacks.remove('sandwich-open', this.onSandwichOpen);
      commonComponents.callbacks.remove('sandwich-close', this.onSandwichClose);
      commonComponents.callbacks.remove('onScrollingResize', this.onScrollingResize);
      destroyShiftBottomAnim();
      clearPropsSec1(sections[0]);
    } else {
      window.removeEventListener('resize', this.onResize);
      sections.forEach(section => section.destroy());
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
    sections.forEach(section => section.destroy());
    scrolling.destroy();
    commonComponents.callbacks.remove('beforeOldContainerRemove', this.beforeOldContainerRemove);
  },

  onLeaveCompleted: () => {
    if (getDeviceType() !== 'mobile') {
      commonComponents.header.enableLogo();
    }
  },
}).init();
