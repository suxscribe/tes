import Component from '../../common/js/component';
import {nFindComponent, loadImages} from "../../common/js/helpers";
import $ from 'jquery';

class CommentPreview extends Component {
  get getImgSrc() {
    return this.nRoot.getAttribute('data-img');
  }

  constructor(nRoot) {
    super(nRoot, 'comment-preview');

    this.nModal = document.querySelector('.comment-preview__modal');
    this.nModalImg = nFindComponent('comment-modal__content-img', this.nModal);
    this.setSrcModal = this.setSrcModal.bind(this);

    this.nRoot.addEventListener('click', this.setSrcModal);

  }

  setSrcModal() {
      const imgSrc = this.getImgSrc;
      this.nModalImg.setAttribute('data-src', imgSrc);
      loadImages([this.nModalImg]).then(()=> $(this.nModal).modal('show'));
  }


  destroy() {
      this.nRoot.removeEventListener('click', this.setSrcModal);
  }
}

export default CommentPreview;
