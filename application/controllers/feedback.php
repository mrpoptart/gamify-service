<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends CI_Controller {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Gamify - Send Feedback';

        $this->load->view('header_view', $data);
        if($_POST)
        {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');


            if ($this->form_validation->run())
            {
                $this->load->library('email');

                $this->email->from('noreply@morganengel.com', 'Gamify');
                $this->email->reply_to($_POST['email']);
                $this->email->to('mrpoptart@gmail.com');

                $this->email->subject('Feedback from Gamify');
                $this->email->message($_POST['message']);
                $this->email->send();
                $this->session->set_flashdata('feedback', '<span class="label label-success">Message sent! Thank you for your feedback.</span>');
                redirect(current_url());
            }
        }

        $this->load->view('feedback_view', $data);

        $this->load->view('footer_view', $data);
    }
}

/* End of file welcome_view.php */
/* Location: ./application/controllers/welcome_view.php */