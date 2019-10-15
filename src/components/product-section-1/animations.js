import TimelineMax from 'TimelineMax';

const appearAnimTransit = (section, delay = 0) => {
  new TimelineMax()
    .set(
      [
        section.nFind('title-1'),
        section.productMap.nFind('pins'),
        section.nFind('row'),
      ],
      { clearProps: 'all' },
    );
  return new TimelineMax()
    .delay(delay)
    .fromTo(
      section.nFind('title-1'),
      0.8,
      { autoAlpha: 0, yPercent: 50 },
      {
        autoAlpha: 1, yPercent: 0, clearProps: 'all', ease: Power2.easeOut,
      },
      0,
    )
    .fromTo(
      section.productMap.nFind('pins'),
      0.8,
      { autoAlpha: 0, yPercent: 5 },
      {
        autoAlpha: 1, yPercent: 0, clearProps: 'all', ease: Power2.easeOut,
      },
      0,
    )
    .fromTo(
      section.nFind('row'),
      0.8,
      { autoAlpha: 0, yPercent: 50 },
      {
        autoAlpha: 1, yPercent: 0, clearProps: 'all', ease: Power2.easeOut,
      },
      '-=.6',
    );
};

export {
  appearAnimTransit,
};
