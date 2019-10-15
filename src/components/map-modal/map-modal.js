import Component from '../../common/js/component';
import ymaps from 'ymaps';
import $ from 'jquery';

class MapModal extends Component {
  constructor(nRoot) {
    super(nRoot, 'map-modal');
    ymaps.load('https://api-maps.yandex.ru/2.1/?lang=ru_RU').then(this.onMapsLoaded.bind(this));
    $(this.nRoot).on('shown.bs.modal', () => {
      this.map.container.fitToViewport();
    });
  }

  onMapsLoaded(ymaps) {
    this.ymaps = ymaps;
    let center = [this.nRoot.getAttribute('data-lat'), this.nRoot.getAttribute('data-lng')];
    center = (parseFloat(center[0]) && parseFloat(center[1])) ? center : [-15.363, 131.044];
    this.map = new ymaps.Map(this.nFindSingle('map'), {
      center: center,
      zoom: 16,
      controls: ['zoomControl'],
    });
    this.createAndMoveToMarker(center);
  }

  createAndMoveToMarker(pos) {
    if (this.placemark) {
      this.map.geoObjects.remove(this.placemark);
    }
    this.placemark = new this.ymaps.Placemark(pos);
    this.map.geoObjects.add(this.placemark);
    this.map.setCenter(pos);
  }

  destroy() {

  }
}

export default MapModal;
