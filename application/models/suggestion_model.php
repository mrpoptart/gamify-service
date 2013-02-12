<?php
/**
 * Created by IntelliJ IDEA.
 * User: meneli
 * Date: 1/6/13
 * Time: 8:12 AM
 * To change this template use File | Settings | File Templates.
 */

class Suggestion_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_goal_suggestion()
    {
        $suggestions = array();
        array_push($suggestions,"finish a craft project");
        array_push($suggestions,"start a craft project");
        array_push($suggestions,"learn a new skill");
        array_push($suggestions,"teach someone something");
        array_push($suggestions,"organize your room");
        array_push($suggestions,"clean your desk");
        array_push($suggestions,"organize your music collection");
        array_push($suggestions,"organize your photos");
        array_push($suggestions,"meditate");
        array_push($suggestions,"find that perfect gift");
        array_push($suggestions,"call a friend");
        array_push($suggestions,"write a letter");
        array_push($suggestions,"volunteer");
        array_push($suggestions,"learn to program");
        array_push($suggestions,"memorize a poem");
        array_push($suggestions,"take a class");
        array_push($suggestions,"build a website");
        array_push($suggestions,"get better at touch typing");
        array_push($suggestions,"learn an opening move in chess");
        array_push($suggestions,"practice an instrument");
        return $suggestions[array_rand($suggestions)];
    }

    function get_reward_suggestion()
    {
        $rewards = array();
        array_push($rewards,"eat something special");
        array_push($rewards,"take a friend out to eat");
        array_push($rewards,"go see a movie");
        array_push($rewards,"read a chapter in a book");
        array_push($rewards,"check facebook");
        array_push($rewards,"go see a friend");
        array_push($rewards,"road trip");
        array_push($rewards,"watch an episode of tv");
        array_push($rewards,"5$ toward visiting someone");
        array_push($rewards,"post a tweet");
        array_push($rewards,"a new tool");
        array_push($rewards,"a kitchen gadget");
        array_push($rewards,"a new cd");
        array_push($rewards,"a new movie");
        return $rewards[array_rand($rewards)];
    }

}