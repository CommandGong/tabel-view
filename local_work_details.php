<?php
    require_once 'header.php';
    require_once 'class/db.php';
?>

<?php
require_once 'config.php';

$ref_data = array();

if(isset($_GET['doi_id'])){
    if( $_GET['doi_id']!=""){
        $database = new db($config_database); 
        $database->connect(); 
        $work_data = $database->getWorksByDoi($_GET['doi_id'])[0];
        $database->closeConnection(); 
    }
}
 
function printJson($data){
    echo "<pre>";
    print_r($data);
    echo "<pre>";
}
?>
    <body>
        
     
        <div class="container work-details flex justify-center">
            <?php if(count($work_data)==0):?>
                <div class="detail-not-found text-center">
                    <h1>oops sound we did not find any thing</h1>
                </div>
            <?php  else :?>
      
            <div class="flex justify-center">
                <h2>DOI: <?php echo $work_data['doi']?></h2>
            </div>
            <div class="row justify-center">
                <div class="col-md-10 publish-content"> 
                    <div class="content-title">
                        <h4>Title: <?php echo $work_data['title']?></h4>
                    </div>
                    <hr>
                    <h6>Container Title: <?php echo $work_data['title']?></h6>
                    <h6>Publisher: <?php echo $work_data['publisher']?></h6>
                    <h6>Create Date:<?php echo $work_data['date']?></h6>
                    <div class="content-author">
                        <h6>
                            Author:
                            <?php foreach($work_data['author'] as $a):?>
                                <?php echo $a->given." , ".$a->family ?>
                            <?php endforeach;?>
                        </h6>
                        
                    </div>
                  
                </div>
                
            
            </div> 
           
            <?php endif ?>
        </div>
<?php
    require_once 'footer.php';
 
?>