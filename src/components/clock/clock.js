import Component from '../../common/js/component';
import moment from 'moment';

const UPDATE_INTERVAL_MS = 1000;

class Clock extends Component {
  constructor(nRoot) {
    super(nRoot, 'clock');
    this.update();
    this.update = this.update.bind(this);
    this.intervalId = setInterval(this.update, UPDATE_INTERVAL_MS);
  }

  update() {
    const now = moment();
    this.nFindSingle('hours').innerHTML = now.format('hh');
    this.nFindSingle('minutes').innerHTML = now.format('mm');
    this.nFindSingle('ampm').innerHTML = now.format('a');
  }

  destroy() {
    clearInterval(this.intervalId);
  }
}

export default Clock;
