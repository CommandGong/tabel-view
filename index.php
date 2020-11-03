<?php
    require_once 'header.php';
    require_once 'class/db.php';
?>
<?php 
    $database = new db($config_database); 
    $database->connect(); 
    $work_data = $database->getWorks();
    $database->closeConnection(); 
?>
    <body>
     
         
        <div class="container-fluid">
            <div class="search-area flex alian-item-center justify-center">
                <div class="search-topic">
                    <h1>Welcome</h1>
                    <h6>If you could not find the work you want in the table below, you could enter the DOI number below to search from the CrooRef database</h6>
                </div>
                <div>
                    <form action="online_work_lists.php" method="get">
                        <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Enter the Work DOI " name="doi_id">
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text">search</button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <script>
                /*implement search function*/
                $(document).ready(function(){
                    $("#searchinput").on("keyup", function() {
                        var value = $(this).val().toLowerCase();
                        console.log(value);
                        $("#myTaskTableBody tr").filter(function() {
                          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                        });
                    });
                });
            </script>
            <div class="table_search">
                <input id="searchinput" type="text" placeholder="Search..">
                <h4>By clicking the link of the DOI to access the detail page</h4>
            </div>
            <table class="table" id="myTaskTable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">DOI</th> 
                        <th scope="col">Date</th>
                        <th scope="col">title</th> 
                        <th scope="col">publisher</th>
                    </tr>
                </thead>
                <tbody  id="myTaskTableBody">
                    <?php foreach ($work_data as $work):?>
                    <tr>
                        <th scope="row">
                            <div class="table-content table_index">
                              <?php echo $work['id']?>
                            </div>
                        </th>
                        <td>
                            <div class="table-content">
                                <a href="<?php echo $config['home_url']."/local_work_details.php?doi_id=".$work['doi']; ?> "><?php echo $work['doi']?></a>
                            </div>
                        </td>
                        <td>
                            <div class="table-content">
                                <?php echo $work['date']?>
                            </div>
                        </td>
                        <td>
                            <div class="table-content ">
                                <?php echo $work['title']?>
                            </div>
                        </td>
                        <td>
                            <div class="table-content ">
                                <?php echo $work['publisher']?>
                            </div>
                        </td>

                    </tr>
                    <?php endforeach ?>


                </tbody>
            </table>

        </div>
<?php
    require_once 'footer.php';
?>