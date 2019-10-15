import Component from '../../common/js/component';
import { nFindComponent } from '../../common/js/helpers';
import SpoilerList from '../spoiler-list/spoiler-list';

class Construct extends Component {
  constructor(nRoot) {
    super(nRoot, 'construct');
    this.spoilerList = new SpoilerList(nFindComponent('spoiler-list'), this.nRoot);
  }

  destroy() {
    this.spoilerList.destroy();
  }
}

export default Construct;
