import Barba from 'barba.js';
import { commonComponents } from '../../common/js/commonComponents';

Barba.BaseView.extend({
  namespace: 'icons',
  onEnter: () => {

  },
  onEnterCompleted: async () => {
    await commonComponents.preloader.preloading;
  },
  onLeave: () => {

  },
  onLeaveCompleted: () => {

  },
}).init();
