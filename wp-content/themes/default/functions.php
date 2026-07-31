<?php
if (
	!defined('ABSPATH')
) exit;

require_once WP_CONTENT_DIR . '/includes/render.php';
require_once WP_CONTENT_DIR . '/includes/save.php';
require_once WP_CONTENT_DIR . '/includes/style.php';
require_once WP_CONTENT_DIR . '/includes/type.php';

/**
 * REQUIRE ALL FILES IN THE TYPES/ DIRECTORY
 */
$TYPES_DIR = __DIR__ . '/types/';
$nodes = scandir($TYPES_DIR);

foreach ($nodes as $node) {
	$file = $TYPES_DIR . $node;
	if (is_file($file)) {
		require_once $file;
	}
}
/**/

add_action(
	'wp_enqueue_scripts',
	function() {
		// STYLESHEETS
		add_style("fonts");
		wp_enqueue_style(
			'theme-stylesheet',
			get_stylesheet_uri() .
			'?cache_kill=' . rand()
		);
		// add_style('generic');
		// add_style('components/menu');
		// add_style('views/home')
		// etc...

		// JAVASCRIPT
		wp_enqueue_script_module(
			'main',
			get_theme_file_uri() .
			'/src/main.js?cache_kill=' . rand()
		);
	}
);
add_action(
	'admin_enqueue_scripts',
	function() {
		add_style('admin');
	}
);

/**
 * HIDE ADMIN BAR WHEN LOGGED-IN
 */
add_filter(
	'show_admin_bar',
	'__return_false'
);

/**
 * ALLOW IMAGE UPLOADS
 */
add_action(
	'post_edit_form_tag',
	function() {
		echo ' enctype=\"multipart/form-data\"';
	}
);

