import Component from '../../common/js/component';
import Services from '../services/services';
import Projects from '../projects/projects';
import SubscribeToNews from '../subscribe-to-news/subscribe-to-news';
import News from '../news/news';
import Clock from '../clock/clock';
import Contacts from '../contacts/contacts';
import { getDeviceType, nFindComponent } from '../../common/js/helpers';
import Header from '../header/header';

class IndexSection3 extends Component {
  constructor(nRoot) {
    super(nRoot, 'index-section-3');
    this.services = new Services(nFindComponent('services', this.nRoot));
    this.firstSection = this.services;
    this.projects = new Projects(nFindComponent('projects', this.nRoot));
    this.subscribeToNews = new SubscribeToNews(nFindComponent('subscribe-to-news', this.nRoot));
    this.news = new News(nFindComponent('news', this.nRoot));
    this.clock = new Clock(nFindComponent('clock', this.nRoot));
    this.contacts = new Contacts(nFindComponent('contacts', this.nRoot));
    this.header = new Header(nFindComponent('header', this.nRoot));
    if (getDeviceType() !== 'mobile') {
      this.header.nFindSingle('logo-link').classList.add('contrast');
      this.header.menu.switchToContrast();
      this.header.sandwichButton.switchToContrast();
      this.header.nFindSingle('phone').classList.add('contrast');
    }
  }

  destroy() {
    this.header.destroy();
    this.services.destroy();
    this.projects.destroy();
    this.subscribeToNews.destroy();
    this.news.destroy();
    this.clock.destroy();
    this.contacts.destroy();
  }
}

export default IndexSection3;
