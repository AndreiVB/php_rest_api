<?php

header('Acces-Control-Allow-Origin: *');
header('Content-type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$category = new Category($db);

$result = $category->read();
//get row count
$num = $result->rowCount();

if($num > 0 ) {
  $cat_arr = array();
  $cat_arr['data'] = array();
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $cat_item = array(
      'id' => $id,
      'name' => $name);
    //push to "data"
    array_push($cat_arr['data'], $cat_item);
  }
  //convert to Json and output
  echo json_encode($cat_arr);
} else {
  echo json_encode(
    array('message' => 'No categories found')
  );
}