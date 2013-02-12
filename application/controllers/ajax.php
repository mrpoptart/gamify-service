<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

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
        else
        {
            $this->load->model('Db_model');
        }
    }

    public function done()
    {
        if($_POST)
        {
            if($_POST['done'])
            {
                $this->Db_model->done_goal($_POST['done']);
                echo '<p class="btn btn-disabled span2">Complete!</p>';
            }
        }
    }

    public function reward()
    {
        if($_POST)
        {
            if($_POST['reward'])
            {
                $id = $_POST['reward'];
                echo '<p class="btn btn-disabled span2">Claimed!</p>';
                $this->Db_model->claim_reward($id);
            }
        }
    }

    public function adjust_points($val)
    {
        $points = $this->Db_model->get_points();
        echo $points."<br>";
        $this->Db_model->adjust_points($val);
        $points = $this->Db_model->get_points();
        echo $points."<br>";
    }

    public function get_goal_suggestion()
    {
        $this->load->model('Suggestion_model');
        echo $this->Suggestion_model->get_goal_suggestion();
    }

    public function get_reward_suggestion()
    {
        $this->load->model('Suggestion_model');
        echo $this->Suggestion_model->get_reward_suggestion();
    }
}

/* End of file welcome_view.php */
/* Location: ./application/controllers/welcome_view.php */