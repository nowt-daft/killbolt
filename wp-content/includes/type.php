<?php
function generate_type_labels(
	$singular,
	$plural
) {
	return [
		'name'          => $plural,
		'singular_name' => $singular,
		'add_new'       => 'Add ' . $singular,
		'add_new_item'  => 'Add ' . $singular,
		'edit_item'     => 'Edit ' . $singular,
		'new_item'      => 'New ' . $singular,
		'view_item'     => 'View ' . $singular,
		'view_items'    => 'View ' . $plural,
		'all_items'     => 'All ' . $plural
	];
}

function get_meta(
	$post
) {
	$data = [];

	foreach (
		get_post_meta($post->ID) as
		$field => $value
	) {
		if (isset($value))
			$data[$field] = $value[0] ?? '';
		else
			$data[$field] = '';
	}

	return $data;
}

function get_meta_image(
	$post,
	$meta_key,
	$default = ''
) {
	$file = get_post_meta($post->ID, $meta_key, true);
	return empty($file) ? $default : $file['url'];
}

function post_to_string(
	$data
) {
	$out = "{\n";
	foreach (
		$data as $key => $val
	) {
		// FORMAT STRING TYPE
		if (gettype($val) == "string")
			$val = '"' . $val . '"';
		elseif (gettype($val) == "array")
			$val = json_encode($val);

		$out .= "\t" . $key . ": " . $val . ",";
	}
	return $out . "\n}";
}

