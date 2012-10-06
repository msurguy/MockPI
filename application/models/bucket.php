<?php
class Bucket extends Eloquent {
	public static $timestamps = TRUE;

	public function project () {
		return $this->belongs_to('Project');
	}
}
?>