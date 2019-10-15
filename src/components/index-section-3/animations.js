import TimelineMax from 'TimelineMax';
import TweenMax from 'TweenMax';
import 'animation.gsap';
import ScrollMagic from 'scrollmagic';
import { nFindComponents, nFindComponent, innerHeight } from '../../common/js/helpers';

const prepareForAnim = (section) => {
  const clockBgHeight = innerHeight(section.clock.nFindSingle('bg'));
  new TimelineMax()
    .set(nFindComponent('services-description', section.nRoot), { autoAlpha: 0 })
    .set(nFindComponents('service', section.services.nRoot), { autoAlpha: 0 })
    .set(section.projects.nFindSingle('title'), { autoAlpha: 0, yPercent: 100 })
    .set(section.projects.nFind('swiper-container'), { autoAlpha: 0, xPercent: 25, className: '+=no-transition' })
    .set(section.projects.projectsNavigation.nFindSingle('arrow_next'), { autoAlpha: 0 })
    .set(section.projects.projectsNavigation.nFindSingle('arrow_prev'), { autoAlpha: 0 })
    .set(section.projects.projectsNavigation.nFindSingle('text'), { autoAlpha: 0 })
    .set(section.subscribeToNews.nFindSingle('bg'), { xPercent: -75 })
    .set(section.subscribeToNews.nFindSingle('label'), { autoAlpha: 0, yPercent: 50 })
    .set(section.subscribeToNews.nFindSingle('textfield'), { autoAlpha: 0, yPercent: 50, backgroundColor: 'transparent' })
    .set(
      section.subscribeToNews.nFindSingle('button-wrapper'),
      { autoAlpha: 0, yPercent: 50, backgroundColor: 'transparent' },
    )
    .set(
      section.news.newsPreviews.map(newsPreview => newsPreview.nFindSingle('top')),
      { autoAlpha: 0, xPercent: -10 },
    )
    .set(
      section.news.newsPreviews.map(newsPreview => newsPreview.nFindSingle('bottom')),
      { autoAlpha: 0 },
    )
    .set(
      section.news.nFind('all-news'),
      { autoAlpha: 0 },
    )
    .set(section.clock.nFindSingle('bg'), { backgroundColor: 'transparent' })
    .set(section.contacts.nRoot, { backgroundColor: 'transparent' })
    .set(
      section.contacts.nFindSingle('animation-bg'),
      {
        xPercent: 75,
        autoAlpha: 1,
        y: -clockBgHeight,
        height: `${clockBgHeight + innerHeight(section.contacts.nFindSingle('animation-bg'))}px`
      }
    )
    .set(section.contacts.nFind('row-1'), { autoAlpha: 0, position: 'relative', zIndex: 2, })
    .set(section.contacts.nFind('row-2'), { autoAlpha: 0, position: 'relative', zIndex: 2, })
    .set(section.contacts.nFind('row-3'), { autoAlpha: 0, position: 'relative', zIndex: 2, });
};

const rollbackPrepareForAnim = (section) => {
  new TimelineMax()
    .set(nFindComponent('services-description', section.nRoot), { clearProps: 'all' })
    .set(nFindComponents('service', section.services.nRoot), { clearProps: 'all' })
    .set(section.projects.nFindSingle('title'), { clearProps: 'all' })
    .set(section.projects.nFind('swiper-container'), { clearProps: 'all' })
    .set(section.projects.projectsNavigation.nFindSingle('arrow_next'), { clearProps: 'all' })
    .set(section.projects.projectsNavigation.nFindSingle('arrow_prev'), { clearProps: 'all' })
    .set(section.projects.projectsNavigation.nFindSingle('text'), { clearProps: 'all' })
    .set(section.subscribeToNews.nFindSingle('bg'), { clearProps: 'all' })
    .set(section.subscribeToNews.nFindSingle('label'), { clearProps: 'all' })
    .set(section.subscribeToNews.nFindSingle('textfield'), { clearProps: 'all' })
    .set(
      section.subscribeToNews.nFindSingle('button-wrapper'), { clearProps: 'all' },
    )
    .set(
      section.news.newsPreviews.map(newsPreview => newsPreview.nFindSingle('top')),
      { clearProps: 'all' },
    )
    .set(
      section.news.newsPreviews.map(newsPreview => newsPreview.nFindSingle('bottom')),
      { clearProps: 'all' },
    )
    .set(
      section.news.nFind('all-news'),
      { clearProps: 'all' },
    )
    .set(section.clock.nFindSingle('bg'), { clearProps: 'all' })
    .set(section.contacts.nRoot, { clearProps: 'all' })
    .set(
      section.contacts.nFindSingle('animation-bg'), { clearProps: 'all' }
    )
    .set(section.contacts.nFind('row-1'), { clearProps: 'all' })
    .set(section.contacts.nFind('row-2'), { clearProps: 'all' })
    .set(section.contacts.nFind('row-3'), { clearProps: 'all' });
};

let ctrl;
const scenes = [];

const initAppearAnim = (section) => {
  ctrl = new ScrollMagic.Controller();
  scenes.push(new ScrollMagic.Scene({
    triggerElement: section.services.nRoot,
    triggerHook: 0.75,
  })
    .setTween(
      new TimelineMax()
        .to(nFindComponent('services-description', section.nRoot), 1, { autoAlpha: 1, clearProps: 'all' }, 0)
        .to(nFindComponents('service', section.services.nRoot), 1, { autoAlpha: 1, clearProps: 'all' }, 0),
    )
    .reverse(false)
    .addTo(ctrl));
  scenes.push(new ScrollMagic.Scene({
    triggerElement: section.projects.nRoot,
    triggerHook: 0.75,
  })
    .setTween(
      new TimelineMax()
        .to(section.projects.nFindSingle('title'), 1, { autoAlpha: 1, yPercent: 0, clearProps: 'all' }, 0)
        .staggerTo(section.projects.nFind('swiper-container'), 0.75, { autoAlpha: 1, xPercent: 0, clearProps: 'autoAlpha, xPercent' }, 0.15, '-=0.75')
        .set(section.projects.nFind('swiper-container'), { className: '-=no-transition' })
        .to(section.projects.projectsNavigation.nFindSingle('arrow_prev'), 0.75, { autoAlpha: 1, clearProps: 'all' }, '-=0.75')
        .to(section.projects.projectsNavigation.nFindSingle('arrow_next'), 0.75, { autoAlpha: 1, clearProps: 'all' }, '-=0.45')
        .to(section.projects.projectsNavigation.nFindSingle('text'), 0.75, { autoAlpha: 1, clearProps: 'all' }, '-=0.45'),
    )
    .reverse(false)
    .addTo(ctrl));
  scenes.push(new ScrollMagic.Scene({
    triggerElement: section.subscribeToNews.nRoot,
    triggerHook: 1,
  })
    .setTween(
      new TimelineMax()
        .to(section.subscribeToNews.nFindSingle('bg'), 0.75, { xPercent: 0, clearProps: 'all' }, 0)
        .to(section.subscribeToNews.nFindSingle('label'), 0.25, { autoAlpha: 1, yPercent: 0, clearProps: 'all' }, 0.5)
        .to(section.subscribeToNews.nFindSingle('animation-textfield-bg'), 0.5, { autoAlpha: 1, scaleX: 1 }, 0.25)
        .to(section.subscribeToNews.nFindSingle('textfield'), 0.25, { autoAlpha: 1, yPercent: 0, clearProps: 'all' }, 0.6)
        .to(section.subscribeToNews.nFindSingle('button-wrapper'), 0.25, { autoAlpha: 1, yPercent: 0, clearProps: 'all' }, 0.7)
        .set(section.subscribeToNews.nFindSingle('animation-textfield-bg'), { clearProps: 'all' }),
    )
    .reverse(false)
    .addTo(ctrl));
  scenes.push(new ScrollMagic.Scene({
    triggerElement: section.news.nRoot,
    triggerHook: 0.75,
  })
    .setTween(
      new TimelineMax()
        .staggerTo(section.news.newsPreviews.map(newsPreview => newsPreview.nFindSingle('top')), 0.75, { autoAlpha: 1, xPercent: 0, clearProps: 'all' }, 0.15, 0)
        .addLabel('label', '-=0.75')
        .to(section.news.newsPreviews.map(newsPreview => newsPreview.nFindSingle('bottom')), 0.75, { autoAlpha: 1, clearProps: 'all' }, 'label')
        .to(section.news.nFind('all-news'), 0.75, { autoAlpha: 1, clearProps: 'all' }, 'label'),
    )
    .reverse(false)
    .addTo(ctrl));
  scenes.push(new ScrollMagic.Scene({
    triggerElement: section.contacts.nFind('animation-bg'),
    triggerHook: 1,
  })
    .setTween(
      new TimelineMax()
        .to(section.contacts.nFind('animation-bg'), 0.75, { xPercent: 0, clearProps: 'all', })
        .set(section.clock.nFindSingle('bg'), { clearProps: 'all' })
        .set(section.contacts.nRoot, { clearProps: 'all' })
        .set(section.news.nFind('animation-bg'), { clearProps: 'all' })
    )
    .reverse(false)
    .addTo(ctrl));

  scenes.push(new ScrollMagic.Scene({
    triggerElement: section.contacts.nFindSingle('row-1'),
    triggerHook: 0.9,
  })
    .setTween(
      TweenMax.to(section.contacts.nFind('row-1'), 0.9, { autoAlpha: 1 })
    )
    .reverse(false)
    .addTo(ctrl));

  scenes.push(new ScrollMagic.Scene({
    triggerElement: section.contacts.nFindSingle('row-2'),
    triggerHook: 0.9,
  })
    .setTween(
      TweenMax.to(section.contacts.nFind('row-2'), 0.9, { autoAlpha: 1 })
    )
    .reverse(false)
    .addTo(ctrl));

  scenes.push(new ScrollMagic.Scene({
    triggerElement: section.contacts.nFindSingle('row-3'),
    triggerHook: 0.9,
  })
    .setTween(
      TweenMax.to(section.contacts.nFind('row-3'), 0.9, { autoAlpha: 1 })
    )
    .reverse(false)
    .addTo(ctrl));
};

const destroyAppearAnim = () => {
  scenes.forEach(scene => scene.destroy());
  if (ctrl) {
    ctrl.destroy();
  }
};

export {
  prepareForAnim,
  initAppearAnim,
  destroyAppearAnim,
  rollbackPrepareForAnim,
};
