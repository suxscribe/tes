import Component from '../../common/js/component';
import MapModal from '../../components/map-modal/map-modal';
import { nFindComponent } from '../../common/js/helpers';

class Contacts extends Component {
  constructor(nRoot) {
    super(nRoot, 'contacts');
    this.mapModal = new MapModal(nFindComponent('map-modal'));
  }

  destroy() {
    this.mapModal.destroy();
  }
}

export default Contacts;
