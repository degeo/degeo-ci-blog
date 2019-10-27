<?php namespace App\Controllers\Admin;

use \App\Controllers\ApplicationAclController;

class Blog extends ApplicationAclController
{

	protected $login_required = true;

	protected $articles_model;

	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		parent::initController( $request, $response, $logger );

		// Instantiate Articles Model
		$this->articles_model = new \App\Models\Articles();

		// Set Document Title
		$this->document->title( $this->application->name . ' Administration' );

		// Add Second Breadcrumb
		$this->breadcrumbs->add( 'admin', $this->document->title(), 2 );
	} // function

	public function index()
	{
		// Queue DataTables Resources
		$this->resources->add( 'header', '<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>', 10 );
		$this->resources->add( 'header', '<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>', 110 );

		// Data Processing (Model calls)
		$articles = $this->articles_model->orderBy( $this->articles_model->createdField, 'desc')->findAll();

		// Set Data in Renderer
		$this->renderer->setVar( 'articles', $articles );

		// Add Layout
		$this->layout->add( 'blog/articles/articles-datatable', 100 );

		// Render Layout
		return $this->render();
	} // function

	//--------------------------------------------------------------------

	public function article($article_id = '')
	{
		if(! empty( $article_id ) && intval( $article_id ) !== $article_id):
			throw new \Exception( 'Article ID must be of integer type in ' . __METHOD__ );
		endif;

		if(! empty( $article_id )):
			// Read Article by Article ID
			$existing_article = $this->articles_model->find( $article_id );
		endif;

		if (! empty( $article_id ) && empty( $existing_article )):
			throw new \Exception( 'Article ID provided but no Article found.' );
		endif;

		helper('form');

		if($this->request->getMethod() === 'post' && set_value( 'form_name' ) === 'admin.blog.article'):
			$draft_status     = $this->statuses_model->status( 'Draft' );
			$published_status = $this->statuses_model->status( 'Published' );

			$article = [
				'article_title'       => set_value( 'article_title' ),
				'article_url'         => set_value( 'article_url' ),
				'article_description' => set_value( 'article_description' ),
				'article_content'     => set_value( 'article_content' ),
				'article_is_sticky'   => ( empty( set_value( 'article_is_sticky' ) ) ) ? 0 : 1,
				'status_id'           => ( empty( set_value( 'status_id' ) ) ) ? $draft_status['status_id'] : set_value( 'status_id' ),
			];

			if(! empty( set_value( 'status_id' ) ) && set_value( 'status_id' ) === $published_status['status_id']):
				if(empty( $existing_article['article_published'] )):
					$article['article_published'] = date( 'Y-m-d H:i:s' );
				endif;
			else:
				$article['article_published'] = null;
			endif;

			// Validate
			if($this->articles_model->validate( $article ) === false):
				$errors = $this->articles_model->errors();
				if(! empty( $errors )):
					foreach($errors as $field => $error):
						$this->messages->add( 'danger', $error );
					endforeach;
				endif;
			endif;

			// Save
			if(! empty( $article_id )):
				$updated = $this->articles_model->update( $article_id, $article );

				if(! empty( $updated )):
					$this->messages->add( 'success', 'Article successfully updated.' );

					redirect()->to( site_url( uri_string() ) );
				endif;
			else:
				$article_id = $this->articles_model->insert( $article );

				if(! empty( $article_id )):
					$this->messages->add( 'success', 'Article successfully created.' );

					redirect()->to( site_url( 'admin/blog/article/' . $article_id ) );
				else:
					redirect()->to( site_url( 'admin/blog' ) );
				endif;
			endif;
		endif;

		// Queue DataTables Resources
		$this->resources->add( 'header', '<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>', 10 );
		$this->resources->add( 'header', '<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>', 110 );

		// Queue CKEditor 4 Resource
		$this->resources->add( 'header', '<script src="//cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>', 120 );

		// Read Statuses
		$statuses = $this->statuses_model->findAll();

		if(is_null( $statuses )):
			$statuses = [];
		endif;

		$this->renderer->setVar('statuses', $statuses );

		// Read Article
		$article = $this->articles_model->find( $article_id );

		if(is_null( $article )):

			$allowed_fields = $this->articles_model->allowedFields;

			$fields = [];

			foreach($allowed_fields as $field):
				$fields[$field] = '';
			endforeach;

			$article = $fields;

		endif;

		// Add Layout
		$this->layout->add( 'blog/articles/article-form', 100, [ 'article' => $article ] );

		// Render Layout
		return $this->render();
	} // function

	//--------------------------------------------------------------------

}
