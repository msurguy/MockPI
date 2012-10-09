$(document).ready(function () {
	function JSONOrXML () {
		if (parseInt($('input[name="json_xml"]:checked').val()) === 1) {
			$('input[name="is_jsonp"]').attr('disabled', false);
		} else {
			$('input[name="is_jsonp"]').attr('disabled', true);
		}
	};
	function toggleJSONXML () {
		if ($('input[name="is_json_xml"]').is(':checked')) {
			$('input[name="json_xml"]').attr('disabled', false);

			JSONOrXML();
		} else {
			$('input[name="json_xml"]').attr('disabled', true);
			$('input[name="is_jsonp"]').attr('disabled', true);
		}
	};

	toggleJSONXML();
	$('input[name="is_json_xml"]').on('click', function () {
		toggleJSONXML();
	});
	$('input[name="json_xml"]').on('click', function () {
		JSONOrXML();
	});
});