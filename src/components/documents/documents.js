import Component from '../../common/js/component';
import { HeightBalancer, nFindComponents } from '../../common/js/helpers';

class Documents extends Component {
  constructor(nRoot) {
    super(nRoot, 'documents');
    this.heightBalancer = new HeightBalancer(
      nFindComponents('document').map(nDocument => nDocument.querySelector('.document__title-1')),
      this.nRoot,
    );
  }

  destroy() {

  }
}

export default Documents;
