import Component from '../../common/js/component';
import Video from '../video/video';

class VideoBlock extends Component {
  constructor(nRoot) {
    super(nRoot, 'video-block');

    this.video = new Video(this.nFindSingle('video'))

  }

  destroy() {
      // this.video.destroy()
  }
}

export default VideoBlock;
