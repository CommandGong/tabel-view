<?php
require_once 'config.php';
require_once 'class/crossref_library.php';
require_once 'class/db.php';

$ref_data = array();

if(isset($_POST['doi_id'])){
    if( $_POST['doi_id']!=""){
        $config['crossref_doi'] = $_POST['doi_id'];
        $cro = new crossref_library($config); 
        $ref_data  = json_decode($cro->getWorkers());
        $database = new db($config_database); 
        
        $work_data['doi'] = $ref_data->message->DOI;
        $work_data['type'] = $ref_data->message->type;
        $work_data['publisher'] = $ref_data->message->publisher;
        $work_data['create_date'] = $ref_data->message->created->{'date-time'};
        $work_data['title'] = $ref_data->message->title[0];
        $work_data['container_title'] = $ref_data->message->{'container-title'}[0];
        $work_data['issn'] = implode (',',$ref_data->message->ISSN);
        $work_data['url'] = $ref_data->message->URL;
        $work_data['author'] = $ref_data->message->author;
        
        $database->connect();
        $database->addWork($work_data);
        
    }
}