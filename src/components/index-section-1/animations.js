import TimelineMax from 'TimelineMax';
import { commonComponents } from '../../common/js/commonComponents';

const clearProps = section => {
  new TimelineMax()
    .set(
      [
        // section.nTitle1Lines,
        section.nFind('title-2'),
        section.nText1Lines,
        section.nFind('title-3'),
        section.nFind('text-2'),
      ],
      { clearProps: 'all' },
    )
    .set([commonComponents.footer.nRoot, ], { clearProps: 'opacity, visibility' });
};

const appearAnim = (section, delay = 0) => {
  clearProps(section);
  return new TimelineMax()
    .delay(delay)
    .addLabel('start')
    // .staggerFromTo(
    //   section.nTitle1Lines,
    //   0.5,
    //   { autoAlpha: 0, yPercent: 25 },
    //   {
    //     autoAlpha: 1, yPercent: 0, clearProps: 'all', ease: Power0.easeOut,
    //   },
    //   0.15,
    // )
    .fromTo(commonComponents.footer.nRoot, 0.45, { autoAlpha: 0 }, { autoAlpha: 1, clearProps: 'opacity, visibility' }, 'start+=0.1',)
    .fromTo(
      section.nFind('title-2'),
      0.4,
      { autoAlpha: 0 },
      { autoAlpha: 1, clearProps: 'all' },
      '-=.4',
    )
    .staggerFromTo(
      section.nText1Lines,
      0.4,
      { autoAlpha: 0, yPercent: 25 },
      {
        autoAlpha: 1, yPercent: 0, clearProps: 'all', ease: Power0.easeOut,
      },
      0.1,
      '-=.2',
    )
    .addLabel('label1')
    .staggerFromTo(
      section.nFind('title-3'),
      0.5,
      { autoAlpha: 0, xPercent: -100 },
      {
        autoAlpha: 1, xPercent: 0, clearProps: 'all', ease: Power0.easeOut,
      },
      0.2,
      'label1-=.1',
    )
    .call(() => {
      section.valueIncreasers.forEach((valueIncreaser, i) => setTimeout(valueIncreaser.run(), i * 0.2));
    }, [], null, 'label1+=.3')
    .staggerFromTo(
      section.nFind('text-2'),
      0.65,
      { autoAlpha: 0, xPercent: -100 },
      {
        autoAlpha: 1, xPercent: 0, clearProps: 'all', ease: Power0.easeOut,
      },
      0.2,
      'label1+=.05',
    );
};

export {
  clearProps,
  appearAnim,
};
