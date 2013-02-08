<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends CI_Controller {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('Db_model');
        $this->load->helper('url');
        date_default_timezone_set('UTC');
    }

    public function index()
    {
        $goals = $this->Db_model->get_goals_to_notify(date("H"));
        $users = $this->get_users_to_email($goals);
        //print_r($users);
        foreach($users as $user)
        {
            //change this to your email.
            $to = $user->email;
            $from = "noreply@".$_SERVER['SERVER_NAME'];
            $subject = "Daily Gamify Reminders";

            //begin of HTML message
            $headers = "From: $from\r\n";
            $headers .= "Content-type: text/html\r\n";

            $msg = $this->build_message($user);

            // now lets send the email.
            if($_SERVER['SERVER_ADDR'] != "127.0.0.1")
            {
                mail($to, $subject, $msg, $headers);
            }
            echo "$msg\n\n";
        }
    }
    public function simulate_hour($hour)
    {
        $goals = $this->Db_model->get_goals_to_notify($hour, FALSE);
        $users = $this->get_users_to_email($goals);

        foreach($users as $user)
        {
            echo $this->build_message($user)."\n\n";
        }
    }
    public function simulate_all()
    {
        $goals = $this->Db_model->get_incomplete_goals();
        $users = $this->get_users_to_email($goals);
        foreach($users as $user)
        {
            echo $this->build_message($user)."\n\n";
        }
    }
    private function get_users_to_email($goals)
    {
        $users = array();
        foreach($goals as $goal)
        {
            if(!isset($users[$goal->user_id]))
            {
                $users[$goal->user_id]=new stdClass;
                $users[$goal->user_id]->goals=array();
            }
            $users[$goal->user_id]->email=$goal->email;
            $users[$goal->user_id]->username=$goal->username;
            $users[$goal->user_id]->password=$goal->password;
            $users[$goal->user_id]->user_id=$goal->user_id;

            array_push($users[$goal->user_id]->goals, $goal);
        }
        return $users;
    }
    private function build_message($user)
    {
        $data['goals'] = $user->goals;
        $data['user'] = $user;
        return $this->load->view('email/daily', $data, TRUE);
    }
}

/* End of file welcome_view.php */
/* Location: ./application/controllers/welcome_view.php */