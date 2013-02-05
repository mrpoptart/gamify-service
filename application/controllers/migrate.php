<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migrate extends CI_Controller {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Db_model');
    }

    public function rewards_from_goals()
    {
        $goals=$this->Db_model->get_all_user_goals();
        foreach($goals as $goal)
        {

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