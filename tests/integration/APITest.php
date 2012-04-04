<?php
require_once dirname(__FILE__) . '/../../config/config.php';
require_once dirname(__FILE__) . '/../../lib/RestClient.php';

class APITest extends PHPUnit_Framework_TestCase {

    protected function setUp() {
        global $CONFIG;
        $this->restclient = new RestClient($CONFIG->apiroot);
    }

    /**
     * If a request does not have a 'token' parameter API should return 401 code
     * and the content of the response should be empty 
     */
    public function testNoTokenRequest(){
        $request_options = array(CURLOPT_RETURNTRANSFER => true);
        $request_uri = '/user/status';
        $response = $this->restclient->request($request_uri, $request_options);
        
        //check if return http code is 401 (Unauthorized)
        $this->assertEquals(401, $response->info['http_code']);
        //check if return content is empty
        $this->assertEmpty($response->content);
    }

    /**
     * If a request suplies a 'fake' token the API should return a 401 code and
     * no content 
     */
    public function testFakeTokenRequest(){
        $request_options = array(CURLOPT_RETURNTRANSFER => true);
        $request_uri = '/user/status?token=thisisafaketoken';
        $response = $this->restclient->request($request_uri, $request_options);
        
        //check if return http code is 401 (Unauthorized)
        $this->assertEquals(401, $response->info['http_code']);
        //check if return content is empty
        $this->assertEmpty($response->content);
    }
    
    
    protected function tearDown() {
        
    }

}

?>
