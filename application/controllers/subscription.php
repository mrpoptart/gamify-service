<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscription extends CI_Controller {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Db_model');
    }

    public function index()
    {
        if (!$this->tank_auth->is_logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $data['title'] = 'Gamify - Subscription Settings';

        if($_POST)
        {
            if($_POST['subscription']=="0")
            {
                $this->Db_model->unsubscribe($this->tank_auth->get_user_id());
            }
            else if($_POST['subscription']=="1")
            {
                $this->Db_model->subscribe($this->tank_auth->get_user_id());
            }
        }

        $subscribed = $this->Db_model->get_user_subscribed_status($this->tank_auth->get_user_id());

        /*echo "<!--";
        print_r($data);
        echo "-->";*/

        $this->load->view('header_view', $data);
        if($subscribed)
        {
            $this->load->view('unsubscribe_view', $data);
        }
        else
        {
            $this->load->view('subscribe_view', $data);
        }
        $this->load->view('footer_view', $data);
    }

    public function unsubscribe()
    {
        $data['title']=$data['heading']="Unsubscribe";
        $this->load->view('header_view', $data);
        if($_GET)
        {
            if(isset($_GET["user_id"]) && isset($_GET["verify"]))
            {
                $user_id = $_GET["user_id"];
                $verify = $_GET["verify"];
                $pass = $this->Db_model->get_user_hash($user_id);
                if($pass==$verify)
                {
                    $data['title']=$data['heading']="Unsubscribed";
                    $this->Db_model->unsubscribe($user_id);
                    $this->load->view('unsubscribed_view', $data);
                }
                else
                {
                    $data['error']="The link you clicked was invalid.";
                    $this->load->view('unsubscribed_error_view', $data);
                }
            }
            else
            {
                $data['error']="We didn't get a user_id and verify code.";
                $this->load->view('unsubscribed_error_view', $data);
            }
        }
        else
        {
            $data['error']="You probably came here without a link.";
            $this->load->view('unsubscribed_error_view', $data);
        }
        $this->load->view('footer_view', $data);
    }
}

/* End of file welcome_view.php */
/* Location: ./application/controllers/welcome_view.php */