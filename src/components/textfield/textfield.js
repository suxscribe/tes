import $ from 'jquery';
import Inputmask from 'inputmask';
import Component from '../../common/js/component';

class TextField extends Component {
  constructor(nRoot) {
    super(nRoot, 'input');
    this.root = $(this.nRoot);
    this.label = this.root.find('.textfield__label');
    this.input = this.root.find('.textfield__input')
      .on('focus', () => this.root.addClass('is-focused'))
      .on('blur', () => {
        this.checkDirty();
        this.root.removeClass('is-focused');
      })
      .on('input reset', () => this.updateClass());
    const isDirty = this.checkDirty();
    if (isDirty) this.checkValidity();
    if (this.input.attr('type') === 'tel') {
      const telMask = new Inputmask({
        mask: '+7 (999) 999 99 99',
        showMaskOnHover: false,
      });
      telMask.mask(this.input);
    }
  }

  checkDisabled() {
    this.root.toggleClass('is-disabled', this.input.prop('disabled'));
  }

  checkFocus() {
    this.root.toggleClass('is-focused', Boolean($(':focus', this.root)));
  }

  checkValidity() {
    this.root.toggleClass('is-invalid', !this.input.prop('validity').valid);
  }

  checkDirty() {
    const val = !!this.input.val();
    this.root[val ? 'addClass' : 'removeClass']('is-dirty');
    return val;
  }

  updateClass() {
    this.checkDisabled();
    this.checkValidity();
    this.checkDirty();
    this.checkFocus();
  }

  destroy() {

  }
}

export default TextField;
