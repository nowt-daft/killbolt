export default class SongPlayer {
	static PLAYING = 'playing';

	#song;
	#state_callback =
		(song = new SongPlayer) => song && void 0;
	/**
	 * @param  {HTMLAudioElement}   song
	 * @param  {HTMLButtonElement}  play_btn
	 * @param  {HTMLButtonElement}  pause_btn
	 */
	constructor(
		song,
		play_btn,
		pause_btn
	) {
		this.#song = song;
		song.load();
		song.onplay = () => {
			song.parentElement.parentElement.classList.add(
				SongPlayer.PLAYING
			);
		};
		song.onpause = () => {
			song.parentElement.parentElement.classList.remove(
				SongPlayer.PLAYING
			);
		};
		play_btn.addEventListener(
			'click',
			() => this.#state_callback(this) ?? song.play()
		);
		pause_btn.addEventListener(
			'click',
			() => song.pause()
		);
	}

	play() {
		this.#song.play();
	}

	pause() {
		this.#song.pause();
	}
	
	listen(
		callback =
			(song = new SongPlayer) => song && void 0
	) {
		this.#state_callback = callback;
	}
}
