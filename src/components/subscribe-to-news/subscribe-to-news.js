import hyperform from 'hyperform';
import Component from '../../common/js/component';
import { nFindComponent, delay, isIE } from '../../common/js/helpers';
import TextField from '../textfield/textfield';
import axios from 'axios';

class SubscribeToNews extends Component {
  constructor(nRoot) {
    super(nRoot, 'subscribe-to-news');
    this.emailInput = new TextField(nFindComponent('textfield', this.nRoot));
    this.onButtonClick = this.onButtonClick.bind(this);
    this.nFindSingle('button').addEventListener('click', this.onButtonClick);
    if (isIE()) {
      hyperform.addTranslation('ru', {
        ValueMissing: 'Пожалуйста, заполните это поле.',
        InvalidEmail: 'Пожалуйста, введите адрес электронной почты.',
        PatternMismatch: 'Пожалуйста, придерживайтесь установленного формата.',
      });
      hyperform.setLanguage('ru');
      hyperform(this.nRoot);
    }
  }

  async onButtonClick(e) {
    e.preventDefault();
    e.stopPropagation();
    if (this.nRoot.reportValidity && !this.nRoot.reportValidity()) {
      return;
    }
    this.nFindSingle('button').setAttribute('disabled', 'disabled');
    this.nFindSingle('button').classList.add('animate');
    this.nFindSingle('button-text').innerHTML = 'Подписаться';
    this.nRoot.classList.remove('success');
    this.nRoot.classList.remove('fail');
    const dataForm = new FormData();
    dataForm.append('email', this.emailInput.input.val());
    const response = await axios.post(this.nRoot.getAttribute('action'), dataForm, {
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Content-Type': 'multipart/form-data',
      },
      responseType: 'text',
    });
    this.nFindSingle('button').classList.remove('animate');
    response.data.status ? this.onSuccess() : this.onFail();
    this.nFindSingle('button').removeAttribute('disabled');
  }

  onSuccess() {
    this.nFindSingle('button-text').innerHTML = 'Успешно';
    this.emailInput.nRoot.classList.remove('is-focused', 'is-dirty');
    this.nRoot.reset();
    this.nRoot.classList.add('success');
  }

  onFail() {
    this.nFindSingle('button-text').innerHTML = 'Ошибка';
    this.nRoot.classList.add('fail');
  }

  destroy() {
    this.nFindSingle('button').removeEventListener('click', this.onButtonClick);
    this.emailInput.destroy();
  }
}

export default SubscribeToNews;
