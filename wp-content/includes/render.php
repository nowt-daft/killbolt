<?php
function render_image_upload(
	$post_id,
	$post_meta_key
) {
	$file = get_post_meta(
		$post_id,
		$post_meta_key,
		true
	);

	if (!empty($file)) : ?>
	<img src="<?php echo $file['url'] ?>" />
	<?php endif ?>
	<input
		type="file"
		name="<?php echo $post_meta_key ?>"
	/>
	<?php
}

function render_input_field(
	$post_id,
	$post_meta_key,
	$input_type = 'text',
	$input_placeholder = ''
) {
	$post_meta_value = get_post_meta(
		$post_id,
		$post_meta_key,
		true
	) ?? '';
	?>
	<input
		type="<?php echo $input_type ?>"
		placeholder="<?php echo $input_placeholder ?>"
		name="<?php echo $post_meta_key ?>"
		value="<?php echo $post_meta_value ?>"
	/>
	<?php
}

function render_email_field(
	$post_id,
	$post_meta_key
) {
	render_input_field(
		$post_id,
		$post_meta_key,
		"email",
		"user@example.com"
	);
}

function render_date_field(
	$post_id,
	$post_meta_key
) {
	render_input_field(
		$post_id,
		$post_meta_key,
		"date"
	);
}

function render_time_field(
	$post_id,
	$post_meta_key
) {
	render_input_field(
		$post_id,
		$post_meta_key,
		'text',
		'HH:MM (24-hour time)'
	);
}

