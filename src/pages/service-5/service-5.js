import Barba from 'barba.js';
import { commonComponents } from '../../common/js/commonComponents';
import { nFindComponent, nGetBody } from '../../common/js/helpers';
import InfoBlock8 from '../../components/info-block-8/info-block-8';
import Gallery from '../../components/gallery/gallery';
import Advantages from '../../components/advantages/advantages';
import Projects from '../../components/projects/projects';
import Feedback from '../../components/feedback/feedback';
import PageNavigationController from '../../components/product-tail/page-navigation-controller';

Barba.BaseView.extend({
  namespace: 'service-5',
  onEnter: () => {

  },
  async onEnterCompleted() {
    nGetBody().classList.add('service-page');
    this.infoBlock8 = new InfoBlock8(nFindComponent('info-block-8', this.nRoot));
    this.gallery = new Gallery(nFindComponent('gallery', this.nRoot));
    commonComponents.footer.fixToContainerBottom(nGetBody());
    this.advantages = new Advantages(nFindComponent('advantages', this.nRoot));
    this.projects = new Projects(nFindComponent('projects', this.nRoot));
    this.feedback = new Feedback(nFindComponent('feedback', this.nRoot));
    this.pageNavigationController = new PageNavigationController(nGetBody(), false);
    await commonComponents.preloader.preloading;
  },
  onLeave() {
    this.gallery.destroy();
    this.advantages.destroy();
    this.projects.destroy();
    this.feedback.destroy();
    this.pageNavigationController.destroy();
    nGetBody().classList.remove('service-page');
  },
  onLeaveCompleted: () => {

  },
}).init();
