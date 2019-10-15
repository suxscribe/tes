import Component from '../../common/js/component';
import SandwichButton from '../sandwich-button/sandwich-button';
import { nFindComponent, offset } from '../../common/js/helpers';
import MenuVisibility from './menu-visibility';
import _ from 'lodash';
import { DEBOUNCE_INTERVAL_MS } from '../../common/js/variables';
import Menu from '../menu/menu';

class Header extends Component {
  constructor(nRoot) {
    super(nRoot, 'header');
    this.sandwichButton = new SandwichButton(
      nFindComponent('sandwich-button', this.nRoot)
    );
    this.menu = new Menu(
      nFindComponent('menu', this.nRoot)
    );
    this.menuVisibility = new MenuVisibility(this);
    this.logoDisabled = false;
    this.onLogoClick = this.onLogoClick.bind(this);
    this.nFindSingle('logo-link').addEventListener('click', this.onLogoClick);
    this.nContainer = false;
    this.onResize = _.debounce(this.onResize.bind(this), DEBOUNCE_INTERVAL_MS);
    window.addEventListener('resize', this.onResize);
  }

  onLogoClick(e) {
    if (this.logoDisabled) {
      e.stopPropagation();
      e.preventDefault();
    }
  }

  disableLogo() {
    this.nFindSingle('logo-link').classList.add('header__logo-link_disabled');
    this.logoDisabled = true;
  }

  enableLogo() {
    this.nFindSingle('logo-link').classList.remove('header__logo-link_disabled');
    this.logoDisabled = false;
  }

  onResize() {
    if (!this.nContainer) {
      return;
    }
    this.fixToContainerTop(this.nContainer);
  }

  fixToContainerTop(nContainer) {
    this.nContainer = nContainer;
    this.nRoot.style.position = 'absolute';
    this.nRoot.style.top = `${offset(nContainer).top}px`;
  }

  cancelFix() {
    this.nContainer = null;
    this.nRoot.style.removeProperty('position');
    this.nRoot.style.removeProperty('top');
  }

  destroy() {
    this.sandwichButton.destroy();
    this.menuVisibility.destroy();
    this.menu.destroy();
    this.nFindSingle('logo-link').removeEventListener('click', this.onLogoClick);
    window.removeEventListener('resize', this.onResize);
  }
}

export default Header;
