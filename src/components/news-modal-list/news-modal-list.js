import Component from '../../common/js/component';
// import NewsModal from '../news-modal/news-modal';

class NewsModalList extends Component {
  get getNewsModal() {
    // console.log('this.nFind("modal")');
    console.log(this.nFind('modal'));
    return this.nFind('modal');
  }

  constructor(nRoot) {
    super(nRoot, 'news-modal-list');
    // console.log('newsmodal init');

    // Disabled. functions calling news-modal conponent for evely .news-modal
    // this.NewsModalInit = this.NewsModalInit.bind(this);
    // this.NewsModalInit();

    // this.newNewsModalInit = this.newNewsModalInit.bind(this);

    //
    const imagesForModal = Array.from(document.querySelectorAll('.info-block-5__img'));

    imagesForModal.forEach((el, i) => {
      el.addEventListener('click', showModal);
    });

    function showModal() {
      const imgSrc = this.getAttribute('src');
      document.querySelector('.news-modal-popup__content-img').setAttribute('src', imgSrc);
      $('#modalPreview1').modal('show');
      // this.removeEventListener('click', showModal);
    };

  }

  NewsModalInit() {
    this.newsModal = this.getNewsModal.map(modal => new NewsModal(modal));
  }

  newNewsModalInit(arrComments) {
    this.newsModal = this.newsModal.concat(arrComments.map(modal => new NewsModal(modal.querySelector('.news-modal-list__modal'))));
    //find each div.news-modal-list__modal with image
  }


  destroy() {
    // this.newsModal.forEach(commPrev => commPrev.destroy());
  }
}

export default NewsModalList;
