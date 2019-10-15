import $ from 'jquery';
import 'ScrollToPlugin';
import 'debug.addIndicators';
import {
  addTransitionPeventer,
  emit,
  listen, nGetBody,
  removeTransitionPeventer, unlisten,
} from '../../common/js/helpers';
import 'fullpage.js/vendors/scrolloverflow';
import 'fullpage.js';
import { DEBOUNCE_INTERVAL_MS } from '../../common/js/variables';
import { commonComponents } from '../../common/js/commonComponents';
import {
  prepareForShiftBottomAnim as prepareForShiftBottomAnimHeader,
} from '../../components/header/animations';

export default class Scrolling {
  constructor(sections, transitionHandlers, nonFHSectionIndex = sections.length - 1) {
    this.nonFHSectionIndex = nonFHSectionIndex;
    this.disableBeforeHandler = false;
    this.silentMoveRequested = false;
    this.sections = sections;
    this.transitionHandlers = transitionHandlers;
    this.refreshIscroll = this.refreshIscroll.bind(this);
    this.onBefore = this.onBefore.bind(this);
    this.onResize = _.debounce(this.onResize.bind(this), DEBOUNCE_INTERVAL_MS);
    this.onKeydown = this.onKeydown.bind(this);
    this.fullpage = $('.barba-container').fullpage({
      licenseKey: 'OPEN-SOURCE-GPLV3-LICENSE',
      scrollOverflow: true,
      lazyLoading: false,
      onLeave: this.onBefore,
      afterResize: this.onResize,
      fixedElements: '.page-navigation, .map-modal',
      scrollingSpeed: 0,
      scrollOverflowOptions: {
        preventDefault: false,
      },
    });
    this.saveScrollState = this.saveScrollState.bind(this);
    this.iScroll = $.fn.fullpage.test.options.scrollOverflowHandler.iScrollInstances[0];
    this.iScroll.on('scrollEnd', this.saveScrollState);
    listen('scrolling:request-iscroll-refresh', this.refreshIscroll);
    window.addEventListener('resize', this.onResize);
    this.restoreScrollState();
  }

  async restoreScrollState() {
    const scrollState = history.state;
    this.noAnimation = true;
    if (scrollState) {
      $.fn.fullpage.silentMoveTo(scrollState.screenIndex + 1 || 1);
      if (scrollState.scrollPos !== 0) {
        this.iScroll.scrollTo(0, scrollState.scrollPos);
      }
      if (scrollState.screenIndex === this.nonFHSectionIndex) {
        const nonFHSection = this.sections[this.nonFHSectionIndex];
        commonComponents.footer.fixToContainerBottom(nonFHSection.nFindSingle('wrapper'));
        prepareForShiftBottomAnimHeader(nonFHSection.firstSection.nRoot);
      }
    }
    this.noAnimation = false;
  }

  onResize() {
    commonComponents.callbacks.call('onScrollingResize');
    nGetBody().classList.add('hide-video');
    $.fn.fullpage.reBuild();
    nGetBody().classList.remove('hide-video');
    requestAnimationFrame(() => {
      emit('fullpage:after-resize');
    });
  }

  refreshIscroll() {
    this.iScroll.refresh();
  }

  moveNext(link) {
    link.addEventListener('click', $.fn.fullpage.moveSectionDown);
  }

  onBefore(origin, destination, direction) {
    if (this.noAnimation) {
      return;
    }
    if (this.silentMoveRequested) {
      this.silentMoveRequested = false;
      return true;
    }
    if (this.disableBeforeHandler) {
      return false;
    }
    if (destination.index === this.nonFHSectionIndex) {
      $.fn.fullpage.test.options.keyboardScrolling = false;
      document.addEventListener('keydown', this.onKeydown);
    } else if (origin.index === this.nonFHSectionIndex) {
      $.fn.fullpage.test.options.keyboardScrolling = true;
      document.removeEventListener('keydown', this.onKeydown);
    }
    const beforeHandler = this.transitionHandlers.before[destination.index];
    if (beforeHandler) {
      const animationPromise = beforeHandler(this, origin.index, destination.index);
      this.disableBeforeHandler = true;
      addTransitionPeventer();
      animationPromise.then(async () => {
        this.silentMoveRequested = true;
        $.fn.fullpage.silentMoveTo(destination.index + 1);
        const afterHandler = this.transitionHandlers.after[destination.index];
        if (afterHandler) {
          await afterHandler(this, origin, destination.index);
        }
        this.disableBeforeHandler = false;
        this.saveScrollState();
        removeTransitionPeventer();
      });
      return false;
    }
  }

  onKeydown(e) {
    if (e.keyCode === 38) {
      if (this.iScroll.y + 50 >= 0) {
        this.iScroll.scrollTo(0, 0);
        $.fn.fullpage.moveTo(this.nonFHSectionIndex);
      } else {
        this.iScroll.scrollBy(0, 50);
      }
    } else if (e.keyCode === 40) {
      if (this.iScroll.y - 50 < this.iScroll.maxScrollY) {
        this.iScroll.scrollTo(0, this.iScroll.maxScrollY);
      } else {
        this.iScroll.scrollBy(0, -50);
      }
    }
  }

  saveScrollState() {
    history.replaceState({
      screenIndex: $.fn.fullpage.getActiveSection().index,
      scrollPos: this.iScroll.y,
    }, null);
  }

  destroy() {
    this.iScroll.off('scrollEnd', this.saveScrollState);
    unlisten('scrolling:request-fullpage-refresh', this.refreshIscroll);
    window.removeEventListener('resize', this.onResize);
    document.removeEventListener('keydown', this.onKeydown);
    if (this.scene) {
      this.scene.destroy();
    }
    if (this.ctrl) {
      this.ctrl.destroy();
    }
    $.fn.fullpage.test.options.scrollOverflowHandler.iScrollInstances[0].destroy();
    $.fn.fullpage.test.options.scrollOverflowHandler.iScrollInstances = [];
    $.fn.fullpage.destroy('all');
  }
}
