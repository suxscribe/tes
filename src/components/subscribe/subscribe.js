import Component from '../../common/js/component';
import SubscribeToNews from '../subscribe-to-news/subscribe-to-news';
import { nFindComponent } from '../../common/js/helpers';

class Subscribe extends Component {
  constructor(nRoot) {
    super(nRoot, 'subscribe');
    this.subscribeToNews = new SubscribeToNews(nFindComponent('subscribe-to-news', this.nRoot));
  }

  destroy() {
    this.subscribeToNews.destroy();
  }
}

export default Subscribe;
