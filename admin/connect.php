<?php

// EDIT THESE
$host = 'localhost';
$user = 'root';
$pass = '';

// DONT EDIT
$db_name = 'fuclub';
$finishedOperations = false;



$conn = new MySQLi($host, $user, $pass);

if ($conn->connect_error) {
    die('Database connection error: ' . $conn->connect_error);
}

 if (!$finishedOperations) {
    // Create DATABASE 
$sql = "CREATE DATABASE IF NOT EXISTS $db_name";
if ($conn->query($sql) === TRUE) {
    $conn = new MySQLi($host, $user, $pass , $db_name);

    $sqljoinedTeams = "CREATE TABLE IF NOT EXISTS joinedteams (
    user_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    joined_team_id INT(11) NOT NULL,
    joined_team_name VARCHAR(500) NOT NULL,
    user_name VARCHAR(250) NOT NULL
    )";
    $conn->query($sqljoinedTeams);

    $sqljoinedUsers = "CREATE TABLE IF NOT EXISTS joinedusers (
    user_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    joined_team_id INT(11) NOT NULL,
    user_name VARCHAR(250) NOT NULL,
    user_email VARCHAR(250) NOT NULL,
    user_password VARCHAR(250) NOT NULL,
    user_image TEXT NOT NULL,
    user_status VARCHAR(150) NOT NULL,
    user_group_id INT(11) DEFAULT 0 NOT NULL,
    user_joined_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    user_team_joined VARCHAR(250) DEFAULT 0 NOT NULL,
    user_joined_team INT(11) DEFAULT 0 NOT NULL
    )";
    $conn->query($sqljoinedUsers);

    $sqlPublishedAnswers = "CREATE TABLE IF NOT EXISTS published_answers (
    answ_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    answ_ref_ques INT(11) NOT NULL,
    answ_ref_team INT(11) NOT NULL,
    answ_author VARCHAR(250) NOT NULL,
    answer_image TEXT NOT NULL,
    answ_rated INT(11) DEFAULT 0 NOT NULL
    )";
    $conn->query($sqlPublishedAnswers);

    $sqlPublishedCompetions = "CREATE TABLE IF NOT EXISTS published_competions (
    comp_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    comp_title VARCHAR(100) NOT NULL,
    comp_content VARCHAR(500) NOT NULL,
    comp_status VARCHAR(100) NOT NULL,
    comp_image TEXT NOT NULL,
    comp_location VARCHAR(100) NOT NULL,
    comp_publishers VARCHAR(100) NOT NULL,
    comp_author VARCHAR(250) NOT NULL,
    comp_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $conn->query($sqlPublishedCompetions);

    $sqlPublishedEvents = "CREATE TABLE IF NOT EXISTS published_events (
    event_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    event_title VARCHAR(250) NOT NULL,
    event_body VARCHAR(500) NOT NULL,
    event_location VARCHAR(150) NOT NULL,
    event_image TEXT NOT NULL,
    event_publishers VARCHAR(150) NOT NULL,
    event_status VARCHAR(64) NOT NULL,
    event_author VARCHAR(150) NOT NULL,
    event_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $conn->query($sqlPublishedEvents);

    $sqlPublishedPosts = "CREATE TABLE IF NOT EXISTS published_posts (
    id_post  INT(11) AUTO_INCREMENT PRIMARY KEY,
    title_post VARCHAR(100) NOT NULL,
    body_post VARCHAR(250) NOT NULL,
    status_post VARCHAR(64) NOT NULL,
    image_post TEXT NOT NULL,
    author_post VARCHAR(250) NOT NULL,
    date_post TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $conn->query($sqlPublishedPosts);

    $sqlPublishedQuestions = "CREATE TABLE IF NOT EXISTS published_questions (
    ques_id  INT(11) AUTO_INCREMENT PRIMARY KEY,
    ques_name VARCHAR(250) NOT NULL,
    ques_desc TINYTEXT NOT NULL,
    ques_image TEXT NOT NULL,
    ques_points INT(11) NOT NULL,
    ques_rel_comp INT(11) NOT NULL
    )";
    $conn->query($sqlPublishedQuestions);

    $sqlPublishedTeams = "CREATE TABLE IF NOT EXISTS published_teams (
    team_id  INT(11) AUTO_INCREMENT PRIMARY KEY,
    team_name VARCHAR(255) NOT NULL,
    team_join_pass VARCHAR(255) NOT NULL,
    team_score INT(11) NOT NULL,
    team_author_id INT(11) NOT NULL
    )";
    $conn->query($sqlPublishedTeams);

    $sqlPublishedGallery = "CREATE TABLE IF NOT EXISTS publsihed_gallery (
    img_id  INT(11) AUTO_INCREMENT PRIMARY KEY,
    img_rel_type VARCHAR(255) NOT NULL,
    img_link TEXT NOT NULL,
    img_rel_id INT(11) NOT NULL
    )";
    $conn->query($sqlPublishedGallery);

    $finishedOperations = true;

}
 }
