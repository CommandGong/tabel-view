<?php
require_once '../config.php';
require_once '../class/crossref_library.php';
require_once '../class/db.php';
 
$cro = new crossref_library($config); 
$database = new db($config_database); 
$ref_data = json_decode($cro->getWorkers()); 
//print_r($database->connect());

printJson($ref_data->message->{'container-title'}[0]);

$work_data['doi'] = $ref_data->message->DOI;
$work_data['type'] = $ref_data->message->type;
$work_data['publisher'] = $ref_data->message->publisher;
$work_data['create_date'] = $ref_data->message->created->{'date-time'};
$work_data['title'] = $ref_data->message->title[0];
$work_data['container_title'] = $ref_data->message->{'container-title'}[0];
$work_data['issn'] = implode (',',$ref_data->message->ISSN);
$work_data['url'] = $ref_data->message->URL;
$work_data['author'] = $ref_data->message->author;
print_r($work_data);
function printJson($data){
    echo "<pre>";
    print_r($data);
    echo "<pre>";
}