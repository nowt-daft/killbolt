<?php
function add_style(string $style_name) {
	wp_enqueue_style(
		$style_name . '-stylesheet',
		get_stylesheet_directory_uri() . '/css/' .
			$style_name . '.css?cache_kill=' . rand()
	);
}
