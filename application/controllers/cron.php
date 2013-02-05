<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends CI_Controller {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('Db_model');
        $this->load->helper('url');
    }

    public function index()
    {
        date_default_timezone_set('UTC');

        $goals = $this->Db_model->get_goals_to_notify();
        if(count($goals)>0)
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

                array_push($users[$goal->user_id]->goals, $goal);
            }
            //print_r($users);
            foreach($users as $user) {
                //change this to your email.
                $to = $user->email;
                $from = "noreply@".$_SERVER['SERVER_NAME'];
                $subject = "Daily Gamify Reminders";

                //begin of HTML message
                $headers = "From: $from\r\n";
                $headers .= "Content-type: text/html\r\n";

                $msg =
                    '<html>
                    <head>
                    <style>
                        body
                        {
                            font-family : sans-serif;
                        }
                    </style>
                    </head>
                    <body>
                        <h1>Gamify</h1>
                        <p>This is an automated message sent to you by
                        <a href="'.base_url().'">' . $_SERVER['SERVER_NAME'] . '</a>
                        and will be the only email you receive from us today. </p>
                        <p>The following goals are due today:</p>
                    <table width="100%" cellpadding="5" cellspacing="0" style="border:1px solid">
                        <thead style="background-color:#DDD">
                            <th align="left" style="padding-right:10px;">Goal</th>
                            <th align="left">Reward</th>
                        </thead>';

                foreach ($user->goals as $i => $user_goal) {
                    //echo ((int)$i + 1) . ". Goal: " . $user_goal->goal . "\n Reward: " . $user_goal->reward . "\n";
                    $msg .= "<tr style='".( ($i % 2) ? '' : 'background-color:#eee' ) ."'><td align='left' style='padding-right:10px'>$user_goal->goal</td><td align='left'>$user_goal->reward</td></tr>";

                    $this->Db_model->notify($user_goal->goal_id);
                }

                $msg .= "</table>";
                $msg.="<p><a href='".base_url()."subscription'>Click here if you'd like to unsubscribe</a></p>";
                $msg.="</html>";
                // now lets send the email.
                if($_SERVER['SERVER_ADDR'] != "127.0.0.1")
                {
                    mail($to, $subject, $msg, $headers);
                }
                echo "$msg\n\n";
            }
        }
        else
        {
            echo "There are no goals for " .date("H"). " o'clock";
        }
    }
    public function test()
    {
        $msg="";
        $goals = $this->Db_model->get_goals();
        if(count($goals)>0)
        {
            $users = array();
            foreach($goals as $reward)
            {
                if(!isset($users[$reward->user_id]))
                {
                    $users[$reward->user_id]=new stdClass;
                    $users[$reward->user_id]->goals=array();
                }
                $users[$reward->user_id]->email=$reward->email;
                $users[$reward->user_id]->username=$reward->username;

                array_push($users[$reward->user_id]->goals, $reward);
            }
            foreach($users as $user) {
                $msg.='
                    <table width="100%" cellpadding="5" cellspacing="0" style="border:1px solid">
                        <thead style="background-color:#DDD">
                            <th align="left" style="padding-right:10px;">Goal for '.$user->username.'</th>
                            <th align="left">Reward</th>
                            <th align="left">Due</th>
                        </thead>';
                foreach ($user->goals as $i => $user_goal) {
                    $msg .= "
                    <tr style='".( ($i % 2) ? '' : 'background-color:#eee' ) ."'>
                        <td align='left' style='padding-right:10px'>$user_goal->goal</td>
                        <td align='left'>$user_goal->reward</td>
                        <td align='left'>$user_goal->due_date</td>
                    </tr>";
                }
                $msg.="</table><br>";
            }
        }
        $rewards = $this->Db_model->get_rewards();
        if(count($rewards)>0)
        {
            $users = array();
            foreach($rewards as $reward)
            {
                if(!isset($users[$reward->user_id]))
                {
                    $users[$reward->user_id]=new stdClass;
                    $users[$reward->user_id]->goals=array();
                }
                $users[$reward->user_id]->email=$reward->email;
                $users[$reward->user_id]->username=$reward->username;

                array_push($users[$reward->user_id]->goals, $reward);
            }
            foreach($users as $user) {
                $msg.='
                    <table width="100%" cellpadding="5" cellspacing="0" style="border:1px solid">
                        <thead style="background-color:#DDD">
                            <th align="left" style="padding-right:10px;">Rewards pending for '.$user->username.'</th>
                            <th align="left">Completed</th>
                            <th align="left">For</th>
                        </thead>';
                foreach ($user->goals as $i => $user_goal) {
                    $msg .= "
                    <tr style='".( ($i % 2) ? '' : 'background-color:#eee' ) ."'>
                        <td align='left'>$user_goal->reward</td>
                        <td align='left'>".date("Y-m-d",strtotime($user_goal->completed_date))."</td>
                        <td align='left' style='padding-right:10px'>$user_goal->goal</td>
                    </tr>";
                }
                $msg.="</table><br>";
            }
        }
        echo $msg;
    }
}

/* End of file welcome_view.php */
/* Location: ./application/controllers/welcome_view.php */