import Swiper from 'swiper';
import _ from 'lodash';
import Component from '../../common/js/component';
import { DEBOUNCE_INTERVAL_MS, SCREEN_MD_MIN_PX } from '../../common/js/variables';
import {
  calculateColWidth, getDeviceType,
  nFindComponent,
} from '../../common/js/helpers';
import MobileSliderNavigation from '../mobile-slider-navigation/mobile-slider-navigation';

class AdvantageSlider extends Component {
  constructor(nRoot) {
    super(nRoot, 'advantage-slider');
    this.mobileSliderNavigation = new MobileSliderNavigation(
      nFindComponent('mobile-slider-navigation', this.nRoot),
    );
    this.swipers = this.nFind('swiper-container').map((nSwiperContainer, i) => {
      nSwiperContainer.querySelector('.swiper-wrapper').style.left = `-${i * 100}%`;
      return new Swiper(nSwiperContainer, {
        loop: true,
        slidesPerView: 'auto',
        keyboard: true,
        allowTouchMove: true,
        on: {
          touchStart: () => {
            this.bindAllSlidersTo(i);
          },
        },
        pagination: {
          el: this.mobileSliderNavigation.nFind('progress'),
          type: 'progressbar',
        },
      });
    });
    if (getDeviceType() === 'mobile') {
      this.initMobile();
    } else {
      this.initDesktop();
    }
    this.updateSlidersWidth();
    this.updateSlidersWidth = _.debounce(this.updateSlidersWidth.bind(this), DEBOUNCE_INTERVAL_MS);
    window.addEventListener('resize', this.updateSlidersWidth);
    this.swipers[1].on('slideChange', () => this.mobileSliderNavigation.setCurrent(this.swipers[1].realIndex + 1));
  }

  initDesktop() {
    this.swipers.forEach((swiper) => { swiper.params.pagination.progressbarOpposite = true; });
  }

  initMobile() {
    this.swipers.forEach((swiper) => { swiper.params.pagination.progressbarOpposite = false; });
    this.moveNext = this.moveNext.bind(this);
    this.mobileSliderNavigation.nFindSingle('next').addEventListener('click', this.moveNext);
    this.movePrev = this.movePrev.bind(this);
    this.mobileSliderNavigation.nFindSingle('prev').addEventListener('click', this.movePrev);
  }

  bindAllSlidersTo(i) {
    this.swipers.forEach(swiper => swiper.controller.control = null);
    const swipersToControl = this.swipers.concat();
    swipersToControl.splice(i, 1);
    this.swipers[i].controller.control = swipersToControl;
  }

  moveNext() {
    this.bindAllSlidersTo(0);
    this.swipers[0].slideNext();
  }

  movePrev() {
    this.bindAllSlidersTo(0);
    this.swipers[0].slidePrev();
  }

  updateSlidersWidth() {
    this.swipers.forEach((swiper) => {
      let widthPx;
      if (matchMedia(`(min-width: ${SCREEN_MD_MIN_PX}px)`).matches) {
        widthPx = `${Math.round(calculateColWidth() * 4)}px`;
      } else {
        widthPx = `${Math.round(calculateColWidth() * 6.5)}px`;
      }
      swiper.$el[0].style.width = widthPx;
      [...swiper.$el[0]
        .querySelectorAll('.swiper-slide')]
        .forEach(nSlide => nSlide.style.width = widthPx);
      swiper.update();
    });
  }

  destroy() {
    this.swipers.forEach(swiper => swiper.destroy());
    this.mobileSliderNavigation.destroy();
    if (getDeviceType() === 'mobile') {
      this.mobileSliderNavigation.nFindSingle('next').removeEventListener('click', this.moveNext);
      this.mobileSliderNavigation.nFindSingle('prev').removeEventListener('click', this.movePrev);
      this.swipers.forEach(swiper => swiper.destroy());
    }
  }
}

export default AdvantageSlider;
