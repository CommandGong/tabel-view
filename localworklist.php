
<?php
    require_once 'header.php';
    require_once 'config.php';
?>
<?php
$doi = null;
if(isset($_GET['doi_id'])){
    if( $_GET['doi_id']!=""){;
        $doi = $_GET['doi_id'];
    }
}
?>
<html>
    <head>

    </head>
    <body>
   
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
                                    <tr  v-for="work in info">
                                        <th scope="row">
                                            <div class="table-content table_index">
                                                {{work.id}}
                                            </div>
                                        </th>
                                        <td>
                                            <div class="table-content">
                                                <a v-bind:href="'<?php echo $config['home_url']."/local_work_details.php?doi_id="; ?>' + work.doi">{{work.doi}}</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-content">
                                                {{work.date}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-content ">
                                                {{work.title}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-content ">
                                                {{work.publisher}}
                                            </div>
                                        </td>

                                    </tr> 
                            </tbody>
                       
                    </table>
      
        <script>
            new Vue({
                el: '#myTaskTable',
                data () {
                    return {
                      info: null
                    }
                },
                mounted () {
                  axios
                    .get(
                        '<?php echo $config['home_url']."/api/getWorker.php"?>',{
                            auth: {
                                username:'<?php echo $config['api_user']?>',
                                password:'<?php echo $config['api_password']?>'
                            }
                        }
                    )
                    .then(response => (this.info = response.data.works))
                }
              })
            new Vue({
                el: '#app',
                data () {
                    return {
                      info: null
                    }
                },
                mounted () {
                  axios
                    .get(
                        '<?php echo $config['home_url']."/api/getWorker.php"?>',{
                            auth: {
                                username:'<?php echo $config['api_user']?>',
                                password:'<?php echo $config['api_password']?>'
                            }
                        }
                    )
                    .then(response => (this.info = response))
                }
              })
        </script>
<?php require_once 'footer.php'?>