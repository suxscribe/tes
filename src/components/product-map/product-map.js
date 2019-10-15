import $ from 'jquery';
import TweenMax from 'TweenMax';
import Component from '../../common/js/component';
import ProductMapSlider from '../product-map-slider/product-map-slider';
import {
  getDeviceType,
  nFindComponent,
  nGetBody,
  prependChild,
} from '../../common/js/helpers';
import { appearAnim as appearAnimSlide } from '../product-map-slide/animations';

class ProductMap extends Component {
  constructor(nRoot) {
    super(nRoot, 'product-map');
    this.productMapSlider = new ProductMapSlider(nFindComponent('product-map-slider'));
    if (getDeviceType() !== 'mobile') {
      this.initDesktop();
    }
  }

  initDesktop() {
    this.nMapSliderNativeParent = this.productMapSlider.nRoot.parentNode;
    prependChild(nGetBody(), this.productMapSlider.nRoot);
    this.onItemHover = this.onItemHover.bind(this);
    this.onItemLeave = this.onItemLeave.bind(this);
    this.onSliderOpen = this.onSliderOpen.bind(this);
    this.nFind('pin').forEach(nItem => nItem.addEventListener('mouseover', this.onItemHover));
    this.nFind('pin').forEach(nItem => nItem.addEventListener('mouseleave', this.onItemLeave));
    this.nFind('pin').forEach(nItem => nItem.addEventListener('click', this.onSliderOpen));
  }

  onItemHover(e) {
    const index = +e.target.getAttribute('data-pin');
    let popupHeight = e.target.firstElementChild.offsetHeight;
    let popupWidth = e.target.firstElementChild.offsetWidth;
    TweenMax.fromTo(e.target.firstElementChild, 0.5, { width: 0, height: 0, padding: 0 }, { width: `${popupWidth}px`, height: `${popupHeight}px`, padding: '25px 50px 25px 25px', clearProps: 'all', ease: Back.easeOut.config(1.7) });
    this.nFind('bg').forEach((nItem) => {
      nItem.classList.remove('product-map__bg_active');
      const imageIndex = Number(nItem.getAttribute('data-image'));
      if (imageIndex === index) {
        nItem.classList.add('product-map__bg_active');
      }
    });
  }

  onItemLeave() {
    this.nFind('bg').forEach((nItem) => {
      nItem.classList.remove('product-map__bg_active');
    });
  }

  onSliderOpen(e) {
    $.fn.fullpage.setAllowScrolling(false);
    const index = +e.target.getAttribute('data-pin');
    this.productMapSlider.swiper.slideTo(index - 1, 0);
    document.querySelector('.product-map-slider').classList.remove('product-map-slider_hide');
    appearAnimSlide(this.productMapSlider.activeSlide);
  }

  destroy() {
    if (getDeviceType() !== 'mobile') {
      prependChild(this.nMapSliderNativeParent, this.productMapSlider.nRoot);
      this.nFind('pin').forEach(nItem => nItem.removeEventListener('mouseover', this.onItemHover));
      this.nFind('pin').forEach(nItem => nItem.removeEventListener('mouseleave', this.onItemLeave));
      this.nFind('pin').forEach(nItem => nItem.removeEventListener('click', this.onSliderOpen));
    }
    this.productMapSlider.destroy();
  }
}

export default ProductMap;
