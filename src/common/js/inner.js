import { nGetBody } from './helpers';
import { commonComponents } from './commonComponents';

export default () => {
  nGetBody().classList.add('page-inner');
  commonComponents.header.menu.switchToNonContrast();
  commonComponents.header.nFindSingle('logo-link').classList.remove('contrast');
  commonComponents.header.sandwichButton.switchToNonContrast();
  commonComponents.header.nFindSingle('phone').classList.remove('contrast');
};
