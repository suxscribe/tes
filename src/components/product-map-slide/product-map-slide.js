import FullHeight from '../full-height/full-height';
import 'typesplit';
import { getDeviceType, splitToLines, splitToLinesDestroy } from '../../common/js/helpers';
import PerfectScrollbar from 'perfect-scrollbar';

class ProductMapSlide extends FullHeight {
  constructor(nRoot) {
    super(nRoot, 'product-map-slide');
    if (getDeviceType() !== 'mobile') {
      this.initDesktop();
    } else {
      this.initMobile();
    }
  }
  initDesktop() {
    this.splitTextContent();
    this.ps = new PerfectScrollbar(this.nFindSingle('col'), {
      wheelPropagation: false,
      suppressScrollX: true,
    });
  }

  initMobile() {
    this.disableFullHeight();
    this.toggle = this.nFindSingle('toggle');
    this.desc = this.nFindSingle('desc');
    this.toggleDesc = this.toggleDesc.bind(this);
    this.toggle.addEventListener('click', this.toggleDesc, false);
  }

  initToggle() {
    if (this.desc.scrollHeight > this.desc.offsetHeight) {
      this.toggle.classList.add('product-map-slide__toggle_active');
      this.desc.classList.add('product-map-slide__desc_max-height');
    }
  }

  toggleDesc() {
    this.desc.classList.toggle('product-map-slide__desc_show');
    this.toggle.classList.toggle('product-map-slide__toggle_hide');
  }

  hideDesc() {
    if (this.desc.classList.contains('product-map-slide__desc_show')) {
      this.desc.classList.remove('product-map-slide__desc_show');
      this.toggle.classList.remove('product-map-slide__toggle_hide');
    }
  }

  splitTextContent() {
    this.nTitle1Lines = splitToLines(
      this.nFindSingle('name'),
      `${this.componentName}__name-1-line`,
    );
  }

  destroy() {
    splitToLinesDestroy(this.nFindSingle('name'));
    if (getDeviceType() !== 'mobile') {
      this.ps.destroy();
    }
  }
}

export default ProductMapSlide;
