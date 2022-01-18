<?php 

header('Acces-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Acces-Control-Allow-Methods: POST');
header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$category = new Category($db);
//get raw posted data
$data = json_decode(file_get_contents("php://input"));

$category->id = $data->id;
$category->name = $data->name;

if($category->create()) {
  echo json_encode(array('message' => 'Category added'));
} else {
  echo json_encode(array('message' => 'Category not created'));
}