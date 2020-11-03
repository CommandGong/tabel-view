<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of db
 *
 * @author yanbi
 */


class db {
    private $db_config = [];
    private $connect;
    /*
     * @parm array(String servername,String username,String password)
     */
    function __construct($config) {
        $this->db_config = $config;
    }
    
    /*
     * connect to database 
     * @parm  void
     * return array(String status, String message)
     */
    public function connect(){
        $this->connect =   new mysqli($this->db_config['servername'], $this->db_config['username'], $this->db_config['password'], $this->db_config['db_name']);
        if ($this->connect->connect_error) {
            return array(
                "status" => "error",
                "message" => "Connection failed"                
            );
        }//failed to connect the database
        else{
            return array(
                "status" => "success",
                "message" => "Connection Success"
            );
        }//successed to connect the database
        
    }
    /*
     * validate incomeing data from CrossRef API before load it in to local database
     * @parm array() of CrossRef data
     */
    public function validateCresData(){
        if(!isset($ref_data->status)&&$ref_data->status!="ok"){
             return array(
                "status"=>"failed",
                "message"=> "connect CrossRef failed"
            );
        }
        
        return array(
            "status"=>"success",
            "message"=>"validated incoming strings",
        );
    }
    
    public function addWork($work_details){ 
        if(!$this->doiExist($work_details['doi'])){
            $author = json_encode($work_details['author']); 
            $today = date("Y-m-d H:i:s");  
            $sql = "INSERT INTO `work` (`id`, `doi`, `publisher` , `create_date`, `type`, `title`, `container-title`, `issn`, `author`) VALUES "
                    . "(NULL, '".$work_details['doi']."', '".$work_details['publisher']."', '".$today."', '".$work_details['type']."', '".$work_details['title']."', '".$work_details['container_title']."', '".$work_details['issn']."','".$author."')";
            if (mysqli_query($this->connect, $sql)) {
                echo "New record created successfully";
            } else {
                echo "some thing went to wrong";
            }
        }
        else{
            echo "record is already exists";
        }
       
    }
    /*
     * check if the work with the doi is already exist in the local database
     * return bool
     * @parm string doi
     */
    public function doiExist($doi){
        $sql = "SELECT * FROM `work` WHERE doi = '".$doi."' ";
        $result = $this->connect->query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
           return false;
        }
    }
    /*
     * find all local work
     */
    public function getWorks(){
        $result = [];
        $sql = "SELECT * FROM `work` WHERE 1 ";
        $data= $this->connect->query($sql);
        if ($data->num_rows > 0) {
            while($row = $data->fetch_assoc()) {
               $result[] = array(
                   'id' => $row['id'],
                   'doi' => $row['doi'],
                   'date' => $row['create_date'],
                   'publisher' => $row['publisher'],
                   'type' => $row['type'],
                   'title' => $row['title'],
                   'container-title' => $row['container-title'],
                   'issn' => $row['issn'],
                   'author' => json_decode($row['author'])
               );
            }
            return $result;
        } else {
           return $result;
        }
    }
    /*
     * find  local work by given doi
     * return array()
     * @parm string doi
     */
    public function getWorksByDoi($doi){
        $result = [];
        $sql = "SELECT * FROM `work` WHERE doi = '".$doi."' ";
        $data= $this->connect->query($sql);
        if ($data->num_rows > 0) {
            while($row = $data->fetch_assoc()) {
               $result[] = array(
                   'id' => $row['id'],
                   'doi' => $row['doi'],
                   'date' => $row['create_date'],
                   'publisher' => $row['publisher'],
                   'type' => $row['type'],
                   'title' => $row['title'],
                   'container-title' => $row['container-title'],
                   'issn' => $row['issn'],
                   'author' => json_decode($row['author'])
               );
            }
            return $result;
        } else {
           return $result;
        }
    }
    
     
    /*
     * shutdown the database connection
     * return void
     */
    public function closeConnection(){
        if($this->connect!=NULL){
            $this->connect->close();
        }
    }
   
    
    
    
}
