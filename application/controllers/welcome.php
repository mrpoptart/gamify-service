<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->helper('url');
    }

	public function index()
	{
        if (!$this->tank_auth->is_logged_in(FALSE)) { // not logged in or activated
            redirect('/auth/login');

        } else {
            redirect('/goals');
        }
	}
}

/* End of file welcome_view.php */
/* Location: ./application/controllers/welcome.php */