import Barba from 'barba.js';
import { commonComponents } from '../../common/js/commonComponents';
import { nGetBody } from '../../common/js/helpers';

Barba.BaseView.extend({
  namespace: '404',
  onEnter: () => {
    const menuItem = document.querySelectorAll('.menu__item');
    menuItem.forEach((item) => {
      item.classList.add('p404__hide');
    });
  },
  async onEnterCompleted() {
    commonComponents.footer.cancelFix();
    document.querySelector('.footer')
      .classList
      .add('footer__full-opacity');
    commonComponents.header.menu.switchToContrast();
    commonComponents.header.sandwichButton.switchToContrast();
    commonComponents.header.nFindSingle('logo-link')
      .classList
      .add('contrast');
    commonComponents.header.nFindSingle('phone')
      .classList
      .add('contrast');
    nGetBody()
      .classList
      .remove('page-inner');
  },
  onLeave() {
  },
  onLeaveCompleted: () => {
    const hide = document.querySelectorAll('.p404__hide');
    hide.forEach((item) => {
      item.classList.remove('p404__hide');
    });
  },
})
  .init();
