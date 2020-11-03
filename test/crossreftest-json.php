<?php
require_once '../config.php';
require_once '../class/crossref_library.php';
require_once '../class/db.php';
 
$cro = new crossref_library($config); 
$database = new db($config); 
//print_r($database->stringFilter());
printJson($cro->getWorkers());

function printJson($data){
    echo "<pre>";
    print_r($data);
    echo "<pre>";
}