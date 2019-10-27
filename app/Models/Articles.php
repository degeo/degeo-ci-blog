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
		'article_is_sticky',
		'article_published',
		'status_id',
	];

	protected $useTimestamps = true;
	protected $createdField  = 'article_created';
	protected $updatedField  = 'article_modified';
	protected $deletedField  = 'article_deleted';

	protected $validationRules = [
		'article_title'       => 'required',
		'article_url'         => 'required|alpha_dash',
		'article_description' => 'required|max_length[255]',
		'article_content'     => 'required',
		'article_is_sticky'   => 'integer',
		'article_published'   => 'permit_empty',
		'status_id'           => 'permit_empty|integer',
	];

	protected $validationMessages = [];
	protected $skipValidation     = false;

	public function parse_content_output($article)
	{
		return html_entity_decode( $article['article_content'] );
	} // function

	public function parse_content_input($article)
	{
		return htmlentities( $article['article_content'] );
	} // function

} // class
