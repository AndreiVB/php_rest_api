<?php 

header('Acces-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Acces-Control-Allow-Methods: PUT');
header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);
//get raw posted data
$data = json_decode(file_get_contents("php://input"));
//set id to update;
$post->id = $data->id;
//assign data to post object
$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;
//update post
if($post->update()) {
  echo json_encode(array('message' => 'Post updated'));
} else {
  echo json_encode(array('message' => 'Post not updated'));
}