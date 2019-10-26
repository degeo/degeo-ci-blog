<?php namespace App\Models;

use CodeIgniter\Model;

class Categories extends Model
{

	protected $table      = 'categories';
	protected $primaryKey = 'category_id';

	protected $returnType     = 'array';
	protected $useSoftDeletes = true;

	protected $allowedFields = [
		'category_parent_id',
		'category_name',
		'category_url',
		'category_description',
	];

	protected $useTimestamps = true;
	protected $createdField  = 'category_created';
	protected $updatedField  = 'category_modified';
	protected $deletedField  = 'category_deleted';

	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;

}
