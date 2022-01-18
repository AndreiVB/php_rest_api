<?php 

header('Acces-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Acces-Control-Allow-Methods: DELETE');
header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$category = new Category($db);
//get raw posted data
$data = json_decode(file_get_contents("php://input"));
//set id to delete
$category->id = $data->id;
//delete category
if($category->delete()) {
  echo json_encode(array('message' => 'Category deleted'));
} else {
  echo json_encode(array('message' => 'Category not deleted'));
}