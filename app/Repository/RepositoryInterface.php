<?php 

namespace App\Repository;

use Illuminate\Http\Request;

interface RepositoryInterface{
	public function all();
	public function findIdNewRow($id);	
	public function checkPayment($id);		

}