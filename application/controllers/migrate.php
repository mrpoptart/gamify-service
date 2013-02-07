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
            $user_id = $goal->user_id;
            $reward = $goal->reward;
            $points=$this->Db_model->get_user_points($goal->user_id);
            $insert_id = $this->Db_model->create_reward($user_id, $reward, 1);
            echo $insert_id." - ";
            if($goal->completed_date != "")
            {
                echo "Complete, increasing by 1";
                $points++;
            }
            if($goal->rewarded_date != "")
            {
                $points--;
                echo ", but resolved, so subtracting 1";
                $this->Db_model->claim_reward($insert_id);
            }
            if($points<0)
            {
                $points=0;
            }
            $this->Db_model->set_user_points($points,$goal->user_id);
            echo ", producing ".$this->Db_model->get_user_points($goal->user_id);
            echo " <br>";
        }
    }

    public function add_points_to_goals()
    {

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