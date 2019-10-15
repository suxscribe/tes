import Component from '../../common/js/component';
import { nFindComponent } from '../../common/js/helpers';
import Solutions from '../solutions/solutions';

class IndexSection2 extends Component {
  constructor(nRoot) {
    super(nRoot, 'index-section-2');
    this.solutions = new Solutions(nFindComponent('solutions', this.nRoot));
  }

  destroy() {
    this.solutions.destroy();
  }
}

export default IndexSection2;
