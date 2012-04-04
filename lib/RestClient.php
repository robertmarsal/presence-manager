<?php

class RestClient{
    
    private $session;
    private $apiroot;
    private $response;
    
    public function __construct($apiroot){
        $this->session = curl_init();
        $this->apiroot = $apiroot;
        $this->response = array();
    }
    
    public function __destruct() {
        curl_close($this->session);
    }
    
    public function request($uri, array $options){
        //set request url
        curl_setopt($this->session, CURLOPT_URL, $this->apiroot.$uri);
        //so we can use self generated ssl certificates
        curl_setopt($this->session, CURLOPT_SSL_VERIFYPEER, false);
        //set the user defined options
        curl_setopt_array($this->session, $options);
        
        //get the request content
        $this->response['content'] = curl_exec($this->session);
        //get the request info
        $this->response['info'] = curl_getinfo($this->session);
        
        return (object) $this->response;
    }
}