import Component from '../../common/js/component';
import { splitToLines, splitToLinesDestroy } from '../../common/js/helpers';

class Service extends Component {
  constructor(nRoot) {
    super(nRoot, 'service');
    this.splitTextContent();
  }

  splitTextContent() {
    this.nTextLines = splitToLines(this.nFindSingle('text'), `${this.componentName}__text-line`);
  }

  destroy() {
    splitToLinesDestroy(this.nFindSingle('text'));
  }
}

export default Service;
