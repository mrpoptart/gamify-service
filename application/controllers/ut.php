<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ut extends CI_Controller {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('unit_test');
    }

    public function index()
    {
        //$this->test_goals();
        //$this->test_get_magic_hour();
        //$this->test_get_current_magic_hour_offset();
        echo $this->unit->report();
    }

    public function check_magic_time()
    {

    }

    public function test_goals()
    {
        $this->load->model('Db_model');
        $val = $this->Db_model->list_goals();
        $this->unit->run($val, 'is_array', "list_goals returns array");

        $this->unit->run($val[0], 'is_object', "list_goals returns array of objects");
        $this->unit->run($val[0]->id, 'is_string', "goal object id is string");
        $this->unit->run($val[0]->id, '6', "goal object id is 6: shows ".$val[0]->id);
        $this->unit->run($val[0]->user_id, '1', "goal object user_id is 1");
        $this->unit->run($val[0]->goal, 'Sell Pax Shelves', "goal object goal is 'Sell Pax Shelves'");
    }

    public function test_get_magic_hour()
    {
        $this->load->model('Date_model');
        $this->unit->run($this->Date_model->get_magic_hour(-12), 12, "Offset is -12");
        $this->unit->run($this->Date_model->get_magic_hour(-11), 13, "Offset is -11");
        $this->unit->run($this->Date_model->get_magic_hour(-10), 14, "Offset is -10");
        $this->unit->run($this->Date_model->get_magic_hour(-9.5), 14.5, "Offset is -9.5");
        $this->unit->run($this->Date_model->get_magic_hour(-9), 15, "Offset is -9");
        $this->unit->run($this->Date_model->get_magic_hour(-8), 16, "Offset is -8");
        $this->unit->run($this->Date_model->get_magic_hour(-7), 17, "Offset is -7");
        $this->unit->run($this->Date_model->get_magic_hour(-6), 18, "Offset is -6");
        $this->unit->run($this->Date_model->get_magic_hour(-5), 19, "Offset is -5");
        $this->unit->run($this->Date_model->get_magic_hour(-4.5), 19.5, "Offset is -4.5");
        $this->unit->run($this->Date_model->get_magic_hour(-4), 20, "Offset is -4");
        $this->unit->run($this->Date_model->get_magic_hour(-3.5), 20.5, "Offset is -3.5");
        $this->unit->run($this->Date_model->get_magic_hour(-3), 21, "Offset is -3");
        $this->unit->run($this->Date_model->get_magic_hour(-2), 22, "Offset is -2");
        $this->unit->run($this->Date_model->get_magic_hour(-1), 23, "Offset is -1");
        $this->unit->run($this->Date_model->get_magic_hour(0), 0, "Offset is 0");
        $this->unit->run($this->Date_model->get_magic_hour(1), 1, "Offset is 1");
        $this->unit->run($this->Date_model->get_magic_hour(2), 2, "Offset is 2");
        $this->unit->run($this->Date_model->get_magic_hour(3), 3, "Offset is 3");
        $this->unit->run($this->Date_model->get_magic_hour(3.5), 3.5, "Offset is 3.5");
        $this->unit->run($this->Date_model->get_magic_hour(4), 4, "Offset is 4");
        $this->unit->run($this->Date_model->get_magic_hour(4.5), 4.5, "Offset is 4.5");
        $this->unit->run($this->Date_model->get_magic_hour(5), 5, "Offset is 5");
        $this->unit->run($this->Date_model->get_magic_hour(5.5), 5.5, "Offset is 5.5");
        $this->unit->run($this->Date_model->get_magic_hour(5.75), 5.75, "Offset is 5.75");
        $this->unit->run($this->Date_model->get_magic_hour(6), 6, "Offset is 6");
        $this->unit->run($this->Date_model->get_magic_hour(6.5), 6.5, "Offset is 6.5");
        $this->unit->run($this->Date_model->get_magic_hour(7), 7, "Offset is 7");
        $this->unit->run($this->Date_model->get_magic_hour(8), 8, "Offset is 8");
        $this->unit->run($this->Date_model->get_magic_hour(8.75), 8.75, "Offset is 8.75");
        $this->unit->run($this->Date_model->get_magic_hour(9), 9, "Offset is 9");
        $this->unit->run($this->Date_model->get_magic_hour(9.5), 9.5, "Offset is 9.5");
        $this->unit->run($this->Date_model->get_magic_hour(10), 10, "Offset is 10");
        $this->unit->run($this->Date_model->get_magic_hour(10.5), 10.5, "Offset is 10.5");
        $this->unit->run($this->Date_model->get_magic_hour(11), 11, "Offset is 11");
        $this->unit->run($this->Date_model->get_magic_hour(11.5), 11.5, "Offset is 11.5");
        $this->unit->run($this->Date_model->get_magic_hour(12), 12, "Offset is 12");
        $this->unit->run($this->Date_model->get_magic_hour(12.75), 12.75, "Offset is 12.75");
        $this->unit->run($this->Date_model->get_magic_hour(13), 13, "Offset is 13");
        $this->unit->run($this->Date_model->get_magic_hour(14), 14, "Offset is 14");
    }

    public function test_get_current_magic_hour_offset()
    {
        $this->load->model('Date_model');
        $this->unit->run($this->Date_model->get_current_magic_hour_offset(0), 0, "0:00");
        $this->unit->run($this->Date_model->get_current_magic_hour_offset(1), 1, "1:00");
        $this->unit->run($this->Date_model->get_current_magic_hour_offset(2), 2, "2:00");
        $this->unit->run($this->Date_model->get_current_magic_hour_offset(3), 3, "3:00");
        $this->unit->run($this->Date_model->get_current_magic_hour_offset(4), 4, "4:00");
        $this->unit->run($this->Date_model->get_current_magic_hour_offset(5), 5, "5:00");
        $this->unit->run($this->Date_model->get_current_magic_hour_offset(6), 6, "6:00");
        $this->unit->run($this->Date_model->get_current_magic_hour_offset(7), 7, "7:00");
        $this->unit->run($this->Date_model->get_current_magic_hour_offset(8), 8, "8:00");
        $this->unit->run($this->Date_model->get_current_magic_hour_offset(9), 9, "9:00");
        $this->unit->run($this->Date_model->get_current_magic_hour_offset(10), 10, "10:00");
        $this->unit->run($this->Date_model->get_current_magic_hour_offset(11), 11, "11:00");
        $this->unit->run($this->Date_model->get_current_magic_hour_offset(12), 0, "12:00");
        $this->unit->run($this->Date_model->get_current_magic_hour_offset(13), -11, "13:00");
        $this->unit->run($this->Date_model->get_current_magic_hour_offset(14), -10, "14:00");
        $this->unit->run($this->Date_model->get_current_magic_hour_offset(15), -9, "15:00");
        $this->unit->run($this->Date_model->get_current_magic_hour_offset(16), -8, "16:00");
        $this->unit->run($this->Date_model->get_current_magic_hour_offset(17), -7, "17:00");
        $this->unit->run($this->Date_model->get_current_magic_hour_offset(18), -6, "18:00");
        $this->unit->run($this->Date_model->get_current_magic_hour_offset(19), -5, "19:00");
        $this->unit->run($this->Date_model->get_current_magic_hour_offset(20), -4, "20:00");
        $this->unit->run($this->Date_model->get_current_magic_hour_offset(21), -3, "21:00");
        $this->unit->run($this->Date_model->get_current_magic_hour_offset(22), -2, "22:00");
        $this->unit->run($this->Date_model->get_current_magic_hour_offset(23), -1, "23:00");
    }
}
