<?php

namespace App\Core\Interfaces;
 


interface BodyTempInterface {

	public function fetch($request);

	public function store($request);

	public function update($request, $slug);

	public function destroy($slug);

	public function findBySlug($slug);

	public function getByPersonnelId($p_id);

	public function countByDateStatus($df, $dt, $status);

	public function getByDate($df, $dt);

	public function getByDatePersonnel($df, $dt, $id);

	public function getByDateStatus($df, $dt, $status);

	public function isExistByCurrentDate($id, $date);
		
}