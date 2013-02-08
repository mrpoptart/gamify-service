<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        if (!$this->tank_auth->is_logged_in() || $this->tank_auth->get_user_id() != 1)
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->load->helper('url');
            $this->load->model('Db_model');
        }
    }

    public function rewards_from_goals()
    {
        $goals=$this->Db_model->get_all_user_goals();
        foreach($goals as $goal)
        {
            if(preg_match("/[0-9] point[s]*/i", $goal->reward))
            {
                echo "This reward doesn't really count, it's only a point";
            }
            else
            {
                $insert_id = $this->Db_model->create_reward($goal->user_id, $goal->reward, 1);
                echo "created reward $insert_id for user $goal->user_id";

                if($goal->completed_date != "")
                {
                    echo ". It was completed for 1 point";
                    $points=$this->Db_model->get_user_points($goal->user_id);
                    $this->Db_model->set_user_points($points+1,$goal->user_id);

                    if($goal->rewarded_date != "")
                    {
                        //decrements points
                        echo " and already rewarded and that point was spent";
                        $this->Db_model->claim_reward($insert_id);
                    }
                }
                else
                {
                    echo " and it hasn't been completed yet";
                }
            }
            echo ", so they now have ".$this->Db_model->get_user_points($goal->user_id)." points";
            echo " <br>";
        }
    }
    public function notify_users()
    {

    }
}

/* End of file welcome_view.php */
/* Location: ./application/controllers/welcome_view.php */