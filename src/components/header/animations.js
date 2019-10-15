import ScrollMagic from 'scrollmagic';
import TweenMax from 'TweenMax';
import TimelineMax from 'TimelineMax';
import { commonComponents } from '../../common/js/commonComponents';
import { offset } from '../../common/js/helpers';
import 'debug.addIndicators';

let ctrl = null;
let scene = null;
let showAnimation = null;
let hideAnimation = null;

let headerWasContrast = false;

export const prepareForShiftBottomAnim = (nContainer, topOffset, singleHeader = false) => {
  if (!singleHeader) {
    commonComponents.header.nRoot.style.position = 'fixed';
    TweenMax.set(commonComponents.header.nRoot, { yPercent: -100 });
  }
  ctrl = new ScrollMagic.Controller();
  const sectionBox = offset(nContainer);
  headerWasContrast = commonComponents.header.nFindSingle('logo-link').classList.contains('contrast');
  topOffset = topOffset ? topOffset : 0.5 * (sectionBox.bottom - sectionBox.top);
  scene = new ScrollMagic.Scene({
    triggerElement: nContainer,
    triggerHook: 0,
    offset: topOffset,
  })
    .on('enter', () => {
      commonComponents.header.nRoot.style.position = 'fixed';
      if (hideAnimation) {
        hideAnimation.kill();
      }
      commonComponents.header.nRoot.classList.add('header_sticky');
      commonComponents.header.nFindSingle('logo-link').classList.remove('contrast');
      commonComponents.header.menu.switchToNonContrast();
      commonComponents.header.nFindSingle('sandwich-button').classList.remove('contrast');
      showAnimation = TweenMax.fromTo(
        commonComponents.header.nRoot,
        0.5,
        { yPercent: -100 },
        { yPercent: 0, clearProps: 'yPercent', onComplete: () => showAnimation = null },
      );
    })
    .on('leave', () => {
      if (showAnimation) {
        showAnimation.kill();
      }
      hideAnimation = TweenMax.to(
        commonComponents.header.nRoot,
        0.15,
        {
          yPercent: -100, onComplete: () => {
            hideAnimation = null;
            if (singleHeader) {
              commonComponents.header.nRoot.style.removeProperty('transform');
              commonComponents.header.nRoot.style.removeProperty('position');
              commonComponents.header.nRoot.classList.remove('header_sticky');
            }
          },
        },
      );
    })
    .addTo(ctrl);
};

export const destroyShiftBottomAnim = (section, contrastHeader = true) => {
  commonComponents.header.nRoot.classList.remove('header_sticky');
  if (headerWasContrast) {
    commonComponents.header.nFindSingle('logo').classList.add('no-transition');
    if (contrastHeader) {
      commonComponents.header.nFindSingle('logo-link').classList.add('contrast');
    } else {
      commonComponents.header.nFindSingle('logo-link').classList.remove('contrast');
    }
    requestAnimationFrame(() =>
      commonComponents.header.nFindSingle('logo').classList.remove('no-transition'));
    commonComponents.header.menu.nFind('item').forEach(nItem => nItem.classList.add('no-transition'));
    if (contrastHeader) {
      commonComponents.header.menu.switchToContrast();
    } else {
      commonComponents.header.menu.switchToNonContrast();
    }
    requestAnimationFrame(() =>
      commonComponents.header.menu.nFind('item').forEach(nItem => nItem.classList.remove('no-transition')));
  }
  commonComponents.header.nFindSingle('sandwich-button').classList.add('no-transition');
  if (contrastHeader) {
    commonComponents.header.nFindSingle('sandwich-button').classList.add('contrast');
  } else {
    commonComponents.header.nFindSingle('sandwich-button').classList.remove('contrast');
  }
  requestAnimationFrame(() =>
    commonComponents.header.nFindSingle('sandwich-button').classList.remove('no-transition'));
  TweenMax.set(commonComponents.header.nRoot, { clearProps: 'yPercent' });
  commonComponents.header.nRoot.style.removeProperty('position');

  if (hideAnimation) {
    hideAnimation.kill();
  }
  if (hideAnimation) {
    hideAnimation.kill();
  }
  if (showAnimation) {
    showAnimation.kill();
  }
  if (scene) {
    scene.destroy();
  }
  if (ctrl) {
    ctrl.destroy();
  }
};

export const appearAnim = (delayS = 0) => new TimelineMax()
  .delay(delayS)
  .addLabel('start')
  .fromTo(
    commonComponents.header.nFindSingle('logo-link'),
    0.45,
    { autoAlpha: 0 },
    { autoAlpha: 1, clearProps: 'all' },
    'start+=1',
  )
  .fromTo(
    commonComponents.header.nFindSingle('sandwich-button'),
    0.45,
    { autoAlpha: 0 },
    { autoAlpha: 1, clearProps: 'all' },
    'start+=1',
  )
  .fromTo(
    commonComponents.header.nFindSingle('menu'),
    0.45,
    { autoAlpha: 0, yPercent: -175 },
    { autoAlpha: 1, yPercent: 0, clearProps: 'all' },
    'start+=1.2',
  );
