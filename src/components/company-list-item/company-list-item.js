import Component from '../../common/js/component';
import $ from 'jquery';

class CompanyListItem extends Component {
  constructor(nRoot, companyList) {
    super(nRoot, 'company-list-item');
    this.companyList = companyList;
    [...this.nFindSingle('toggle').querySelectorAll('a')]
      .forEach(nA => nA.addEventListener('click', this.onLinkClick));
    this.onShowOnMapClick = this.onShowOnMapClick.bind(this);
    this.nFindSingle('show-on-map').addEventListener('click', this.onShowOnMapClick);
  }

  onLinkClick(e) {
    e.stopPropagation();
  }

  onShowOnMapClick(e) {
    e.stopPropagation();
    this.companyList.mapModal.createAndMoveToMarker([
      parseFloat(e.target.getAttribute('data-lat')),
      parseFloat(e.target.getAttribute('data-lng')),
    ]);
    $(e.target.getAttribute('data-target')).modal('show');
  }

  destroy() {
    [...this.nFindSingle('toggle').querySelectorAll('a')]
      .forEach(nA => nA.removeEventListener('click', this.onLinkClick));
    this.nFindSingle('show-on-map').removeEventListener('click', this.onShowOnMapClick);
  }
}

export default CompanyListItem;
