<?php 

header('Acces-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Acces-Control-Allow-Methods: PUT');
header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$category = new Category($db);
//get raw category data
$data = json_decode(file_get_contents("php://input"));
//set id to update
$category->id = $data->id;
//assign data to category object
$category->name = $data->name;
//update category
if($category->update()) {
  echo json_encode(array('message' => 'Category updated'));
}  else {
  echo json_encode(array('message' => 'Ooops, category not updated'));
}