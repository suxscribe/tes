import PerfectScrollbar from 'perfect-scrollbar';
import Component from '../../common/js/component';
import SandwichMenuClose from '../sandwich-menu-close/sandwich-menu-close';
import { getDeviceType, isIE, listen, nFindComponent, Resize } from '../../common/js/helpers';
import { commonComponents } from '../../common/js/commonComponents';
const bodyScrollLock = require('body-scroll-lock');
const disableBodyScroll = bodyScrollLock.disableBodyScroll;
const enableBodyScroll = bodyScrollLock.enableBodyScroll;

class SandwichMenu extends Component {
  constructor(nRoot) {
    super(nRoot, 'sandwich-menu');
    this.currentDevice = getDeviceType();
    this.afterResize = this.afterResize.bind(this);
    this.sandwichMenuClose = new SandwichMenuClose(
      nFindComponent('sandwich-menu-close', this.nRoot),
    );
    this.sections = this.nFind('item > a');
    this.onSectionHover = this.onSectionHover.bind(this);
    this.onSectionTouch = this.onSectionTouch.bind(this);
    this.lastTouchedSection = null;
    this.sections.forEach(section => section.addEventListener('click', this.onSectionTouch, { passive: false }));
    this.sections.forEach(section => section.addEventListener('mouseover', this.onSectionHover));
    this.initScrollbar();
    this.onSandwichOpen = this.onSandwichOpen.bind(this);
    commonComponents.callbacks.add('sandwich-open', this.onSandwichOpen);
    this.onSandwichClose = this.onSandwichClose.bind(this);
    commonComponents.callbacks.add('beforeOldContainerRemove', this.onSandwichClose);
    commonComponents.callbacks.add('sandwich-close', this.onSandwichClose);
    this.resize = new Resize();
    listen('deviceType:after-resize', this.afterResize);
  }

  initScrollbar() {
    this.ps = [];
    this.scrollList = '';
    this.nFind('list_scroll').forEach((list) => {
      this.scrollList = new PerfectScrollbar(list, {
        wheelPropagation: false,
        suppressScrollX: true,
      });
      this.ps.push(this.scrollList);
    });
  }

  onSandwichOpen() {
    disableBodyScroll(this.nRoot);
  }

  onSandwichClose() {
    enableBodyScroll(this.nRoot);
  }

  onSectionHover(e) {
    if (getDeviceType() === 'mobile') {
      return;
    }
    this.sections.forEach(section => section.classList.remove('sandwich-menu__link_active'));
    e.target.classList.add('sandwich-menu__link_active');
  }

  onSectionTouch(e) {
    if (getDeviceType() !== 'mobile') {
      return;
    }
    if (this.lastTouchedSection !== e.target) {
      this.lastTouchedSection = e.target;
      if (e.target.nextSibling.nextSibling != null) {
        e.preventDefault();
        e.stopImmediatePropagation();
        this.sections.forEach(section => section.classList.remove('sandwich-menu__link_active'));
        e.target.classList.add('sandwich-menu__link_active');
      }
    }
  }

  afterResize() {
    if (getDeviceType() !== this.currentDevice) {
      if (getDeviceType() === 'mobile') {
        this.ps[1].destroy();
        this.ps[2].destroy();
        this.ps.splice(1, 2);
        this.ps[0].update();
        this.ps.forEach((ps) => { ps.update(); });
      } else {
        this.ps.forEach((ps) => { ps.destroy(); });
        this.initScrollbar();
      }
      this.currentDevice = getDeviceType();
    }
  }

  destroy() {
    disableBodyScroll(this.nRoot);
    this.sandwichMenuClose.destroy();
    commonComponents.callbacks.remove('beforeOldContainerRemove', this.onSandwichClose);
    commonComponents.callbacks.remove('sandwich-close', this.onSandwichClose);
    if (!isIE) {
      this.ps.forEach((ps) => { ps.destroy(); });
    }
  }
}

export default SandwichMenu;
