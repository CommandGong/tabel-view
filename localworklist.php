
<?php
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
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> 
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    </head>
    <body>
        <div id="app">
            {{ info }}
        </div>
        <script>
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
                   // .get('http://api.crossref.org/works/<?php echo $doi?>')
                    .then(response => (this.info = response))
                }
              })
        </script>
    </body>
    
</html>