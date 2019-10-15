import TimelineMax from 'TimelineMax';
import TweenMax from 'TweenMax';

const prepareForAppearAnim = electroLines => {
  TweenMax.set(electroLines.nFindSingle('canvas'), { autoAlpha: 0 });
};

const appearAnim = electroLines => {
  return new TimelineMax()
    .fromTo(
      electroLines.nFindSingle('canvas'),
      0.5,
      { autoAlpha: 0 },
      { autoAlpha: 1, clearProps: 'opacity, visibility' }
    );
};

export {
  prepareForAppearAnim,
  appearAnim,
};
