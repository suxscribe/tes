import cookie from 'cookie';
import Component from '../../common/js/component';

class CookieMessage extends Component {
  static alreadyAccepted() {
    return cookie.parse(document.cookie).accept === 'ok';
  }

  constructor(nRoot) {
    super(nRoot, 'cookie-message');
    this.accept = this.accept.bind(this);
    this.nFindSingle('btn-accept').addEventListener('click', this.accept);
    if (!CookieMessage.alreadyAccepted()) {
      this.nRoot.classList.remove('hidden');
    }
  }

  accept() {
    document.cookie = cookie.serialize('accept', 'ok', {
      path: '/',
      maxAge: 60 * 60 * 24 * 365 * 5, // 5 years
    });
    this.nRoot.classList.add('hidden');
  }

  destroy() {
    this.nFindSingle('btn-accept').removeEventListener('click', this.accept);
    this.nRoot.classList.add('hidden');
  }
}

export default CookieMessage;
