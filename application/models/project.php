<?php
class Project extends Eloquent {
	public static $timestamps = TRUE;

	public function buckets () {
		return $this->has_many('Bucket');
	}
	public function user () {
		return $this->belongs_to('User');
	}
}
?>