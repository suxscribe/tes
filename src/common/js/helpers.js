import Barba from 'barba.js';
import _ from 'lodash';
import Bowser from 'bowser';
import {
  DEBOUNCE_INTERVAL_MS,
  GRID_COLUMNS,
  MOBILE_MIN_WIDTH,
  FHD_WIDTH,
  SCREEN_MD_MIN_PX,
  SCREEN_XL_MIN_PX,
} from './variables';
import { commonComponents } from './commonComponents';
import $ from 'jquery';
import '../../vendor/split-text/js/SplitTextPlugin';
import lineClamp from 'line-clamp';
import { detect } from 'detect-browser';
const browser = detect();

export const offset = (el) => {
  const rect = el.getBoundingClientRect();


  const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;


  const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  const box = {
    top: rect.top + scrollTop,
    left: rect.left + scrollLeft,
    bottom: rect.bottom + scrollTop,
    right: rect.right + scrollLeft,
  };
  box.width = box.right - box.left;
  box.height = box.bottom - box.top;
  return box;
};

export const deviceTypeConfig = {
  forceDevice: null,
};

export const getDeviceType = () => {
  let res = '';
  if (window.matchMedia(`(min-width: ${SCREEN_MD_MIN_PX}px)`).matches) {
    res = 'desktop';
  } else {
    res = 'mobile';
  }
  return deviceTypeConfig.forceDevice === 'mobile'
    || (res === 'mobile' && deviceTypeConfig.forceDevice !== 'desktop' )
    ? 'mobile' : 'desktop';

};

export const getOS = () => {
  switch (browser.os) {
    case 'iOS':
      return 'iOS';
    case 'Android':
      return 'Android';
    case 'Windows Phone':
      return 'Windows Phone';
    default:
      return 'desktop';
  }
};

export const listen = (evtType, handler, env = document) => {
  env.addEventListener(evtType, handler);
};
export const unlisten = (
  evtType,
  handler,
  env = document,
) => env.removeEventListener(evtType, handler);

export const emit = (
  evtType,
  evtData,
  shouldBubble = false,
  env = document,
) => {
  let evt;
  if (typeof CustomEvent === 'function') {
    evt = new CustomEvent(evtType, {
      detail: evtData,
      bubbles: shouldBubble,
    });
  } else {
    evt = document.createEvent('CustomEvent');
    evt.initCustomEvent(evtType, shouldBubble, false, evtData);
  }
  env.dispatchEvent(evt);
};

export const isFunction = obj => !!(obj && obj.constructor && obj.call && obj.apply);

export const delay = ms => new Promise((resolve) => {
  setTimeout(resolve, ms);
});

export const normalizeWheel = (event) => {
  let sX = 0;
  let sY = 0;
  let pX = 0;
  let pY = 0;

  if ('detail' in event) {
    sY = event.detail;
  }
  if ('wheelDelta' in event) {
    sY = -event.wheelDelta / 120;
  }
  if ('wheelDeltaY' in event) {
    sY = -event.wheelDeltaY / 120;
  }
  if ('wheelDeltaX' in event) {
    sX = -event.wheelDeltaX / 120;
  }

  if ('axis' in event && event.axis === event.HORIZONTAL_AXIS) {
    sX = sY;
    sY = 0;
  }

  pX = sX * 10;
  pY = sY * 10;

  if ('deltaY' in event) {
    pY = event.deltaY;
  }
  if ('deltaX' in event) {
    pX = event.deltaX;
  }

  if ((pX || pY) && event.deltaMode) {
    if (event.deltaMode === 1) {
      pX *= 40;
      pY *= 40;
    } else {
      pX *= 800;
      pY *= 800;
    }
  }

  if (pX && !sX) {
    sX = pX < 1 ? -1 : 1;
  }
  if (pY && !sY) {
    sY = pY < 1 ? -1 : 1;
  }

  return {
    spinX: sX,
    spinY: sY,
    pixelX: pX,
    pixelY: pY,
  };
};

export const windowScrollTop = (
) => (window.pageYOffset || document.scrollTop) - (document.clientTop || 0);

export const normalizeKey = (event) => {
  let code;
  if (event.key !== undefined) {
    code = event.key;
  } else if (event.keyIdentifier !== undefined) {
    code = event.keyIdentifier;
  } else if (event.keyCode !== undefined) {
    code = event.keyCode;
  }
  return code;
};

export const setProgress = (fullProgress, count) => {
  const preloaderCounter = document.querySelector('.preloader__counter > .preloader__title-1-text');
  preloaderCounter.innerHTML = Math.floor((count / fullProgress) * 100);
};

export const loadImages = (nImages = [...document.querySelectorAll('img[data-src]')]) => {
  const fullProgress = nImages.length;
  let countProgress = 0;
  const SCALE_IMAGE_URL = '/scale-image.php';
  const MOBILE_IMAGE_WIDTH_PX = 768;
  return Promise.all(
    nImages
      .map(nImage => new Promise((resolve) => {
        if (getDeviceType() === 'mobile' && getOS !== 'desktop') {
          setTimeout(
            () => {
              return resolve();
            },
            2000
          );
        }
        const wrapperResolve = (...args) => {
          countProgress += 1;
          nImage.removeEventListener('load', wrapperResolve);
          nImage.removeEventListener('error', wrapperResolve);
          setProgress(fullProgress, countProgress);
          resolve(...args);
        };
        let imgUrl = nImage.getAttribute('data-src');
        if (getDeviceType() === 'mobile' && getOS() !== 'desktop') {
          if (nImage.hasAttribute('data-src-mobile')) {
            imgUrl = nImage.getAttribute('data-src-mobile');
          } else if (getComputedStyle(nImage).position === 'absolute') {
            const { width, height } = offset(nImage.parentNode);
            imgUrl = `${SCALE_IMAGE_URL}?src=${imgUrl}&width=${width}&height=${height}`;
          } else {
            imgUrl = `${SCALE_IMAGE_URL}?src=${imgUrl}&width=${MOBILE_IMAGE_WIDTH_PX}`;
          }
        }
        nImage.setAttribute('src', imgUrl);
        if (nImage.complete) {
          wrapperResolve();
        } else {
          nImage.addEventListener('load', wrapperResolve);
          nImage.addEventListener('error', wrapperResolve);
        }
      })),
  );
};

export const isDirectEnter = () => Barba.Pjax.History.history.length === 1;

export const nodeFromHTML = (html) => {
  const wrapper = document.createElement('div');
  const trimmedHtml = html.trim();
  wrapper.innerHTML = trimmedHtml;
  return wrapper.firstChild;
};

export const arrNodesFromHTML = (html) => {
    const wrapper = document.createElement('div');
    const trimmedHtml = html.trim();
    wrapper.innerHTML = trimmedHtml;
    return [...wrapper.children];
};

export const getElementWidth = (nElement) => {
  const computedStyle = getComputedStyle(nElement);
  return parseFloat(computedStyle.width);
};

export const innerHeight = (node) => {
  const computedStyle = getComputedStyle(node);
  const elementHeight = node.clientHeight;
  return elementHeight
      - parseFloat(computedStyle.paddingTop)
      - parseFloat(computedStyle.paddingBottom);
};

export const nFindComponents = (
  componentName,
  nContainer = document,
) => [...nContainer.querySelectorAll(`.${componentName}`)];

export const nFindComponent = (
  componentName,
  nContainer = document,
) => nContainer.querySelector(`.${componentName}`);

export const prependChild = (parent, child) => {
  if (parent.children.length === 0) {
    parent.appendChild(child);
  } else {
    parent.insertBefore(child, parent.children[0]);
  }
};

export const nGetBody = () => document.querySelector('body');

export class HeightBalancer {
  constructor(nodes = []) {
    this.nodes = nodes;
    this.destroyed = false;
    this.update();
    this.update = _.debounce(this.update.bind(this), DEBOUNCE_INTERVAL_MS);
    window.addEventListener('resize', this.update);
  }

  addNode(node) {
    this.nodes.push(node);
  }

  update() {
    if (this.desoyed) {
      return;
    }
    const maxHeight = Math.max(...this.nodes.map((node) => {
      node.style.height = 'auto';
      return innerHeight(node);
    }));
    this.nodes.forEach((node) => {
      node.style.height = `${maxHeight}px`;
    });
  }

  destroy() {
    this.desoyed = true;
    window.removeEventListener('resize', this.update);
    this.nodes.forEach((node) => node.style.removeProperty('height'));
  }
}

export const smoothValue = (firstValue, secondValue, firstPoint, secondPoint, dimension) => {
  const sideSize = dimension === 'h'
    ? document.documentElement.clientHeight
    : document.documentElement.clientWidth;
  return firstValue
    + (secondValue - firstValue)
    * (sideSize - firstPoint)
    / (secondPoint - firstPoint);
};

export const calculateGridSideOffset = () => smoothValue(30, 150, MOBILE_MIN_WIDTH, FHD_WIDTH, 'w');

export const calculateColWidth = () => (document.documentElement.clientWidth
  - calculateGridSideOffset() * 2)
  / GRID_COLUMNS;

export const range = length => Array.apply(0, Array(length)).map((value, i) => i);

export const calcDistance = (x1, y1, x2, y2) => (((x2 - x1) ** 2) + ((y2 - y1) ** 2)) ** 0.5;

export const calcAngleBetween = (x1, y1, x2, y2) => {
  let alpha = Math.acos(
    (x1 * x2 + y1 * y2)
    / (
      calcDistance(0, 0, x1, y1)
      * calcDistance(0, 0, x2, y2)
    ),
  );
  if (y1 < 0) {
    alpha *= -1;
  }
  return alpha;
};

export const polarToDecart = (r, alpha) => ({
  x: r * Math.cos(alpha),
  y: r * Math.sin(alpha),
});

export const waitForEvent = (node, eventName) => new Promise((resolve, reject) => {
  node.addEventListener(eventName, resolve);
});

export const clearAnimation = (node) => {
  node.offsetWidth;
};

export const waitForGSAPAnimationEnd = timeline => new Promise((resolve) => {
  timeline.eventCallback('onComplete', resolve);
  timeline.eventCallback('onReverseComplete', resolve);
});

export const isIE = () => {
  const browser = Bowser.getParser(window.navigator.userAgent);
  return browser.parsedResult.browser.name === 'Internet Explorer';
};

export const pickRandomElement = a => {
  return a[Math.floor(a.length * Math.random())];
};

export const offsetSimpleBar = (el) => {
  const rect = el.getBoundingClientRect();
  const scrollLeft = document.querySelector('.simplebar-content').scrollLeft;
  const scrollTop = document.querySelector('.simplebar-content').scrollTop;
  const headerHeight = innerHeight(commonComponents.header.nRoot);
  const box = {
    top: rect.top + scrollTop - headerHeight,
    left: rect.left + scrollLeft,
    bottom: rect.bottom + scrollTop - headerHeight,
    right: rect.right + scrollLeft,
  };
  box.width = box.right - box.left;
  box.height = box.bottom - box.top;
  return box;
};

const preventer = e => {
  if (e.currentTarget.href === window.location.href) {
    e.preventDefault();
    e.stopPropagation();
  }
};

export const addLoopLinksPreventer = () => {
  const nLinks = [...document.querySelectorAll('a[href]')];
  nLinks.forEach(nLink => nLink.addEventListener('click', preventer));
};

export const removeLoopLinksPreventer = () => {
  const nLinks = [...document.querySelectorAll('a[href]')];
  nLinks.forEach(nLink => nLink.removeEventListener('click', preventer));
};

const transitionPreventer = e => {
  e.preventDefault();
  e.stopPropagation();
};

export const addTransitionPeventer = () => {
  const nLinks = [...document.querySelectorAll('a[href]')];
  nLinks.forEach(nLink => nLink.addEventListener('click', transitionPreventer));
};

export const removeTransitionPeventer = () => {
  const nLinks = [...document.querySelectorAll('a[href]')];
  nLinks.forEach(nLink => nLink.removeEventListener('click', transitionPreventer));
};

export const splitToLines = (node, className = '') => {
  node.originalText = node.textContent;
  $(node).splitText({ type: 'lines'});
  const nLines = [...node.querySelectorAll('.split-lines')];
  nLines.forEach(nLine => nLine.classList.add(className));
  const nStyles = document.querySelector('[rel="splitStyle"]');
  // иногда плагин не добавляет style
  if (nStyles) {
    nStyles.parentNode.removeChild(nStyles);
  }
  return nLines;
};


export const splitToLinesDestroy = (node) => {
  node.removeAttribute('id');
  node.classList.remove('isSplit');
  node.innerHTML = node.originalText || node.innerHTML;
  [...document.querySelectorAll('.hiddenText')].forEach(nItem => nItem.parentNode.removeChild(nItem));
};

export class Clamper {
  constructor(node, clampLineCount) {
    this.originalText = node.textContent;
    this.clampLineCount = clampLineCount;
    this.node = node;
    this.clamp();
    this.clamp = _.debounce(this.clamp.bind(this), DEBOUNCE_INTERVAL_MS);
    window.addEventListener('resize', this.clamp);
  }

  clamp() {
    this.node.textContent = this.originalText;
    lineClamp(this.node, this.clampLineCount);
  }

  destroy() {
    window.removeEventListener('resize', this.clamp);
  }
}

export const setActiveSection = (namespace) => {
  let link;
  switch (namespace) {
    case 'solution':
      link = 'solutions';
      break;
    case 'service':
      link = 'services';
      break;
    case 'objectCard':
      link = 'objects';
      break;
    case 'newsCard':
      link = 'news';
      break;
    default:
      link = namespace;
  }

  const navigation = document.querySelector('.header__menu');
  const navigationLinks = [...navigation.querySelectorAll('.menu__item ')];
  const navigationLinkIsActive = navigation.querySelector(`[href="/${link}/"]`);
  navigationLinks.forEach(navigationLink => navigationLink.classList.remove('menu__item_active'));
  if (navigationLinkIsActive) {
    navigationLinkIsActive.classList.add('menu__item_active');
  }

  const sandwich = document.querySelector('.sandwich-menu__list');
  const sandwichLinks = [...sandwich.querySelectorAll('.sandwich-menu__item > .sandwich-menu__link')];
  const sandwichLinkIsActive = sandwich.querySelector(`.sandwich-menu__item > [href="/${link}/"]`);
  sandwichLinks.forEach(sandwichLink => sandwichLink.classList.remove('sandwich-menu__link_active'));
  if (sandwichLinkIsActive) {
    sandwichLinkIsActive.classList.add('sandwich-menu__link_active');
  }
};

export const setActiveSubSection = (url) => {
  const link = url.split(window.location.origin)[1].substring(1);
  const sandwich = document.querySelector('.sandwich-menu__list');
  const sandwichLinks = [...sandwich.querySelectorAll('.sandwich-menu__subitem .sandwich-menu__link')];
  const sandwichLinkIsActive = sandwich.querySelector(`.sandwich-menu__subitem [href="/${link}"]`);
  if (sandwichLinkIsActive) {
    sandwichLinks.forEach(sandwichLink => sandwichLink.classList.remove('sandwich-menu__link_active'));
    sandwichLinkIsActive.classList.add('sandwich-menu__link_active');
  }
};

export class Resize {
  constructor() {
    this.resize();
    this.resize = _.debounce(this.resize.bind(this), DEBOUNCE_INTERVAL_MS);
    window.addEventListener('resize', this.resize);
  }

  resize() {
    emit('deviceType:after-resize');
  }

  destroy() {
    window.removeEventListener('resize', this.resize);
  }
}
