import Component from '../../common/js/component';
import 'typesplit';
import { getDeviceType, splitToLines, splitToLinesDestroy } from '../../common/js/helpers';

class ProductHead extends Component {
  constructor(nRoot) {
    super(nRoot, 'product-head');
    this.deviceType = getDeviceType();
    if (this.deviceType !== 'mobile') {
      this.initDesktop();
    }
  }

  initDesktop() {
    this.splitTextContent();
  }

  splitTextContent() {
    this.nText1Lines = splitToLines(
      this.nFindSingle('text-1'),
      `${this.componentName}__text-1-line`,
    );
  }

  destroy() {
    splitToLinesDestroy(this.nFindSingle('text-1'));
  }
}

export default ProductHead;
