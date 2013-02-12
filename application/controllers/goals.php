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
        $data['title'] = 'Gamify - Goals for '.$this->tank_auth->get_username();
        $this->load->view('header_view', $data);

        $this->load->model('Db_model');
        $this->load->library('form_validation');

        if($_POST)
        {
            $this->form_validation->set_rules('goal', 'Goal', 'required');
            $this->form_validation->set_rules('points', 'Points', 'required');
            $this->form_validation->set_rules('due_date', 'Due Date', 'required');

            if($this->form_validation->run())
            {
                $goal = $_POST['goal'];
                $points = $_POST['points'];
                $due_date = $_POST['due_date'];

                $this->Db_model->create_goal($this->tank_auth->get_user_id(), $goal, $points, $due_date);
                $data['heading'] = 'Creation Complete. Create another?';
            }
            else
            {
                $data['heading'] = 'Create A New Goal';
            }
        }
        else
        {
            $data['heading'] = 'Create A New Goal';
        }
        $goals = $this->Db_model->list_goals();

        $data['goals'] = $goals;
        $data['points'] = $this->Db_model->get_user_points($this->tank_auth->get_user_id());

        $subscribed=$this->Db_model->get_user_subscribed_status($this->tank_auth->get_user_id());
        $data['subscribed']=$subscribed;

        $this->load->model('Suggestion_model');
        $data['suggestion']=$this->Suggestion_model->get_goal_suggestion();

        $data['active_goals'] = TRUE;

        $this->load->view('create_goal_view', $data);
        $this->load->view('goals_view', $data);
        $this->load->view('footer_view', $data);
	}
}

/* End of file welcome_view.php */
/* Location: ./application/controllers/welcome_view.php */