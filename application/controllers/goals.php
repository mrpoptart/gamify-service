<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Goals extends CI_Controller {

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
        if($_POST)
        {
            if(@$_POST['done'])
            {
                $this->Db_model->done_goal($_POST['done']);
            }
            if(@$_POST['reward'])
            {
                $this->Db_model->reward_goal($_POST['reward']);
            }
        }
        $goals = $this->Db_model->list_goals();

        $data['title'] = 'Gamify - Goals for '.$this->tank_auth->get_username();
        $data['heading'] = 'List of Goals';
        $data['goals'] = $goals;
        $data['active_goals'] = TRUE;

        $this->load->view('header_view', $data);
        $this->load->view('goals_view', $data);
        $this->load->view('footer_view', $data);
	}
}

/* End of file welcome_view.php */
/* Location: ./application/controllers/welcome_view.php */