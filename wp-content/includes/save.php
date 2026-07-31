<?php
function save_meta_value(
	$post_id,
	$post_meta_key,
	$callback = null
) {
	$post_meta_value = $_POST[$post_meta_key] ?? '';
	
	if (
		empty($post_meta_value)
	) return;

	if (
		is_callable($callback)
	)
		$post_meta_value = $callback($post_meta_value);

	update_post_meta(
		$post_id,
		$post_meta_key,
		$post_meta_value
	);
}

function save_meta(
	$post_id,
	$post_keys
) {
	foreach ($post_keys as $post_meta_key) {
		save_meta_value(
			$post_id,
			$post_meta_key
		);
	}
}

function upload_image(
	$id,
	$name
) {
	if (empty(
		$_FILES[$name]['name']
	)) {
		return;
	}

	$supported_types = array(
		'image/jpeg',
		'image/png',
		'image/webp',
	);

	$uploaded_type = wp_check_filetype(
		basename($_FILES[$name]['name'])
	)['type'];

	if (
		!in_array(
			$uploaded_type,
			$supported_types
		)
	) {
		wp_die('The file uploaded is not a supported image format.');
	}

	$upload = wp_upload_bits(
		$_FILES[$name]['name'],
		null,
		file_get_contents(
			$_FILES[$name]['tmp_name']
		)
	);

	if (
		isset($upload['error']) &&
		$upload['error'] != 0
	) {
		wp_die('Error with image upload: ' . $upload['error']);
	}
	
	add_post_meta($id, $name, $upload);
	update_post_meta($id, $name, $upload);
}

