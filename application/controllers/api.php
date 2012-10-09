<?php
class Api_Controller extends Base_Controller {
	public function action_request ($project_id, $uri) {
		$uri = '/' . $uri;

		$project = Project::find($project_id);
		$buckets = $project->buckets()->order_by('order_number', 'asc')->get();

		foreach ($buckets as $bucket):
			$bucket_path = trim($bucket->path);

			if (substr($bucket_path, 0, 2) === '##'):
				if (preg_match('/' . substr($bucket_path, 2) . '/', $uri)):
					if ($bucket->running):
						return $this->process_request($bucket);
					else:
						return Response::error('404');
					endif;
				endif;
			else:
				if ($bucket_path === $uri):
					if ($bucket->running):
						return $this->process_request($bucket);
					else:
						return Response::error('404');
					endif;
				endif;
			endif;
		endforeach;

		return Response::error('404');
	}
	private function process_request ($bucket) {
		$response_content = '';
		$response_status = 200;
		$response_headers = array();

		if (trim($bucket->response_data) !== '' && $bucket->response_data !== NULL):
			$response_content = $bucket->response_data;
		endif;
		if ($bucket->is_json_xml):
			if (((int) $bucket->json_xml) == 1):
				$response_headers['Content-Type'] = 'application/json';
				if ($bucket->is_jsonp):
					if (Input::get('callback', FALSE) !== FALSE):
						if (preg_match('/^[a-zA-Z_$]{1}[a-zA-Z0-9_$]*$/', Input::get('callback'))):
							$response_headers['Content-Type'] = 'application/javascript';
							$response_content = Input::get('callback') . '(' . $response_content . ');';
						endif;
					endif;
				endif;
			elseif (((int) $bucket->json_xml) == 2):
				$response_headers['Content-Type'] = 'application/xml';
			endif;
		endif;
		if (trim($bucket->response_headers) !== '' && $bucket->response_headers !== NULL):
			$response_headers = array_merge($response_headers, json_decode($bucket->response_headers, TRUE));
		endif;
		if (trim($bucket->response_code) !== '' && $bucket->response_code !== NULL):
			$response_status = $bucket->response_code;
		endif;

		return Response::make($response_content, $response_status, $response_headers);
	}
}