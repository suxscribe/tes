import { nFindComponent } from '../../common/js/helpers';
import _ from 'lodash';
import { DEBOUNCE_INTERVAL_MS } from '../../common/js/variables';

export default class MenuVisibility {
    static get MIN_DISTANCE_PX() { return 20 }

    constructor(header) {
        this.header = header;
        this.updateVisibility();
        this.updateVisibility = _.debounce(this.updateVisibility, DEBOUNCE_INTERVAL_MS)
            .bind(this);
        window.addEventListener('resize', this.updateVisibility);
    }

    updateVisibility() {
        const nMenu = nFindComponent('menu', this.header.nRoot);
        const {left: menuLeft} = this.header.menu.nFindSingle('item:first-child').getBoundingClientRect();
        const {right: menuRight} = this.header.menu.nFindSingle('item:last-child').getBoundingClientRect();
        const {right: logoRight} = nFindComponent('header__logo', this.header.nRoot)
            .getBoundingClientRect();
        const {left: sandwichButtonLeft} = nFindComponent('sandwich-button', this.header.nRoot)
            .getBoundingClientRect();
        if (menuLeft - logoRight < MenuVisibility.MIN_DISTANCE_PX
            || sandwichButtonLeft - menuRight < MenuVisibility.MIN_DISTANCE_PX
        ) {
            nMenu.classList.add('no-transition');
            nMenu.classList.add('invisible');
        } else {
            nMenu.classList.add('no-transition');
            nMenu.classList.remove('invisible');
        }
    }

    destroy() {
        window.removeEventListener('resize', this.updateVisibility);
    }
}
