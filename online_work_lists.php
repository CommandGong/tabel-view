<?php
    require_once 'header.php';
?>

<?php
require_once 'config.php';
require_once 'class/crossref_library.php';
require_once 'class/db.php';

$ref_data = array();

if(isset($_GET['doi_id'])){
    if( $_GET['doi_id']!=""){
        $config['crossref_doi'] = $_GET['doi_id'];
        $cro = new crossref_library($config); 
        $ref_data  = json_decode($cro->getWorkers());
    }
}

//printJson($ref_data);
function printJson($data){
    echo "<pre>";
    print_r($data);
    echo "<pre>";
}
?>
    <body>
        
     
        <div class="container work-details flex justify-center">
            <?php if(!isset($ref_data->status)):?>
                <div class="detail-not-found text-center">
                    <h1>oops sound we did not find any thing</h1>
                </div>
            <?php  else :?>
            <?php 
                $work_data['doi'] = $ref_data->message->DOI;
                $work_data['type'] = $ref_data->message->type;
                $work_data['publisher'] = $ref_data->message->publisher;
                $work_data['create_date'] = $ref_data->message->created->{'date-time'};
                $work_data['title'] = $ref_data->message->title[0];
                $work_data['container_title'] = $ref_data->message->{'container-title'}[0];
                $work_data['issn'] = implode (',',$ref_data->message->ISSN);
                $work_data['url'] = $ref_data->message->URL;
                $work_data['author'] = $ref_data->message->author;
            ?>
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
                    <h6>Create Date:<?php echo $work_data['create_date']?></h6>
                    <h6>URL: <?php echo $work_data['url']?></h6>
                    <div class="content-author">
                        <h6>
                            Author:
                            <?php foreach($work_data['author'] as $a):?>
                                <?php echo $a->given." , ".$a->family ?>
                            <?php endforeach;?>
                        </h6>
                        
                    </div>
                    <div class="text-center">
                        <form action="add_work.php" method="post">
                            <div class="justify-center"> 
                                <input type="text" class="hidden" value="<?php echo $work_data['doi']; ?>" name="doi_id">
                                <button type="submit" class="btn btn-primary">Add to local Database</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            
            </div> 
           
            <?php endif ?>
        </div>
<?php
    require_once 'footer.php';
 
?>