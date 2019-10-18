import Component from '../../common/js/component';
import NewsModal from '../news-modal/news-modal';

class NewsModalList extends Component {
  get getNewsModal() {
    // console.log('this.nFind("modal")');
    // console.log(this.nFind('modal'));
    return this.nFind('modal');
  }

  constructor(nRoot) {
    super(nRoot, 'news-modal-list');
    // console.log('newsmodal init');
    this.NewsModalInit = this.NewsModalInit.bind(this);
    this.NewsModalInit();

    this.newNewsModalInit = this.newNewsModalInit.bind(this);
  }

  NewsModalInit() {
    this.newsModal = this.getNewsModal.map(modal => new NewsModal(modal));
  }

  newNewsModalInit(arrComments) {
    this.newsModal = this.newsModal.concat(arrComments.map(modal => new NewsModal(modal.querySelector('.news-modal-list__modal'))));
  }


  destroy() {
    this.newsModal.forEach(commPrev => commPrev.destroy());
  }
}

export default NewsModalList;
