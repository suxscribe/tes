import TimelineMax from 'TimelineMax';

const appearAnim = (component, delay = 0) => {
  new TimelineMax()
    .set(
      [
        component.nFind('mask'),
        component.nFind('close'),
        component.nFind('header-logo'),
        component.nFind('header-link'),
        component.nFind('link'),
      ],
      { clearProps: 'all' },
    );
  return new TimelineMax()
    .delay(delay)
    .addLabel('start')
    .fromTo(
      component.nFind('close'),
      0.5,
      {
        autoAlpha: 0,
      },
      {
        autoAlpha: 1, clearProps: 'all', ease: Power1.easeIn,
      },
      0,
    )
    .fromTo(
      component.nFind('mask'),
      0.5,
      {
        transform: 'translateX(0)',
      },
      {
        transform: 'translateX(100%)', ease: Power2.easeIn,
      },
      0,
    )
    .fromTo(
      component.nFind('link'),
      0.5,
      {
        autoAlpha: 0, xPercent: '-10px',
      },
      {
        autoAlpha: 1, xPercent: 0, clearProps: 'all', ease: Power1.easeIn,
      },
      '-=.5',
    )
    .fromTo(
      component.nFind('header-logo'),
      0.5,
      {
        autoAlpha: 0,
      },
      {
        autoAlpha: 1, clearProps: 'all', ease: Power1.easeIn,
      },
      '-=.5',
    )
    .fromTo(
      component.nFind('header-link'),
      0.5,
      {
        autoAlpha: 0,
      },
      {
        autoAlpha: 1, clearProps: 'all', ease: Power1.easeIn,
      },
      '-=.3',
    );
};

export {
  appearAnim,
};
