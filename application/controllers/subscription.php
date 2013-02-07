<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscription extends CI_Controller {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        if (!$this->tank_auth->is_logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $this->load->library('form_validation');
        $this->load->model('Db_model');
    }

    public function index()
    {
        $data['title'] = 'Gamify - Subscription Settings';

        if($_POST)
        {
            if($_POST['subscription']=="0")
            {
                $this->Db_model->unsubscribe();
            }
            else if($_POST['subscription']=="1")
            {
                $this->Db_model->subscribe();
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
}

/* End of file welcome_view.php */
/* Location: ./application/controllers/welcome_view.php */