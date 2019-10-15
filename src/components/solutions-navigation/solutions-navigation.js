import Component from '../../common/js/component';
import { clearAnimation } from '../../common/js/helpers';

class SolutionsNavigation extends Component {
  constructor(nRoot, swiper) {
    super(nRoot, 'solutions-navigation');
    this.swiper = swiper;
    this.onItemClick = this.onItemClick.bind(this);
    this.nFind('item').forEach(nItem => nItem.addEventListener('click', this.onItemClick));
  }

  onItemClick(e) {
    const index = +e.target.getAttribute('data-index');
    this.swiper.slideTo(index);
  }

  setCurrentSlide(index) {
    this.currentSlideIndex = index;
    this.clearActiveSlide();
    this.nFindSingle(`item[data-index="${this.currentSlideIndex}"]`).classList.add('active');
  }

  clearActiveSlide() {
    this.nFind('item').forEach(nItem => {
      nItem.classList.remove('active');
      clearAnimation(nItem);
    });
  }

  destroy() {
    this.nFind('item').forEach(nItem => nItem.removeEventListener('click', this.onItemClick));
  }
}

export default SolutionsNavigation;
