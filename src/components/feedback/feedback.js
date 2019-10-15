import Component from '../../common/js/component';
import FormFeedback from '../form-feedback/form-feedback';
import { emit, nFindComponent } from '../../common/js/helpers';
import $ from 'jquery';

class Feedback extends Component {
  constructor(nRoot) {
    super(nRoot, 'feedback');
    this.formFeedback = new FormFeedback(nFindComponent('form-feedback', this.nRoot));
    this.requestIscrollRefresh = this.requestIscrollRefresh.bind(this);
    $(this.nRoot).on('shown.bs.collapse', this.requestIscrollRefresh);
    $(this.nRoot).on('hidden.bs.collapse', this.requestIscrollRefresh);
  }

  requestIscrollRefresh() {
    emit('scrolling:request-iscroll-refresh');
  }

  destroy() {
    $(this.nRoot).off('shown.bs.collapse', this.requestIscrollRefresh);
    $(this.nRoot).off('hidden.bs.collapse', this.requestIscrollRefresh);
    this.formFeedback.destroy();
  }
}

export default Feedback;
