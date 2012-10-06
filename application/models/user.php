<?php
class User extends Eloquent {
	public static $timestamps = TRUE;

	public function projects () {
		return $this->has_many('Project');
	}
}
?>