import TimelineMax from 'TimelineMax';
import TweenMax from 'TweenMax';

const prepareForAppearAnim = services => {
  return new TimelineMax()
    .set(services.services.map(service => service.nTextLines), { autoAlpha: 0 })
    .set(services.services.map(service => service.nFindSingle('index')), { autoAlpha: 0 });
};

const appearAnim = services => {
  const tll = new TimelineMax();
  services.services.map(service => {
    tll.staggerFromTo(
      service.nTextLines,
      0.4,
      { autoAlpha: 0, yPercent: 25 },
      {
        autoAlpha: 1, yPercent: 0, clearProps: 'all', ease: Power0.easeOut,
      },
      0.1,
      0,
    );
  });
  tll.fromTo(
    services.services.map(service => service.nFindSingle('index')),
    0.4,
    { autoAlpha: 0 },
    { autoAlpha: 1, clearProps: 'all', ease: Power0.easeOut, },
    0,
  );
};

export {
  prepareForAppearAnim,
  appearAnim,
};
