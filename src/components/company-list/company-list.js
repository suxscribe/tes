import Component from '../../common/js/component';
import CompanyListItem from '../company-list-item/company-list-item';
import { nFindComponent, nFindComponents } from '../../common/js/helpers';
import MapModal from '../map-modal/map-modal';

class CompanyList extends Component {
  constructor(nRoot) {
    super(nRoot, 'company-list');
    this.items = nFindComponents('company-list-item', this.nRoot)
      .map(nComp => new CompanyListItem(nComp, this));
    this.mapModal = new MapModal(nFindComponent('map-modal', this.nRoot));
  }

  destroy() {
    this.mapModal.destroy();
    this.items.forEach(item => item.destroy());
  }
}

export default CompanyList;
