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
        $data['title'] = 'Gamify - Rewards for '.$this->tank_auth->get_username();
        $this->load->view('header_view', $data);

        $this->load->model('Db_model');
        $this->load->library('form_validation');


        if($_POST)
        {

            $this->form_validation->set_rules('reward', 'Reward', 'required');
            $this->form_validation->set_rules('points', 'Points', 'required');

            if($this->form_validation->run())
            {
                $points = $_POST['points'];
                $reward = $_POST['reward'];
                $this->Db_model->create_reward($this->tank_auth->get_user_id(), $reward, $points);
                $data['heading'] = 'Reward Created. Create another?';
            }
            else
            {
                $data['heading'] = 'Create A New Reward';
            }
        }
        else
        {
            $data['heading'] = 'Create A New Reward';
        }

        $rewards = $this->Db_model->list_rewards();

        $data['rewards'] = $rewards;
        $data['points'] = $this->Db_model->get_user_points($this->tank_auth->get_user_id());
        $data['active_rewards'] = TRUE;

        $this->load->model('Suggestion_model');
        $data['suggestion']=$this->Suggestion_model->get_reward_suggestion();

        $this->load->view('create_reward_view', $data);
        $this->load->view('rewards_view', $data);
        $this->load->view('footer_view', $data);
	}
}

/* End of file welcome_view.php */
/* Location: ./application/controllers/welcome_view.php */