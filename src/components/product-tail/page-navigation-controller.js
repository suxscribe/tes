import $ from 'jquery';
import ScrollMagic from 'scrollmagic';
import TweenMax from 'TweenMax';
import ScrollToPlugin from 'ScrollToPlugin';
import Component from '../../common/js/component';
import PageNavigation from '../page-navigation/page-navigation';
import {
  nFindComponent,
  offset,
  offsetSimpleBar,
  listen,
  innerHeight,
} from '../../common/js/helpers';
import { FIXED_HEADER_HEIGHT_PX } from '../../common/js/variables';

// предотвращяем выпливание плагина из бандла во время тришейкинга
const plugins = [ ScrollToPlugin ];

class PageNavigationController extends Component {
  constructor(nRoot, simpleBar = true) {
    super(nRoot, 'page-navigation-controller');
    this.simpleBar = simpleBar;
    this.sectionScenes = [];
    this.pageNavigation = new PageNavigation(nFindComponent('page-navigation'));
    const trigger = nRoot.querySelector('[data-navigation-trigger]');
    const nFooter = nRoot.querySelector('.static-footer');

    this.pageNavigation.items = [...nRoot.querySelectorAll('[data-page-nav-item]')].map(
      (nItem, i) => {
        const label = nItem.dataset.pageNavItem ? nItem.dataset.pageNavItem : nItem.innerHTML;
        return { node: nItem, label };
      },
    );
    this.pageNavigation.createAnchors();
    this.createSectionScenes();
    this.addReactionToAnchors();

    this.scene1 = new ScrollMagic.Scene({
      triggerHook: 1,
      triggerElement: trigger,
      offset: 10,
    })
      .on(
        'enter',
        () => {
          this.pageNavigation.nRoot.classList.remove('page-navigation_hide');
        },
      )
      .on(
        'leave',
        () => {
          this.pageNavigation.nRoot.classList.add('page-navigation_hide');
        },
      );
    this.scene1.addTo(this.pageNavigation.ctrl);

    this.scene2 = new ScrollMagic.Scene({
      triggerHook: 1,
      triggerElement: nFooter,
    })
      .on(
        'enter',
        () => {
          this.pageNavigation.nRoot.classList.add('page-navigation_hide');
        },
      )
      .on(
        'leave',
        () => {
          this.pageNavigation.nRoot.classList.remove('page-navigation_hide');
        },
      );
    this.scene2.addTo(this.pageNavigation.ctrl);

    if (nRoot.querySelector('[data-navigation-contrast]')) {

      this.scene3 = new ScrollMagic.Scene({
        triggerHook: 0.5,
        triggerElement: nRoot.querySelector('[data-navigation-contrast]'),
        duration: innerHeight(nRoot.querySelector('[data-navigation-contrast]')),
      })
        .on(
          'enter',
          () => {
            this.pageNavigation.nRoot.classList.add('page-navigation_contrast');
          },
        )
        .on(
          'leave',
          () => {
            this.pageNavigation.nRoot.classList.remove('page-navigation_contrast');
          },
        );

      this.scene3.addTo(this.pageNavigation.ctrl);
    }
  }

  createSectionScenes() {
    if (this.pageNavigation.items.length < 2) {
      return;
    }
    this.pageNavigation.items.forEach((section, index) => {
      const scene1 = new ScrollMagic.Scene({
        triggerHook: 0.7,
        triggerElement: section.node,
        offset: -1,
      })
        .on('enter', () => { this.pageNavigation.activeIndex += 1; this.pageNavigation.updateView(); })
        .on('leave', () => { this.pageNavigation.activeIndex -= 1; this.pageNavigation.updateView(); });
      scene1.addTo(this.pageNavigation.ctrl);
      this.sectionScenes.push(scene1);

      const scene2 = new ScrollMagic.Scene({
        triggerHook: 0.7,
        triggerElement: section.node,
        duration: innerHeight(section.node),
      })
        .setTween(this.pageNavigation.nFindSingle(`anchor[data-anchor="${index + 1}"]`).querySelector('.page-navigation__progress-value'), { height: '100%' });
      scene2.addTo(this.pageNavigation.ctrl);
      this.sectionScenes.push(scene2);
    });
  }

  addReactionToAnchors() {
    listen('page-navigation:anchor-click', (payload) => {
      if (this.simpleBar) {
        const iScroll = $.fn.fullpage.test.options.scrollOverflowHandler.iScrollInstances;
        iScroll[0].scrollToElement(payload.detail.nSection, 500, 0, -FIXED_HEADER_HEIGHT_PX);
      } else {
        TweenMax.to(
          window, 0.5, { scrollTo: { y: offset(payload.detail.nSection).top - FIXED_HEADER_HEIGHT_PX } },
        );
      }
    }, this.pageNavigation.nRoot);
  }

  destroy(removePageNavigation = true) {
    this.pageNavigation.clearAnchors();
    this.scene1.destroy(true);
    this.scene2.destroy(true);
    this.pageNavigation.ctrl.destroy(true);
    this.sectionScenes.forEach(scene => scene.destroy(true));
    if (removePageNavigation) {
      this.pageNavigation.nRoot.parentNode.removeChild(this.pageNavigation.nRoot);
    }
  }
}

export default PageNavigationController;
