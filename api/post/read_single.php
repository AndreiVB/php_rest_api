<?php

header('Acces-Control-Allow-Origin: *');
header('Content-type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';
//db instanciate and connect
$database = new Database();
$db = $database->connect();
//instanciate blog post object
$post = new Post($db);

//get id from url
$post->id = isset($_GET['id']) ? $_GET['id'] : die('no id for the post');

//get post
$post->read_single();
//return json data
$post_arr = array(
  'id' => $post->id,
  'title' => $post->title,
  'body' => $post->body,
  'author' => $post->author,
  'category_id' => $post->category_id,
  'category_name' => $post->category_name   
);
//convert to json
print_r(json_encode($post_arr));