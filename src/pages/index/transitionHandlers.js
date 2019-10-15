import TimelineMax from 'TimelineMax';
import TweenMax from 'TweenMax';
import { commonComponents } from '../../common/js/commonComponents';
import {
  prepareForShiftBottomAnim as prepareForShiftBottomAnimHeader,
  destroyShiftBottomAnim as destroyShiftBottomAnimHeader,
} from '../../components/header/animations';
import {
  appearAnim as appearAnimSec1,
} from '../../components/index-section-1/animations';
import {
  prepareForAppearAnim as prepareForAppearElectroLinesAnim,
  appearAnim as appearElectroLinesAnim
} from '../../components/electro-lines/animations';
import {
  prepareForAppearAnim as prepareForAppearServicesAnim,
  appearAnim as appearServicesAnim
} from '../../components/services/animations';
import {
  clearAnimation, nGetBody,
  prependChild,
  waitForEvent,
  waitForGSAPAnimationEnd
} from '../../common/js/helpers';

const FADE_DURATION_S = 0.35;

const destroySec1Anim = async scrolling => {
  const solution = scrolling.sections[1].solutions.activeSlide;
  const nSolution = solution.nRoot;
  nSolution.classList.remove('change-to-this');
  nSolution.classList.remove('change-from-this');
  clearAnimation(nSolution);
  nSolution.classList.add('change-from-this');
  nSolution.classList.add('increased-speed');
  await waitForEvent(solution.nFindSingle('name'), 'animationend');
  nSolution.classList.remove('change-to-this');
  nSolution.classList.remove('change-from-this');
  nSolution.classList.remove('increased-speed');
  clearAnimation(nSolution);
};

const buildSec1Anim = async scrolling => {
  const solution = scrolling.sections[1].solutions.activeSlide;
  const nSolution = solution.nRoot;
  nSolution.classList.remove('change-to-this');
  nSolution.classList.remove('change-from-this');
  clearAnimation(nSolution);
  nSolution.classList.add('change-to-this');
  await waitForEvent(solution.nFindSingle('link'), 'animationend');
  nSolution.classList.remove('change-to-this');
  nSolution.classList.remove('change-from-this');
  clearAnimation(nSolution);
};

const sec1FadeInAnim = async (scrolling, nContainer) => {
  const solutions = scrolling.sections[1].solutions;
  const nSolutionsCopy = solutions.nRoot.cloneNode(true);
  nSolutionsCopy.classList.add('solutions_fade-animation');
  [...nSolutionsCopy.querySelectorAll('[data-content]')].forEach(node => node.style.display = 'none');
  [...nSolutionsCopy.querySelectorAll('.solution__bg')].forEach(node => node.style.display = 'none');
  nContainer.appendChild(nSolutionsCopy);
  await waitForGSAPAnimationEnd(
    TweenMax
      .fromTo(nSolutionsCopy, FADE_DURATION_S, { autoAlpha: 0 }, { autoAlpha: 1, clearProps: 'opacity, visibility' }, 0),
  );
  nContainer.removeChild(nSolutionsCopy);
};

const sec1FadeOutAnim = async (scrolling, nContainer, fadeDurationS = FADE_DURATION_S) => {
  const solutions = scrolling.sections[1].solutions;
  const nSolutionsCopy = solutions.nRoot.cloneNode(true);
  nSolutionsCopy.classList.add('solutions_fade-animation');
  [...nSolutionsCopy.querySelectorAll('[data-content]')].forEach(node => node.style.display = 'none');
  [...nSolutionsCopy.querySelectorAll('.solution__bg')].forEach(node => node.style.display = 'none');
  nContainer.appendChild(nSolutionsCopy);
  await waitForGSAPAnimationEnd(
    new TimelineMax()
      .fromTo(nSolutionsCopy, fadeDurationS, { autoAlpha: 1 }, { autoAlpha: 0, clearProps: 'opacity, visibility' }, 0)
  );
  nContainer.removeChild(nSolutionsCopy);
};

const before = {
  0: async (scrolling, prevSlideIndex) => {
    await destroySec1Anim(scrolling);
    TweenMax.set(commonComponents.footer.nRoot, { autoAlpha: 0 });
    commonComponents.footer.setFullOpacity(false);
    commonComponents.footer.nRoot.classList.remove('footer_big');
    nGetBody().appendChild(commonComponents.footer.nRoot);
  },
  1: async (scrolling, prevSlideIndex, currentSlideIndex) => {
    if (prevSlideIndex < currentSlideIndex) {
      const section0 = scrolling.sections[0];
      const appearAnimSec1Inst = appearAnimSec1(section0);
      appearAnimSec1Inst.reverse(0);
      appearAnimSec1Inst.timeScale(3.5);
      await waitForGSAPAnimationEnd(appearAnimSec1Inst);
      await sec1FadeInAnim(scrolling, section0.nRoot);
    } else {
      const section2 = scrolling.sections[2];
      section2.services.disableElectroLines();
      await sec1FadeInAnim(scrolling, section2.services.nRoot);
      destroyShiftBottomAnimHeader(section2.nRoot);
    }
  },
  2: async (scrolling, prevSlideIndex) => {
    await destroySec1Anim(scrolling);
    prepareForAppearElectroLinesAnim(scrolling.sections[2].services.electroLines);
    prepareForAppearServicesAnim(scrolling.sections[2].services);
  },
};

const after = {
  0: async (scrolling, prevSlideIndex) => {
    const section0 = scrolling.sections[0];
    await sec1FadeOutAnim(scrolling, section0.nRoot);
    await waitForGSAPAnimationEnd(appearAnimSec1(section0).timeScale(1.5));
    scrolling.sections[1].solutions.swiper.autoplay.stop();
  },
  1: async (scrolling, prevSlideIndex, currentSlideIndex) => {
    if (prevSlideIndex > currentSlideIndex) {
      prependChild(nGetBody(), commonComponents.header.nRoot);
      commonComponents.header.nRoot.style.position = 'fixed';
      prependChild(nGetBody(), commonComponents.footer.nRoot);
      commonComponents.footer.nRoot.style.position = 'fixed';
    }
    await buildSec1Anim(scrolling);
    scrolling.sections[1].solutions.swiper.autoplay.start();
  },
  2: async (scrolling, prevSlideIndex) => {
    const section2 = scrolling.sections[2];
    prepareForShiftBottomAnimHeader(section2.services.nRoot);
    commonComponents.footer.fixToContainerBottom(section2.nFindSingle('wrapper'));
    TweenMax.set(commonComponents.footer.nRoot, { clearProps: 'opacity, visibility' });
    await sec1FadeOutAnim(scrolling, section2.services.nRoot, .75);
    section2.services.enableElectroLines();
    await appearElectroLinesAnim(section2.services.electroLines);
    appearServicesAnim(section2.services);
    scrolling.sections[1].solutions.swiper.autoplay.stop();
  },
};

export default {
  before,
  after,
};
