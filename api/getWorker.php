<?php
    //headers
    header('Access-Control-Allow-Origin');
    header('Content-Type: application/json');
?>
<?php 
    require_once '../class/db.php';
    require_once '../config.php';
?>

<?php 
    
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="my place');
    header('HTTP/1.0 401 Unauthorized'); 
    exit;
} else {
    
if($_SERVER['PHP_AUTH_USER']!=$config['api_user'] && $_SERVER['PHP_AUTH_PW']!= $config['api_password'] ){
        $work_data = array(
           "status" => "500", 
           "message" => "Authenticate failure", 
        );
       
    }
    else{
        if(isset($_GET['doi_id'])){
        if( $_GET['doi_id']!=""){
                $database = new db($config_database); 
                $database->connect(); 
                $work_data = $database->getWorksByDoi($_GET['doi_id'])[0];
                $database->closeConnection(); 
            }
        }
        else{
            $database = new db($config_database); 
            $database->connect(); 
            $work_data = $database->getWorks();
            $database->closeConnection(); 
        }
        $work_data["status"] = 200; 
        $work_data["message"] = "success"; 
    }
    
    
        
    echo json_encode($work_data);
 
     
}
   
    

    
    

 