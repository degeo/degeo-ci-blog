<?php namespace App\Controllers;

use \App\Controllers\BaseController;
use \App\Models\Articles;

class Blog extends BaseController
{

	protected $articles_model;

	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		parent::initController( $request, $response, $logger );

		$this->articles_model = new \App\Models\Articles();
	} // function

	public function index()
	{
		// Set Document Title
		$this->document->title( 'Welcome to the ' . $this->application->name );

		// Add Second Breadcrumb
		$this->breadcrumbs->add( 'home/degeo', $this->document->title(), 2 );

		// Data Processing (Model calls)
		$articles = $this->articles_model->findAll();

		// Set Data in Renderer
		$this->renderer->setVar( 'articles', $articles );

		// Add Layout
		$this->layout->add( 'blog/articles/articles-list', 2 );

		// Render Layout
		return $this->render();
	} // function

	//--------------------------------------------------------------------

	public function articles($article_url = '')
	{
		if (empty( $article_url ))
		{
			return redirect()->to( site_url() );
		}

		// Read Article by Article URL
		$article = $this->articles_model->where( 'article_url', $article_url )->first();

		if (empty( $article ))
		{
			return redirect()->to( site_url() );
		}

		// Set Document Title
		$this->document->title( $article['article_title'] . ' | ' . $this->application->name );

		// Add Second Breadcrumb
		$this->breadcrumbs->add( 'articles/' . $article_url, $article['article_title'], 2 );

		// Set Data in Renderer
		$this->renderer->setVar( 'article', $article );

		// Add Layout
		$this->layout->add( 'blog/articles/article-single', 2 );

		// Render Layout
		return $this->render();
	} // function

	//--------------------------------------------------------------------

}