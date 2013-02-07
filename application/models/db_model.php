<?php
/**
 * Created by IntelliJ IDEA.
 * User: meneli
 * Date: 1/6/13
 * Time: 8:12 AM
 * To change this template use File | Settings | File Templates.
 */

class Db_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function list_goals()
    {
        $this->db->where('user_id', $this->tank_auth->get_user_id());
        $query = $this->db->get('goals');
        return $query->result();
    }

    function list_rewards()
    {
        $this->db->where('user_id', $this->tank_auth->get_user_id());
        $query = $this->db->get('rewards');
        return $query->result();
    }

    function create_goal($user_id, $goal, $points, $due_date)
    {
        $this->user_id      = $user_id;
        $this->goal         = $goal;
        $this->points       = $points;
        $this->due_date     = $due_date;
        $this->start_date   = date("Y-m-d H:i:s");

        $this->db->insert('goals', $this);
    }

    function create_reward($user_id, $reward, $points)
    {
        $this->user_id      = $user_id;
        $this->reward       = $reward;
        $this->points       = $points;
        $this->created_date = date("Y-m_d H:m:s");

        $this->db->insert('rewards', $this);
        return $this->db->insert_id();
    }

    function done_goal($goal_id)
    {
        $data = array(
            'completed_date' => date("Y-m-d H:i:s")
        );
        $this->db->where('id', $goal_id);
        $this->db->where('user_id', $this->tank_auth->get_user_id());
        $this->db->update('goals', $data);
        $point_value = $this->get_goal_point_value($goal_id);
        $user_id = $this->get_goal_user($goal_id);
        $user_points = $this->get_user_points($user_id);
        $user_points += $point_value;
        $this->set_user_points($user_points, $user_id);
    }

    function get_reward($goal_id)
    {
        $this->db->select('reward');
        $this->db->where('id', $goal_id);
        $query = $this->db->get('goals');
        return $query->result();
    }

    function claim_reward($reward_id)
    {
        $data = array(
            'rewarded_date' => date("Y-m-d H:i:s")
        );
        $this->db->where('id', $reward_id);
        $this->db->update('rewards', $data);
        $point_cost = $this->get_reward_point_cost($reward_id);
        $user_id = $this->get_reward_user($reward_id);
        $user_points = $this->get_user_points($user_id);
        $user_points -= $point_cost;
        $this->set_user_points($user_points, $user_id);
    }

    function get_reward_point_cost($reward_id)
    {
        $this->db->select('points');
        $this->db->from('rewards');
        $this->db->where('id', $reward_id);
        $query = $this->db->get();
        $result = $query->result();
        $result = $result[0]->points;
        return $result;
    }

    function get_reward_user($reward_id)
    {
        $this->db->select('user_id');
        $this->db->from('rewards');
        $this->db->where('id', $reward_id);
        $query = $this->db->get();
        $result = $query->result();
        $result = $result[0]->user_id;
        return $result;
    }

    function get_goal_user($goal_id)
    {
        $this->db->select('user_id');
        $this->db->from('goals');
        $this->db->where('id', $goal_id);
        $query = $this->db->get();
        $result = $query->result();
        $result = $result[0]->user_id;
        return $result;
    }

    function get_goal_point_value($goal_id)
    {
        $this->db->select('points');
        $this->db->from('goals');
        $this->db->where('id', $goal_id);
        $query = $this->db->get();
        $result = $query->result();
        $result = $result[0]->points;
        return $result;
    }

    function set_user_points($num,$user_id)
    {
        $data = array(
            'points' => $num
        );

        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
    }

    /*function adjust_points($num,$user_id)
    {
        $points = $this->get_user_points($user_id);
        $points = $points + $num;
        $this->set_user_points($points, $user_id);
    }*/

    function get_user_subscribed_status($user_id)
    {
        $this->db->select('subscribed');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        $result = $query->result();
        $result = $result[0]->subscribed;
        return $result;
    }

    function update_timezone($timezone_offset)
    {
        $this->Db_model->update_one('timezone_offset', $timezone_offset, 'id', $this->tank_auth->get_user_id(), 'users');
    }

    function unsubscribe()
    {
        $this->Db_model->update_one('subscribed', 0, 'id', $this->tank_auth->get_user_id(), 'users');
    }

    function subscribe()
    {
        $this->Db_model->update_one('subscribed', 1, 'id', $this->tank_auth->get_user_id(), 'users');
    }

    function notify($goal_id)
    {
        $this->Db_model->update_one('notified', 1, 'id', $goal_id, 'goals');
    }

    function remind($goal_id)
    {
        $this->Db_model->update_one('reminded', 1, 'id', $goal_id, 'goals');
    }

    function update_one($column, $col_val, $where, $where_val, $table)
    {
        $data = array(
            $column => $col_val
        );
        $this->db->where($where, $where_val);
        $this->db->update($table, $data);
    }

    function get_active_users()
    {
        $this->db->select('id, username, email, timezone_offset');
        $this->db->from('users');
        $this->db->where('activated', 1);
        $query = $this->db->get();
        return $query->result();
    }

    function get_user_points($user_id)
    {
        $this->db->select('points');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        $points = $query->result();
        $points = $points[0]->points;
        return $points;
    }

    function get_goals_to_notify()
    {
        $current_hour = date("H");
        $positive_offset = (int) $current_hour * 60;
        $negative_offset = ((int) $current_hour - 24) * 60;

        $today = date("Y-m-d");
        $tomorrow = date("Y-m-d", $tomorrow = mktime(0,0,0,date("m"),date("d")+1,date("Y")));

        $this->db->select('users.id user_id, goals.id goal_id, email, username, timezone_offset, due_date, completed_date, rewarded_date, goal, reward');
        $this->db->from('users');
        $this->db->join('goals', 'goals.user_id = users.id');
        $this->db->where('subscribed', 1);
        $this->db->where('activated', 1);
        $this->db->where('notified', 0);
        $this->db->where('completed_date IS NULL');
        $this->db->where("((timezone_offset = $positive_offset AND due_date <= '$today') OR (timezone_offset = $negative_offset AND due_date <= '$tomorrow'))");
        $this->db->order_by("user_id");
        $query = $this->db->get();
        return $query->result();
    }

    function get_goals()
    {
        $this->db->select('users.id user_id, goals.id goal_id, email, username, timezone_offset, due_date, completed_date, rewarded_date, goal, reward');
        $this->db->from('users');
        $this->db->join('goals', 'goals.user_id = users.id');
        $this->db->where('subscribed', 1);
        $this->db->where('activated', 1);
        $this->db->where('completed_date IS NULL');
        $this->db->order_by("user_id");
        $query = $this->db->get();
        return $query->result();
    }

    function get_all_user_goals()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('goals', 'goals.user_id = users.id');
        $this->db->where('activated', 1);
        $this->db->order_by("user_id");
        $query = $this->db->get();
        return $query->result();
    }

    function get_rewards()
    {
        $this->db->select('users.id user_id, goals.id goal_id, email, username, timezone_offset, due_date, completed_date, rewarded_date, goal, reward');
        $this->db->from('users');
        $this->db->join('goals', 'goals.user_id = users.id');
        $this->db->where('subscribed', 1);
        $this->db->where('activated', 1);
        $this->db->where('completed_date IS NOT NULL');
        $this->db->where('rewarded_date IS NULL');
        $this->db->order_by("user_id");
        $query = $this->db->get();
        return $query->result();
    }

    function add_user_points($points)
    {
        $data = array(
            'points' => "points + $points"
        );
        $this->db->where('user_id', $this->tank_auth->get_user_id());
        $this->db->update('users', $data);
    }
}