import Component from '../../common/js/component';
import axios from "axios/index";
import {isFunction, arrNodesFromHTML} from "../../common/js/helpers";

class EndlessBtn extends Component {
  get getCurrentPage() {
      return this.nEndlessBtn.getAttribute('data-count-page');
  }

  constructor(
      nRoot,
      initializFunciton,
      nAppendContainer = document.querySelector('.endless-btn__container'),
  ) {
    super(nRoot, 'endless-btn');

    this.utlPath = location.pathname;
    this.nAppendContainer = nAppendContainer;
    this.initializFunciton = initializFunciton;
    this.nFiltersSelects = [...document.querySelectorAll('.select__select')];
    this.nEndlessBtn = this.nRoot;
    this.CurrentPage = 1;


    this.getNewData = this.getNewData.bind(this);
    this.nEndlessBtn.addEventListener('click', this.getNewData);
  }

  getNewData() {
      const dataForm = new FormData();

      if(this.nFiltersSelects.length !== 0) {
        this.getFiltersSelectValue(dataForm);
      }
      this.CurrentPage = +this.getCurrentPage + 1;
      dataForm.append('PAGEN_1', this.CurrentPage);

      axios.post(this.utlPath, dataForm, {
      // axios.get('/dataFilters.json', dataForm, {
          headers: {
              'X-Requested-With': 'XMLHttpRequest',
              'Content-Type': 'multipart/form-data'
          },
          responseType: 'text',
      }).then(response => {
          const dataResponse = response.data;
          this.responseReaction(dataResponse);
      }).catch(response => {
          // console.log(response);
      });
  }

  responseReaction(dataResponse) {
      // this.nAppendContainer.innerHTML += dataResponse.data;
      const newNodsArr = arrNodesFromHTML(dataResponse.data);
      newNodsArr.forEach(newNod => {
          this.nAppendContainer.appendChild(newNod);
      })

      if(isFunction(this.initializFunciton)) {
          this.initializFunciton(newNodsArr);
      };
      this.nEndlessBtn.setAttribute('data-count-page', this.CurrentPage);

      if(dataResponse.lastPage) {
          this.nEndlessBtn.classList.add('_is-hidden');
      } else {
          this.nEndlessBtn.classList.remove('_is-hidden');
      };

  }


  getFiltersSelectValue(dataForm) {
      this.nFiltersSelects.forEach(nSelect => {
          dataForm.append(nSelect.getAttribute('name'), nSelect.value);
      });
  }

  destroy() {
      this.nEndlessBtn.removeEventListener('click', this.getNewData);
  }
}

export default EndlessBtn;
