<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rewards extends CI_Controller {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->helper('url');
        if (!$this->tank_auth->is_logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $this->load->helper('date');
    }

	public function index()
	{
        $this->load->model('Db_model');
        $rewards = $this->Db_model->list_rewards();
        $points = $this->Db_model->get_user_points($this->tank_auth->get_user_id());

        $data['title'] = 'Gamify - Rewards for '.$this->tank_auth->get_username();
        $data['heading'] = 'List of Rewards';
        $data['rewards'] = $rewards;
        $data['points'] = $points;
        $data['active_rewards'] = TRUE;

        $this->load->view('header_view', $data);
        $this->load->view('rewards_view', $data);
        $this->load->view('footer_view', $data);
	}
}

/* End of file welcome_view.php */
/* Location: ./application/controllers/welcome_view.php */