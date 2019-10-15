import YouTubeIframeLoader from 'youtube-iframe';
import Component from '../../common/js/component';

class Video extends Component {
  constructor(nRoot) {
    super(nRoot, 'video');
    this.bgWrapper = this.nFindSingle('bg-wrapper');
    this.button = this.nFindSingle('button');
    this.videoYT = this.nRoot.querySelector('.video__item_youtube');
    if (this.videoYT) {
      this.youtubeReady = this.youtubeReady.bind(this);
      this.onPlayerReady = this.onPlayerReady.bind(this);
      this.onPlayerStateChange = this.onPlayerStateChange.bind(this);
      setTimeout(() => { this.youtubeReady(this.nRoot); }, 1);
    } else {
      this.videoPlay = this.videoPlay.bind(this);
      this.bgWrapper.addEventListener('click', this.videoPlay, false);
    }
  }

  youtubeReady(item) {
    const video = item.querySelector('.video__item_youtube');
    const embed = video.getAttribute('data-embed');
    YouTubeIframeLoader.load((YT) => {
      this.player = new YT.Player(video.id ? video.id : video, {
        height: '100%',
        width: '100%',
        videoId: `${embed}`,
        playerVars: {
          autoplay: 0,
          rel: 0,
          showinfo: 0,
          controls: 0,
          modestbranding: 1,
        },
        events: {
          onReady: this.onPlayerReady,
          onStateChange: this.onPlayerStateChange,
        },
      });
    });
  }

  onPlayerReady(event) {
    this.bgWrapper.addEventListener('click', () => {
      this.bgWrapper.classList.add('video__bg-wrapper_hide');
      this.button.classList.add('video__button_hide');
      this.player.playVideo();
    });
    this.button.addEventListener('click', () => {
      this.bgWrapper.classList.add('video__bg-wrapper_hide');
      this.button.classList.add('video__button_hide');
      this.player.playVideo();
    });
  }

  onPlayerStateChange(event) {
    if (event.data === YT.PlayerState.PLAYING) {
      this.nRoot.querySelector('.video__item_youtube').classList.add('video__item_active');
    }
    if (event.data === YT.PlayerState.PAUSED) {
      if (this.button.classList.contains('video__button_hide')) {
        this.button.classList.remove('video__button_hide');
        this.bgWrapper.classList.remove('video__bg-wrapper_hide');
        this.nRoot.querySelector('.video__item_youtube').classList.remove('video__item_active');
      }
    }
  }

  videoPlay(e) {
    this.videoInner = this.nFindSingle('item_inner');
    if (this.videoInner) {
      if (this.videoInner.paused) {
        this.videoInner.play();
        this.button.classList.add('video__button_hide');
      } else {
        this.videoInner.pause();
        this.button.classList.remove('video__button_hide');
      }
    }
  }

  pause() {
    this.videoInner = this.nFindSingle('item_inner');
    if (this.button.classList.contains('video__button_hide')) {
      this.button.classList.remove('video__button_hide');
    }
    if (this.videoInner) {
      this.videoInner.pause();
      this.videoInner.currentTime = 0;
    } else {
      this.player.stopVideo();
      this.bgWrapper.classList.remove('video__bg-wrapper_hide');
      this.nRoot.querySelector('.video__item_youtube').classList.remove('video__item_active');
    }
  }

  destroy() {
    this.player.destroy();
    if (!(this.videoYT)) {
      this.bgWrapper.removeEventListener('click', this.videoPlay, false);
    }
  }
}

export default Video;
