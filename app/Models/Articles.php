<?php namespace App\Models;

use CodeIgniter\Model;

class Articles extends Model
{

	protected $table      = 'articles';
	protected $primaryKey = 'article_id';

	protected $returnType     = 'array';
	protected $useSoftDeletes = true;

	protected $allowedFields = [
		'article_title',
		'article_url',
		'article_description',
		'article_content',
		'status_id',
	];

	protected $useTimestamps = true;
	protected $createdField  = 'article_created';
	protected $updatedField  = 'article_modified';
	protected $deletedField  = 'article_deleted';

	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;

}
