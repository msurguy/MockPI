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
						$response_content = '';
						$response_status = 200;
						$response_headers = array();

						if (trim($bucket->response_data) !== '' && $bucket->response_data !== NULL):
							$response_content = $bucket->response_data;
						endif;
						if (trim($bucket->response_headers) !== '' && $bucket->response_headers !== NULL):
							$response_headers = json_decode($bucket->response_headers, TRUE);
						endif;
						if (trim($bucket->response_code) !== '' && $bucket->response_code !== NULL):
							$response_status = $bucket->response_code;
						endif;

						return Response::make($response_content, $response_status, $response_headers);
					else:
						return Response::error('404');
					endif;
				endif;
			else:
				if ($bucket_path === $uri):
					if ($bucket->running):
						$response_content = '';
						$response_status = 200;
						$response_headers = array();

						if (trim($bucket->response_data) !== '' && $bucket->response_data !== NULL):
							$response_content = $bucket->response_data;
						endif;
						if (trim($bucket->response_headers) !== '' && $bucket->response_headers !== NULL):
							$response_headers = json_decode($bucket->response_headers, TRUE);
						endif;
						if (trim($bucket->response_code) !== '' && $bucket->response_code !== NULL):
							$response_status = $bucket->response_code;
						endif;

						return Response::make($response_content, $response_status, $response_headers);
					else:
						return Response::error('404');
					endif;
				endif;
			endif;
		endforeach;

		return Response::error('404');
	}
}