<?php namespace App\Models;

use CodeIgniter\Model;

class Statuses extends Model
{

	protected $table      = 'statuses';
	protected $primaryKey = 'status_id';

	protected $returnType     = 'array';
	protected $useSoftDeletes = false;

	protected $allowedFields = [
		'status_name'
	];

	protected $useTimestamps = false;
	protected $createdField  = '';
	protected $updatedField  = '';
	protected $deletedField  = '';

	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;

}
