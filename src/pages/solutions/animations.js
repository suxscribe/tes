import ScrollMagic from 'scrollmagic';
import { nFindComponents } from '../../common/js/helpers';
import { anim as blockAnim } from '../../components/info-block-1/animations';
import { anim as solutionAnim } from '../../components/solution-inner/animations';

let ctrl, scenes = [];

const prepareAnim = (infoBlocks, solutionsInner) => {
  ctrl = new ScrollMagic.Controller();
  infoBlocks.forEach(infoBlock => {
    const scene = new ScrollMagic.Scene({
      triggerElement: infoBlock.nRoot,
      triggerHook: 0.75,
    })
      .on('enter', () => {
        blockAnim(infoBlock);
      })
      .addTo(ctrl);
    scenes.push(scene);
  });
  solutionsInner.forEach(solutionInner => {
    const scene = new ScrollMagic.Scene({
      triggerElement: solutionInner.nRoot,
      triggerHook: 0.9,
    })
      .on('enter', () => {
        solutionAnim(solutionInner);
      })
      .addTo(ctrl);
    scenes.push(scene);
  });
};

const destroyAnim = () => {
  scenes.forEach(scene => scene.destroy());
  ctrl.destroy();
};

export {
  prepareAnim,
  destroyAnim
};
