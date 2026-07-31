import SongListPlayer from "./song-list-player.js";

// const OVERLAY_STATE = 'open';
// const DISABLED_STATE = 'disabled';
const VISIBLE_STATE = 'visible';

// const handle = document.querySelector('section.chrome');
// const aside = document.querySelector('aside.website');

const body = document.querySelector('.body');
const heading = document.querySelector(
	'.body > header > h1'
);

new SongListPlayer(
	body.querySelector('.song-player ul')
);

// handle.addEventListener(
// 	'click',
// 	() => {
// 		aside.classList.toggle(OVERLAY_STATE);
// 		document.body.classList.toggle(DISABLED_STATE);
// 	}
// );

const spans = [...heading.textContent.trim()].map(
	(letter, index) => {
		const span = document.createElement('span');
		letter = letter.toLowerCase();
		span.className = letter;
		if (index == 2)
			span.style.setProperty('--delay', '2s');
		// span.textContent = letter;
		return span;
	}
);

heading.innerHTML = '';
heading.append(...spans);
setTimeout(
	() => {
		heading.classList.add(VISIBLE_STATE);
	},
	1500
);

