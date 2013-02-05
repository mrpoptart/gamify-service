<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create extends CI_Controller {

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
    }

	public function index()
	{
        $data['active_create'] = TRUE;
        if($_POST && $_POST['goal'] && $_POST['reward'] && $_POST['due_date'])
        {
            $goal = $_POST['goal'];
            $reward = $_POST['reward'];
            $due_date = $_POST['due_date'];

            $this->load->model('Db_model');
            $this->Db_model->create_goal($this->tank_auth->get_user_id(), $goal, $reward, $due_date);
            $data['title'] = 'Gamification';
            $data['heading'] = 'Creation Complete. Create another?';
            $this->load->view('header_view', $data);
            $this->load->view('create_view', $data);
            $this->load->view('footer_view', $data);
        }
        else
        {
            $data['title'] = 'Gamify - Create a new Goal for '.$this->tank_auth->get_username();
            $data['heading'] = 'Create a New Goal';
            $this->load->view('header_view', $data);
            $this->load->view('create_view', $data);
            $this->load->view('footer_view', $data);
        }
	}
}

/* End of file welcome_view.php */
/* Location: ./application/controllers/welcome_view.php */