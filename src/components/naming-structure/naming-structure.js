import Component from '../../common/js/component';
import { emit } from '../../common/js/helpers';
import $ from 'jquery';

class NamingStructure extends Component {
  constructor(nRoot) {
    super(nRoot, 'naming-structure');
    this.onItemHover = this.onItemHover.bind(this);
    this.onItemLeave = this.onItemLeave.bind(this);
    this.requestIscrollRefresh = this.requestIscrollRefresh.bind(this);
    this.nFind('item_active').forEach(nItem => nItem.addEventListener('mouseover', this.onItemHover));
    this.nFind('item_active').forEach(nItem => nItem.addEventListener('mouseleave', this.onItemLeave));
    $(this.nRoot).on('shown.bs.collapse', this.requestIscrollRefresh);
    $(this.nRoot).on('hidden.bs.collapse', this.requestIscrollRefresh);
  }

  onItemHover(e) {
    const index = +e.target.getAttribute('data-item');
    this.nFind('description').forEach((nItem) => {
      nItem.classList.remove('naming-structure__description_active');
      const descIndex = Number(nItem.getAttribute('data-desc'));
      if (descIndex === index) {
        nItem.classList.add('naming-structure__description_active');
      }
    });
  }

  onItemLeave() {
    this.nFind('description').forEach((nItem) => {
      nItem.classList.remove('naming-structure__description_active');
    });
  }

  requestIscrollRefresh() {
    emit('scrolling:request-iscroll-refresh');
  }

  destroy() {
    this.nFind('item_active').forEach(nItem => nItem.removeEventListener('mouseover', this.onItemHover));
    this.nFind('item_active').forEach(nItem => nItem.removeEventListener('mouseleave', this.onItemLeave));
    $(this.nRoot).off('shown.bs.collapse', this.requestIscrollRefresh);
    $(this.nRoot).off('hidden.bs.collapse', this.requestIscrollRefresh);
  }
}

export default NamingStructure;
