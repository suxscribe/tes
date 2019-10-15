import ScrollMagic from 'scrollmagic';
import Component from '../../common/js/component';
import { nodeFromHTML, emit } from '../../common/js/helpers';

class PageNavigation extends Component {
  constructor(nRoot, items = [], activeIndex = 1) {
    super(nRoot, 'page-navigation');
    this.ctrl = new ScrollMagic.Controller();
    this.items = items;
    this._activeIndex = activeIndex;
  }

  set activeIndex(index) {
    this._activeIndex = index;
  }

  get activeIndex() {
    return this._activeIndex;
  }

  createAnchors() {
    const nAnchorContainer = this.nFindSingle('anchors');
    this.items.forEach(({ node: nSection, label }, i) => {
      const nAnchor = nodeFromHTML(
        `<div class="page-navigation__anchor" data-anchor="${i + 1}">${label}<div class="page-navigation__progress"><div class="page-navigation__progress-value"></div></div></div>`,
      );
      nAnchor.addEventListener('click', () => {
        emit('page-navigation:anchor-click', {
          nAnchor,
          nSection,
        }, true, nAnchor);
      });
      if (i === this.activeIndex - 1) {
        nAnchor.classList.add('page-navigation__anchor_active');
      }
      nAnchorContainer.appendChild(nAnchor);
    });
  }

  clearAnchors() {
    const nAnchorContainer = this.nFindSingle('anchors');
    nAnchorContainer.innerHTML = '';
  }

  updateView() {
    const nAnchors = this.nFind('anchor');
    [].forEach.call(nAnchors, (nAnchor) => {
      nAnchor.classList.remove('page-navigation__anchor_active');
      if (nAnchor.getAttribute('data-anchor') == this.activeIndex - 1) {
        nAnchor.classList.add('page-navigation__anchor_active');
      }
    });
  }

  destroy() {
    if (this.ctrl) {
      this.ctrl.destroy(true);
    }
  }
}

export default PageNavigation;
