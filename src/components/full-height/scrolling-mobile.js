import { commonComponents } from '../../common/js/commonComponents';
import ScrollMagic from 'scrollmagic';
import { nGetBody } from '../../common/js/helpers';

export default class ScrollingMobile {
  constructor() {
    this.ctrl = new ScrollMagic.Controller();
    this.scene = new ScrollMagic.Scene({
      triggerHook: 0,
      offset: 1,
    })
      .on('leave', () => {
        commonComponents.header.nRoot.classList.remove('header_sticky-mobile');
        if (!(nGetBody().classList.contains('page-inner'))) {
          commonComponents.header.nFindSingle('logo-link').classList.add('contrast');
          commonComponents.header.menu.switchToContrast();
          commonComponents.header.sandwichButton.switchToContrast();
          commonComponents.header.nFindSingle('phone').classList.add('contrast');
        }
      })
      .on('enter', () => {
        commonComponents.header.nRoot.classList.add('header_sticky-mobile');
        if (!(nGetBody().classList.contains('page-inner'))) {
          commonComponents.header.nFindSingle('logo-link').classList.remove('contrast');
          commonComponents.header.menu.switchToNonContrast();
          commonComponents.header.sandwichButton.switchToNonContrast();
          commonComponents.header.nFindSingle('phone').classList.remove('contrast');
        }
      })
      .addTo(this.ctrl);
  }

  destroy() {
    commonComponents.header.nRoot.classList.remove('header_sticky-mobile');
    this.scene.destroy();
    this.ctrl.destroy();
  }
}
