<?php


/**
 * Description of crossref_library
 *
 * @author John
 */
class pubmed_library {
    private $config = [];
    function __construct($config) {
        $this->config = $config;
    }
    public function getConfig(){
        return $this->config;
    }
    public  function getAgency(){
        // create curl resource
        $ch = curl_init(); 
        $url = "https://eutils.ncbi.nlm.nih.gov/entrez/eutils/ecitmatch.cgi?db=pubmed&rettype=xml&bdata=31115346"; 
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);  
        $result = json_decode($output, true);
        return $output;
    }
    public function getWorkers(){
         // create curl resource
        $ch = curl_init(); 
        $url = "http://api.crossref.org/works/".$this->config['crossref_doi']."";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, $this->config['crossref_user_agent']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);  
        $result = ($output);
        return $result;
    }
    
    
}
