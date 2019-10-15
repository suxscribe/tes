import Component from '../../common/js/component';
import { loadImages, nGetBody, waitForGSAPAnimationEnd } from '../../common/js/helpers';
import {
  appearAnim as appearAnimPreloader,
} from './animations';
import { delay } from '../../common/js/helpers';

class Preloader extends Component {
  constructor(nRoot) {
    super(nRoot, 'preloader');
    const playbackOverPromise = async () => {
      await waitForGSAPAnimationEnd(appearAnimPreloader(this, 1));
      return loadImages();
    };
    this.content = this.nFindSingle('content');

    this.preloading = Promise.all([
      playbackOverPromise(),
    ]).then(() => {
      return delay(1500);
    })
      .then(() => {
        nGetBody().classList.remove('preloading');
        nGetBody().style.removeProperty('height');
        this.hide();
      });
  }

  hide() {
    this.nRoot.classList.add('smooth-hide');
  }
}

export default Preloader;
