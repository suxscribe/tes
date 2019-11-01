import Component from '../../common/js/component';

import {nFindComponent, loadImages} from "../../common/js/helpers";
import $ from 'jquery';

class NewsModal extends Component {
  get getImgSrc() {
    // return this.nRoot.getAttribute('data-img');
    return this.nRoot.getAttribute('src');
  }

  constructor(nRoot) {
    super(nRoot, 'news-modal'); //
    // nRoot - finds block with component name as class. div wrap for image. triggers the modal
    this.nModal = document.querySelector('.news-modal__modal'); //modal window layout
    this.nModalImg = nFindComponent('news-modal-popup__content-img', this.nModal); //img inside modal layout
    this.setSrcModal = this.setSrcModal.bind(this);


    // Disabled. Cause were doing everything in news-modal-list

    //this.nRoot.addEventListener('click', this.setSrcModal);
    // console.log(this.nRoot);

    /*document.querySelector('.info-block-5__img').addEventListener('click', e=> {

        console.log('e.target');
        console.log(e.target);
        // this.setSrcModal;
        const imgSrc = e.target.getAttribute('src');
        document.querySelector('.news-modal-popup__content-img').setAttribute('src', imgSrc);
        $('#modalPreview1').modal('show');

    });*/

    /*$('.info-block-5__img').on('click', function(event) {
    	var imglink = $(this).data('src');
    	$('.news-modal__content-img').attr('src', imglink);
    	$('#modalPreview1').modal('show');
      console.log('imgclick');
    });*/

    // addeventlistener to img.info-block-5__img


  }

  setSrcModal() {
      const imgSrc = this.getImgSrc; // get large image from data attr
      this.nModalImg.setAttribute('data-src', imgSrc); //set large image to img inside modal
      loadImages([this.nModalImg]).then(()=> $(this.nModal).modal('show'));
  }


  destroy() {
      this.nRoot.removeEventListener('click', this.setSrcModal);
  }
}

export default NewsModal;