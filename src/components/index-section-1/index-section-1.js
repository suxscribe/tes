/* global SplitType */
import 'typesplit';
import ValueIncreaser from '../value-increaser/value-increaser';
import { VALUE_INCREASE_INTERVAL_MS } from '../../common/js/variables';
import { getDeviceType, isIE, nFindComponent, splitToLines, splitToLinesDestroy } from '../../common/js/helpers';
import Component from '../../common/js/component';
import $ from 'jquery';

class IndexSection1 extends Component {
  constructor(nRoot) {
    super(nRoot, 'index-section-1', isIE() ? 'height' : 'min-height');
    this.deviceType = getDeviceType();
    if (this.deviceType !== 'mobile') {
      this.initDesktop();
    } else {
      this.initMobile();
    }
  }

  initDesktop() {
    this.valueIncreasers = [
      new ValueIncreaser(this.nFindSingle('region-value'), VALUE_INCREASE_INTERVAL_MS),
      new ValueIncreaser(this.nFindSingle('year-value'), VALUE_INCREASE_INTERVAL_MS),
    ];
    this.splitTextContent();
    this.nFindSingle('move-next').addEventListener('click', this.onMoveNextClick);
  }

  onMoveNextClick() {
    $.fn.fullpage.moveSectionDown();
  }

  initMobile() {
  }

  splitTextContent() {
    this.nText1Lines = splitToLines(
      this.nFindSingle('text-1'),
      `${this.componentName}__text-1-line`
    );
  }

  destroy() {
    splitToLinesDestroy(this.nFindSingle('text-1'));
    if (this.deviceType !== 'mobile') {
      this.valueIncreasers.forEach(valueIncreaser => valueIncreaser.destroy());
      this.nFindSingle('move-next').removeEventListener('click', this.onMoveNextClick);
    }
  }
}

export default IndexSection1;
