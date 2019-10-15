import axios from 'axios';
import hyperform from 'hyperform';
import Component from '../../common/js/component';
import TextField from '../textfield/textfield';
import {delay, isIE, nFindComponent, nFindComponents} from '../../common/js/helpers';

class FormFeedback extends Component {
  constructor(nRoot) {
    super(nRoot, 'form-feedback');
    this.nameInput = new TextField(nFindComponent('textfield_name', this.nRoot));
    this.emailInput = new TextField(nFindComponent('textfield_email', this.nRoot));
    this.companyInput = new TextField(nFindComponent('textfield_company', this.nRoot));
    this.phoneInput = new TextField(nFindComponent('textfield_phone', this.nRoot));
    this.textarea = new TextField(nFindComponent('textfield_textarea', this.nRoot));
    this.submitButton = nFindComponent('js-submit-button', this.nRoot);
    this.textFields = nFindComponents('textfield__input[required]', this.nRoot);
    this.captchaResponse = '';
    this.captchaResponseInput = null;

    this.renderCaptcha = this.renderCaptcha.bind(this);
    grecaptcha.ready(this.renderCaptcha);

    this.textFields.forEach((field) => {
      field.addEventListener('blur', this.validate.bind(this));
    });

    this.nFindSingle('content').addEventListener('click', this.onClick);
    this.onButtonClick = this.onButtonClick.bind(this);
    this.nFindSingle('button').addEventListener('click', this.onButtonClick);
    if (isIE()) {
      hyperform.addTranslation('ru', {
        ValueMissing: 'Пожалуйста, заполните это поле.',
        InvalidEmail: 'Пожалуйста, введите адрес электронной почты.',
        PatternMismatch: 'Пожалуйста, придерживайтесь установленного формата.',
      });
      hyperform.setLanguage('ru');
      hyperform(this.nFindSingle('content'));
    }
  }

  renderCaptcha() {
    let recaptchaContainer = nFindComponent('g-recaptcha', this.nRoot);

    window.captchaCallback = () => {
      this.validate();
    };

    if (!recaptchaContainer.classList.contains('is-inited')) {
      grecaptcha.render(recaptchaContainer, {
        'sitekey': recaptchaContainer.getAttribute('data-sitekey'),
        'callback': captchaCallback,
      });

      recaptchaContainer.classList.add('is-inited');
    }
  };

  validate() {
    let isValid = true;

    // reCaptcha
    if (grecaptcha) {
      this.captchaResponse = grecaptcha.getResponse();

      if (this.captchaResponse === '') {
        isValid = false;
      }
    }

    this.textFields.forEach((field) => {
      let fieldValid = field.checkValidity();

      if (!fieldValid) {
        return isValid = fieldValid;
      }
    });

    if (isValid) {
      this.submitButton.removeAttribute('disabled');
    } else {
      this.submitButton.setAttribute('disabled', 'disabled');
    }

    return isValid;
  }

  onClick(e) {
    // не убирать. Сделано, чтобы форма не закрывалась по нажатию на ее внутренности
    e.stopPropagation();
  }

  async onButtonClick(e) {
    e.preventDefault();

    let isValid = this.validate();
    if (!isValid) {
      this.nFindSingle('button-text').innerHTML = 'Отправить запрос';
      return;
    }

    this.nFindSingle('button').setAttribute('disabled', 'disabled');
    this.nFindSingle('button').classList.add('animate');
    this.nFindSingle('button-text').innerHTML = 'Отправить запрос';
    this.nFindSingle('content').classList.remove('success');
    this.nFindSingle('content').classList.remove('fail');
    const dataForm = new FormData();
    dataForm.append('name', this.nameInput.input.val());
    dataForm.append('email', this.emailInput.input.val());
    dataForm.append('company', this.companyInput.input.val());
    dataForm.append('phone', this.phoneInput.input.val());
    dataForm.append('textarea', this.textarea.input.val());
    dataForm.append('g-recaptcha-response', this.captchaResponse);
    const response = await axios.post(this.nFindSingle('content').getAttribute('action'), dataForm, {
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Content-Type': 'multipart/form-data',
      },
      responseType: 'text',
    });

    if (grecaptcha) {
      grecaptcha.reset();
    }

    this.nFindSingle('button').classList.remove('animate');
    response.data.status ? this.onSuccess() : this.onFail();
    this.nFindSingle('button').removeAttribute('disabled');
  }

  onSuccess() {
    this.nFindSingle('button-text').innerHTML = 'Успешно';
    this.nFindSingle('content').reset();
    this.nameInput.nRoot.classList.remove('is-focused', 'is-dirty');
    this.emailInput.nRoot.classList.remove('is-focused', 'is-dirty');
    this.companyInput.nRoot.classList.remove('is-focused', 'is-dirty');
    this.phoneInput.nRoot.classList.remove('is-focused', 'is-dirty');
    this.textarea.nRoot.classList.remove('is-focused', 'is-dirty');
    this.nFindSingle('content').classList.add('success');
  }

  onFail() {
    this.nFindSingle('button-text').innerHTML = 'Ошибка';
    this.nFindSingle('content').classList.add('fail');
  }

  destroy() {
    this.nFindSingle('content').removeEventListener('click', this.onClick);
    this.nFindSingle('title-1').removeEventListener('click', this.afterClick);
    this.nFindSingle('button').removeEventListener('click', this.onButtonClick);
    this.nameInput.destroy();
    this.emailInput.destroy();
    this.companyInput.destroy();
    this.phoneInput.destroy();
    this.textarea.destroy();
  }
}

export default FormFeedback;
