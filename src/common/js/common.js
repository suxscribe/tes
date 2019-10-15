/* global objectFitPolyfill */
import 'objectFitPolyfill';
import $ from 'jquery';
import 'fullpage.js/vendors/scrolloverflow';
import fullpage from 'fullpage.js';
import 'classlist-polyfill';

$.fn.fullpage = function(options) {
  var FP = new fullpage('#' + $(this).attr('id'), options);

  //Static API
  Object.keys(FP).forEach(function (key) {
    $.fn.fullpage[key] = FP[key];
  });
};

if ('scrollRestoration' in window.history) {
  window.history.scrollRestoration = 'manual';
}
function requireAll(r) {
  r.keys().forEach(r);
}

requireAll(require.context('../../components/', true, /\.svg$/));
requireAll(require.context('../icons/', true, /\.svg$/));

window.addEventListener('resize', objectFitPolyfill);

document.querySelector('html').scrollTo = () => {};
document.querySelector('body').scrollTo = () => {};

import 'bootstrap';
import 'babel-polyfill';
import './barbaInit';
