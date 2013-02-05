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
    }

    public function done()
    {
        $this->load->model('Db_model');
        if($_POST)
        {
            if($_POST['done'])
            {
                $this->Db_model->done_goal($_POST['done']);
                echo '<a href="javascript:void" onclick="reward('.$_POST['done'].')" class="btn btn-success">Claim Reward</a>';
            }
        }
    }

    public function reward()
    {
        $this->load->model('Db_model');
        if($_POST)
        {
            if($_POST['reward'])
            {
                $this->Db_model->reward_goal($_POST['reward']);
            }
        }
        echo 'Goal Complete!';
    }
}

/* End of file welcome_view.php */
/* Location: ./application/controllers/welcome_view.php */