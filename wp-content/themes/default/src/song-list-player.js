import SongPlayer from "./song-player.js";

/**
 * @class SongListPlayer
 * @extends SongPlayer[]
 */
export default class SongListPlayer extends Array {
	#current_song;
	/**
	 * @param  {HTMLUListElement}  song_list
	 */
	constructor(song_list) {
		const list_items = [...song_list.children];
		super(
			...list_items.map(
				item => new SongPlayer(
					item.querySelector('audio'),
					item.querySelector('button.play'),
					item.querySelector('button.pause')
				)
			)
		);

		this.#current_song = this[0];

		for (const song of this) {
			song.listen(
				new_song => {
					this.#current_song.pause();
					this.#current_song = new_song;
				}
			);
		}
	}
}
