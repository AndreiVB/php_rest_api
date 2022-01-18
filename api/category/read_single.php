<?php

header('Acces-Control-Allow-Origin: *');
header('Content-type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';
//db instanciate and connect
$database = new Database();
$db = $database->connect();
//instanciate blog category object
$category = new Category($db);

//get id from url
$category->id = isset($_GET['id']) ? $_GET['id'] : die('no id for the category');

//get post
$category->read_single();
//return json data
$category_arr = array(
  'id' => $category->id,
  'category_name' => $category->name   
);
//convert to json
print_r(json_encode($category_arr));