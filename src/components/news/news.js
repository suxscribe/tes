import Component from '../../common/js/component';
import NewsPreview from '../news-preview/news-preview';
import { nFindComponents } from '../../common/js/helpers';

class News extends Component {
  constructor(nRoot) {
    super(nRoot, 'news');
    this.newsPreviews = nFindComponents('news-preview', this.nRoot)
      .map(nNewsPreview => new NewsPreview(nNewsPreview));
  }

  destroy() {
    this.newsPreviews.forEach(newsPreview => newsPreview.destroy());
  }
}

export default News;
