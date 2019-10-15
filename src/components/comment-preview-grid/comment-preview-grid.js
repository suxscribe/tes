import Component from '../../common/js/component';
import CommentPreview from '../comment-preview/comment-preview';

class CommentPreviewGrid extends Component {
  get getCommentPreview() {
    return this.nFind('comment');
  }

  constructor(nRoot) {
    super(nRoot, 'comment-preview-grid');

    this.CommentPreviewInit = this.CommentPreviewInit.bind(this);
    this.CommentPreviewInit();

    this.newCommentPreviewInit = this.newCommentPreviewInit.bind(this);
  }

  CommentPreviewInit() {
    this.commentPreview = this.getCommentPreview.map(comment => new CommentPreview(comment));
  }

  newCommentPreviewInit(arrComments) {
    this.commentPreview = this.commentPreview.concat(arrComments.map(comment => new CommentPreview(comment.querySelector('.comment-preview-grid__comment'))));
  }


  destroy() {
    this.commentPreview.forEach(commPrev => commPrev.destroy());
  }
}

export default CommentPreviewGrid;
