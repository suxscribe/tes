import TimelineMax from 'TimelineMax';

const appearAnim = (slide, delay = 0) => {
  new TimelineMax()
    .set(
      [
        slide.nTitle1Lines,
        slide.nFind('kw'),
        slide.nFind('text'),
        slide.nFind('link'),
        slide.nFind('bg_desktop'),
      ],
      { clearProps: 'all' },
    );
  return new TimelineMax()
    .delay(delay)
    .addLabel('start')
    .fromTo(
      slide.nFind('bg_desktop'),
      0.5,
      { autoAlpha: 0, scale: 1.05 },
      {
        autoAlpha: 1, scale: 1, clearProps: 'all', ease: Power1.easeOut,
      },
      0.7,
    )
    .staggerFromTo(
      slide.nTitle1Lines,
      0.4,
      { autoAlpha: 0, yPercent: 50 },
      {
        autoAlpha: 1, yPercent: 0, clearProps: 'all', ease: Power1.easeOut,
      },
      0.1,
      0.7,
    )
    .fromTo(
      slide.nFind('kw'),
      0.5,
      { autoAlpha: 0, yPercent: 25 },
      {
        autoAlpha: 1, yPercent: 0, clearProps: 'all', ease: Power1.easeOut,
      },
      '-=.2',
    )
    .fromTo(
      slide.nFind('text'),
      0.5,
      { autoAlpha: 0, yPercent: 25 },
      {
        autoAlpha: 1, yPercent: 0, clearProps: 'all', ease: Power1.easeOut,
      },
      '-=.2',
    )
    .fromTo(
      slide.nFind('link'),
      0.5,
      { autoAlpha: 0, yPercent: 50 },
      {
        autoAlpha: 1, yPercent: 0, clearProps: 'all', ease: Power1.easeOut,
      },
      '-=.2',
    );
};

export {
  appearAnim,
};
