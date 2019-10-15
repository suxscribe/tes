import Choices from 'choices.js/public/assets/scripts/choices.min';
import axios from 'axios';
import Component from '../../common/js/component';
import Select from '../select/select.js';
import { isFunction } from '../../common/js/helpers';

class Filters extends Component {
  constructor(
    nRoot,
    initializFunciton,
    filterableWrapper = document.querySelector('.filters__filterable'),
  ) {
    super(nRoot, 'filters');
    this.filterableWrapper = filterableWrapper;
    this.initializFunciton = initializFunciton;

    this.utlPath = location.pathname;

    this.endLessBnt = document.querySelector('.endless-btn');

    this.nResetBtn = this.nFindSingle('reset');
    this.nSelectsWr = this.nFind('select');

    this.selects = this.nSelectsWr.map(nSelectWr => new Select(nSelectWr));

    this.defaultSelects = this.nSelectsWr.map((nSelectWr) => {
      const nSelect = nSelectWr.querySelector('.select__select');
      return [nSelect.options[0].value, nSelect.options[0].innerHTML];
    });


    this.dataFiltersSending = this.dataFiltersSending.bind(this);

    this.selects.forEach(select => select.nSelect.addEventListener('change', this.dataFiltersSending));

    this.setDefaultSelected = this.setDefaultSelected.bind(this);

    this.nResetBtn.addEventListener('click', this.setDefaultSelected);
  }

  removeSelected() {
    this.selects.forEach((select, inx) => {
      select.selectCl.setChoiceByValue(`${this.defaultSelects[inx][0]}`);
    });
  }

  async setDefaultSelected() {
    this.removeSelected();
    this.dataFiltersSending();
  }

  async dataFiltersSending() {
    const dataForm = new FormData();

    this.nSelectsWr.forEach((nSelectWr) => {
      const nSelect = nSelectWr.querySelector('.select__select');
      dataForm.append(nSelect.getAttribute('name'), nSelect.value);
    });

    await axios.post(this.utlPath, dataForm, {
    //   axios.get('/dataFilters.json', dataForm, {
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Content-Type': 'multipart/form-data',
      },
      responseType: 'text',
    }).then((response) => {
      const dataResponse = response.data;
      this.responseReaction(dataResponse);
    }).catch((response) => {
      // console.log(response);
    });
  }

  responseReaction(dataResponse) {
    this.filterableWrapper.innerHTML = dataResponse.data;
    if (isFunction(this.initializFunciton)) {
      this.initializFunciton();
    }

    if (this.endLessBnt) {
      this.endLessBntAction(dataResponse);
    }
  }

  endLessBntAction(dataResponse) {
    this.endLessBnt.setAttribute('data-count-page', '1');
    if (dataResponse.lastPage) {
      this.endLessBnt.classList.add('_is-hidden');
    } else {
      this.endLessBnt.classList.remove('_is-hidden');
    }
  }


  destroy() {
    this.selects.forEach(select => select.nSelect.removeEventListener('change', this.dataFiltersSending));
    this.nResetBtn.removeEventListener('click', this.setDefaultSelected);
    this.selects.forEach(select => select.destroy());
  }
}

export default Filters;
