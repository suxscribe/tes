import TimelineMax from 'TimelineMax';

const hide = root => {
  return new TimelineMax()
    .set(root.nFindSingle('title'), { autoAlpha: 0, yPercent: 100 })
    .set(root.nFindSingle('text-2'), { autoAlpha: 0, yPercent: 100 });
};

const anim = root => {
  return new TimelineMax()
    .to(root.nFindSingle('title'), .5, { autoAlpha: 1, yPercent: 0 })
    .to(root.nFindSingle('text-2'), .5, { autoAlpha: 1, yPercent: 0 }, 0);
};

export {
  hide,
  anim
};
