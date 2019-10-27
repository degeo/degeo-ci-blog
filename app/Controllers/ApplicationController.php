<?php
namespace App\Controllers;

use App\Controllers\DegeoController;

class ApplicationController extends DegeoController
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	protected $statuses_model;

	protected $navitems = [];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();

		// Queue Page Title
		$this->layout->add( 'html/bootstrap/title', 10, [ 'subtitle' => '' ] );

		// Set Application Navigation
		$this->navitems = [
			[
				'label'    => 'Home',
				'href'     => site_url(),
				'target'   => '',
				'active'   => true,
				'disabled' => false,
			],
			[
				'label'    => 'DeGeo-PHP on Github',
				'href'     => 'https://github.com/degeo/degeo-php',
				'target'   => '_blank',
				'active'   => false,
				'disabled' => false,
			],
			[
				'label'    => 'DeGeo CodeIgniter 4 Starter Application on Github',
				'href'     => 'https://github.com/degeo/degeo-codeigniter4',
				'target'   => '_blank',
				'active'   => false,
				'disabled' => false,
			],
		];

		// Instantiate Statuses Model
		$this->statuses_model = new \App\Models\Statuses();
	}

	/**
	 * Render
	 * Builds data array to be passed to Layout render method and renders the layout.
	 *
	 * @return string
	 */
	protected function render()
	{
		// Queue Navigation using navitems property
		if (! empty( $this->navitems ))
		{
			$this->layout->add( 'DeGeo\Bootstrap\Views\v4\nav', 20, [ 'navitems' => $this->navitems ] );
		}

		$this->layout->add( 'DeGeo\Bootstrap\Views\v4\alerts', 30, [ 'alerts' => $this->messages->get_queue() ] );

		// Render Layout
		return parent::render();
	} // function

}
