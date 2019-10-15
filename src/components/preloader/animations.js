import TimelineMax from 'TimelineMax';

const appearAnim = (section, delay = 0) => {
  return new TimelineMax()
    .delay(delay)
    .addLabel('start')
    .staggerTo(
      section.nFind('title-1-text'),
      0.5,
      {
        transform: 'translateY(0)', ease: Power1.easeIn,
      },
      0,
    )
    .to(
      section.nFind('title-1-word'),
      0,
      {
        overflow: 'visible',
      },
      '-=.05',
    );
};

export {
  appearAnim,
};
