import Component from '../../common/js/component';

import {nFindComponent, loadImages} from "../../common/js/helpers";
import $ from 'jquery';

class NewsModal extends Component {
  get getImgSrc() {
    console.log(this.nRoot.getAttribute('data-img'));
    return this.nRoot.getAttribute('data-img');
  }

  constructor(nRoot) {
    super(nRoot, 'news-modal');
    console.log('nRoot:' + nRoot);
    this.nModal = document.querySelector('.news-modal__modal'); //modal window layout
    this.nModalImg = nFindComponent('news-modal-popup__content-img', this.nModal); //img inside modal layout
    console.log(`nModalImg = ${this.nModalImg}`);
    this.setSrcModal = this.setSrcModal.bind(this);

    this.nRoot.addEventListener('click', this.setSrcModal);

    // $('.info-block-5__img').on('click', function(event) {
    // 	var imglink = $(this).data('src');
    // 	$('.news-modal__content-img').attr('src', imglink);
    // 	$('#modalPreview1').modal('show');
    //   console.log('imgclick');
    // });

  }

  setSrcModal() {
      const imgSrc = this.getImgSrc;
      console.log(imgSrc);
      this.nModalImg.setAttribute('data-src', imgSrc);
      loadImages([this.nModalImg]).then(()=> $(this.nModal).modal('show'));
      console.log(this.nModalImg);
  }


  destroy() {
      this.nRoot.removeEventListener('click', this.setSrcModal);
  }
}

export default NewsModal;