import TimelineMax from 'TimelineMax';

const hide = root => {
  return new TimelineMax()
    .set(root.nFindSingle('kw'), { autoAlpha: 0, yPercent: 100 })
    .set(root.nFindSingle('full-name'), { autoAlpha: 0, yPercent: 100 })
    .set(root.nFindSingle('link'), { autoAlpha: 0, yPercent: 100 })
    .set(root.nFindSingle('col-2'), { autoAlpha: 0, yPercent: 25 });
};

const anim = root => {
  return new TimelineMax()
    .to(root.nFindSingle('kw'), .5, { autoAlpha: 1, yPercent: 0 })
    .to(root.nFindSingle('full-name'), .5, { autoAlpha: 1, yPercent: 0 }, .25)
    .to(root.nFindSingle('link'), .5, { autoAlpha: 1, yPercent: 0 }, .5)
    .to(root.nFindSingle('col-2'), .5, { autoAlpha: 1, yPercent: 0 }, .25);
};

export {
  hide,
  anim
};
