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

    public function goal()
    {
        $this->load->model('Db_model');
        $subscribed=$this->Db_model->get_user_subscribed_status($this->tank_auth->get_user_id());
        $data['subscribed']=$subscribed;

        $this->load->model('Suggestion_model');
        $data['suggestion']=$this->Suggestion_model->get_goal_suggestion();
        if($_POST && $_POST['goal'] && $_POST['points'] && $_POST['due_date'])
        {
            $goal = $_POST['goal'];
            $points = $_POST['points'];
            $due_date = $_POST['due_date'];

            $this->Db_model->create_goal($this->tank_auth->get_user_id(), $goal, $points, $due_date);
            $data['title'] = 'Gamification';
            $data['heading'] = 'Creation Complete. Create another?';
            $this->load->view('header_view', $data);
            $this->load->view('create_goal_view', $data);
            $this->load->view('footer_view', $data);
        }
        else
        {
            $data['title'] = 'Gamify - Create a new Goal for '.$this->tank_auth->get_username();
            $data['heading'] = 'Create a New Goal';
            $this->load->view('header_view', $data);
            $this->load->view('create_goal_view', $data);
            $this->load->view('footer_view', $data);
        }
    }

    public function reward()
    {
        $this->load->model('Suggestion_model');
        $data['suggestion']=$this->Suggestion_model->get_reward_suggestion();
        if($_POST && $_POST['points'] && $_POST['reward'])
        {
            $points = $_POST['points'];
            $reward = $_POST['reward'];

            $this->load->model('Db_model');
            $this->Db_model->create_reward($this->tank_auth->get_user_id(), $reward, $points);
            $data['title'] = 'Gamification';
            $data['heading'] = 'Reward Created. Create another?';
            $this->load->view('header_view', $data);
            $this->load->view('create_reward_view', $data);
            $this->load->view('footer_view', $data);
        }
        else
        {
            $data['title'] = 'Gamify - Create a new reward for '.$this->tank_auth->get_username();
            $data['heading'] = 'Create a New Reward';
            $this->load->view('header_view', $data);
            $this->load->view('create_reward_view', $data);
            $this->load->view('footer_view', $data);
        }
    }
}

/* End of file welcome_view.php */
/* Location: ./application/controllers/welcome_view.php */