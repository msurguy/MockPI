$(document).ready(function () {
	if ($('input[name="is_json_xml"]').is(':checked')) {
		$('input[name="json_xml"]').attr('disabled', false);
	} else {
		$('input[name="json_xml"]').attr('disabled', true);
	}

	$('input[name="is_json_xml"]').on('click', function () {
		if ($(this).is(':checked')) {
			$('input[name="json_xml"]').attr('disabled', false);
		} else {
			$('input[name="json_xml"]').attr('disabled', true);
		}
	});
});