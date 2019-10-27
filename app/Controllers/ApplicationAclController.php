<?php
namespace App\Controllers;

use App\Controllers\AclController;

class ApplicationAclController extends AclController
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend AclController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		$this->request = $request;

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();

		$this->navitems = [
			[
				'label'    => 'Home',
				'href'     => site_url(),
				'target'   => '',
				'active'   => false,
				'disabled' => false,
			],
			[
				'label'    => 'Admin Home',
				'href'     => site_url( 'admin/blog' ),
				'target'   => '',
				'active'   => true,
				'disabled' => false,
			],
			[
				'label'    => 'Logout',
				'href'     => '#logout@TODO',
				'target'   => '',
				'active'   => false,
				'disabled' => true,
			],
		];
	} // function

} // class
