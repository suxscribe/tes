import FullHeight from '../full-height/full-height';
import ProductMap from '../product-map/product-map';
import { getDeviceType, nFindComponent } from '../../common/js/helpers';

class ProductSection1 extends FullHeight {
  constructor(nRoot) {
    super(nRoot, 'product-section-1');
    this.productMap = new ProductMap(nFindComponent('product-map', this.nRoot));
    if (getDeviceType() === 'mobile') {
      this.disableFullHeight();
    }
  }

  destroy() {
    this.productMap.destroy();
  }
}

export default ProductSection1;
