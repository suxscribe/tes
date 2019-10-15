import TimelineMax from 'TimelineMax';
import { nFindComponent, innerHeight } from '../../common/js/helpers';

const appearAnimStart = (section, delay = 0) => {
  new TimelineMax()
    .set(
      [
        section.nFind('title-1'),
        section.nFind('title-2'),
        section.nText1Lines,
        section.nFind('text-2'),
        section.nFind('arrow-wrapper'),
        section.nFind('arrow'),
        section.nFind('bg-wrapper'),
        section.nFind('bg'),
      ],
      { clearProps: 'all' },
    );
  return new TimelineMax()
    .delay(delay)
    .addLabel('start')
    .fromTo(
      section.nFind('title-1'),
      0.5,
      { autoAlpha: 0, yPercent: 15 },
      {
        autoAlpha: 1, yPercent: 0, clearProps: 'all', ease: Power1.easeOut,
      },
      '-=.3',
    )
    .fromTo(
      section.nFind('title-2'),
      0.5,
      { autoAlpha: 0, yPercent: 15 },
      {
        autoAlpha: 1, yPercent: 0, clearProps: 'all', ease: Power1.easeOut,
      },
      '-=.4',
    )
    .staggerFromTo(
      section.nText1Lines,
      0.4,
      { autoAlpha: 0, yPercent: 25 },
      {
        autoAlpha: 1, yPercent: 0, clearProps: 'all', ease: Power1.easeOut,
      },
      0.1,
      '-=.4',
    )
    .fromTo(
      section.nFind('text-2'),
      0.5,
      { autoAlpha: 0, yPercent: 15 },
      {
        autoAlpha: 1, yPercent: 0, clearProps: 'all', ease: Power1.easeOut,
      },
      '-=.3',
    )
    .fromTo(
      section.nFind('arrow-wrapper'),
      0.4,
      { autoAlpha: 0, yPercent: -10 },
      {
        autoAlpha: 1, yPercent: 0, clearProps: 'all', ease: Power1.easeOut,
      },
      '-=.4',
    )
    .fromTo(
      section.nFind('arrow'),
      0.4,
      { autoAlpha: 0 },
      { autoAlpha: 1, clearProps: 'all', ease: Power1.easeOut },
      '-=.2',
    )
    .fromTo(
      section.nFind('bg-wrapper'),
      0.6,
      { autoAlpha: 0 },
      { autoAlpha: 1, clearProps: 'all', ease: Power1.easeOut },
      '-=.4',
    )
    .fromTo(
      section.nFind('bg'),
      0.6,
      { transform: 'translate(-50%, -45%)' },
      { transform: 'translate(-50%, -50%)', clearProps: 'all', ease: Power1.easeOut },
      '-=.6',
    );
};

const appearAnimTransit = (section, delay = 0) => {
  const miniMapHeight = '29.5vh';
  const mapHeight = innerHeight(document.querySelector('[data-product-section-1]'));
  new TimelineMax()
    .set(
      [
        section.nFind('row'),
        section.nFind('arrow-wrapper'),
        section.nFind('arrow'),
        section.nFind('col'),
        section.nFind('bg-wrapper'),
      ],
      { clearProps: 'all' },
    );
  return new TimelineMax()
    .delay(delay)
    .fromTo(
      section.nFind('row'),
      1,
      { autoAlpha: 1, yPercent: 0 },
      {
        autoAlpha: 0, yPercent: -200, clearProps: 'all', ease: Power2.easeIn,
      },
      0,
    )
    .fromTo(
      section.nFind('arrow-wrapper'),
      1,
      { autoAlpha: 1 },
      {
        autoAlpha: 0, ease: Power1.easeOut,
      },
      0,
    )
    .fromTo(
      section.nFind('arrow'),
      1,
      { autoAlpha: 1 },
      {
        autoAlpha: 0, ease: Power1.easeOut,
      },
      0,
    )
    .fromTo(
      section.nFind('col'),
      1,
      { className: '-=animate' },
      {
        className: '+=animate', delay: 0.5,
      },
      0,
    )
    .fromTo(
      section.nFind('bg-wrapper'),
      1,
      { height: miniMapHeight },
      {
        height: mapHeight, delay: 0.5,
      },
      0,
    );
};

const appearAnimTransitRollback = (section) => {
  new TimelineMax()
    .set(
      [
        section.nFind('title-1'),
        section.nFind('title-2'),
        section.nText1Lines,
        section.nFind('text-2'),
        section.nFind('arrow-wrapper'),
        section.nFind('arrow'),
        section.nFind('bg-wrapper'),
        section.nFind('bg'),
      ],
      { clearProps: 'all' },
    );
};

export {
  appearAnimStart,
  appearAnimTransit,
  appearAnimTransitRollback,
};
