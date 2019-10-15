import getTransition from './transitions';
import Barba from '../../../node_modules/barba.js/dist/barba';
import {
  isFunction,
  isDirectEnter,
  nGetBody,
  nFindComponent,
  innerHeight,
  isIE,
  addLoopLinksPreventer,
  removeLoopLinksPreventer,
  setActiveSection,
  setActiveSubSection, HeightBalancer,
  waitForEvent
} from './helpers';
import initInnerPage from './inner';
import './views';
import { commonComponents, initCommonComponents } from './commonComponents';
import CookieMessage from '../../components/cookie-message/cookie-message';
import { destroyShiftBottomAnim } from '../../components/header/animations';
import { DEBOUNCE_INTERVAL_MS } from './variables';
const bodyScrollLock = require('body-scroll-lock');
const enableBodyScroll = bodyScrollLock.enableBodyScroll;

const GeneralTransition = Barba.BaseTransition.extend({
  start() {
    this.newContainerLoading.then(() => {
      const [sourceNamespace, targetNamespace] = [...document.querySelectorAll('[data-namespace]')].map(node => node.getAttribute('data-namespace'));
      const transition = getTransition(sourceNamespace, targetNamespace);
      if (isFunction(transition)) {
        transition(this);
      } else {
        this.done();
      }
    });
  },
});
Barba.Dispatcher.on('newPageReady', (currentStatus) => {
  enableBodyScroll(document.querySelector('.sandwich-menu'));
  setActiveSection(currentStatus.namespace);
  setActiveSubSection(currentStatus.url);
  if ('scrollRestoration' in window.history) {
    window.history.scrollRestoration = 'manual';
  }
  removeLoopLinksPreventer();
  addLoopLinksPreventer();
  objectFitPolyfill();
  if (isIE()) {
    nGetBody().classList.add('ie');
  }
  if (isDirectEnter()) {
    nGetBody().style.height = `${window.innerHeight}px`;
    initCommonComponents();
    if (currentStatus.namespace === 'index') {
      const indexSection1 = nFindComponent('index-section-1').querySelector('.index-section-1__content > .row');
      const balancer = new HeightBalancer([
        indexSection1,
        commonComponents.preloader.content
      ]);
      commonComponents.preloader.preloading.then(() => {
        return waitForEvent(commonComponents.preloader.nRoot, 'animationend');
      })
        .then(() => {
          balancer.destroy();
        });
    }
  }
  destroyShiftBottomAnim();
  if (currentStatus.namespace !== 'index') {
    initInnerPage();
  }
});

Barba.Dispatcher.on('transitionCompleted', async (currentStatus) => {
  if (history.state) {
    const currentNamespace = Barba.HistoryManager.currentStatus().namespace;
    if (currentNamespace !== 'index' && currentNamespace !== 'solution') {
      window.scrollTo(0, history.state.scrollPos);
    }
  } else {
    window.scrollTo(0, 0);
  }

  // commonComponents.preloader.nRoot.style.height = `${window.innerHeight}px`;
  if (currentStatus.namespace === 'index') {
    nGetBody().classList.remove('page-inner');
  }
  await commonComponents.preloader.preloading;
  commonComponents.cookieMessage = new CookieMessage(nFindComponent('cookie-message'));
});

window.addEventListener('scroll', _.debounce(() => {
  const currentNamespace = Barba.HistoryManager.currentStatus().namespace;
  if (currentNamespace !== 'index' && currentNamespace !== 'solution') {
    history.replaceState({
      scrollPos: document.documentElement.scrollTop,
    }, null);
  }
}, DEBOUNCE_INTERVAL_MS));

Barba.Pjax.getTransition = () => GeneralTransition;
Barba.Prefetch.init();
Barba.Pjax.start({ ignoreFiles: ['pdf', 'doc', 'exe', 'dmg'] });

export default commonComponents;
