<?php
require_once dirname(__FILE__) . '/../../config/config.php';
require_once dirname(__FILE__) . '/../../lib/RestClient.php';

class API_IntegrationTests extends PHPUnit_Framework_TestCase {

    /**
     * Creates an instance of the RestClient, that will be used for testing
     * 
     * @global Object $CONFIG 
     */
    protected function setUp() {
        global $CONFIG;
        $this->restclient = new RestClient($CONFIG->apiroot);
    }

    /**
     * Test if an empty request returnsa 403 (Forbidden) code. It does not check
     * for html output as this depends on the server and is irelevant for this 
     * test case.
     * 
     * @group integration
     */
    public function testEmptyURIRequest(){
        $request_options = array(CURLOPT_RETURNTRANSFER => false);
        $request_uri = '/';
        $response = $this->restclient->request($request_uri, $request_options);
        //check if the http return code is 403 (Forbidden)
        $this->assertEquals(403, $response->info['http_code']);
    }
    
    /**
     * If a request is made on an inexistent/unimplemented resource the API 
     * should return a 400 code and no content.
     * 
     * @group integration
     */
    public function testBadURIRequest(){
        $request_uri = '/foo/bar';
        $response = $this->restclient->request($request_uri);
        
        //check if return http code is 400 (Bad Request)
        $this->assertEquals(400, $response->info['http_code']);
        //check if return content is empty
        $this->assertEmpty($response->content);
    }
    
    /**
     * If a request does not have a 'token' parameter API should return 401 code
     * and the content of the response should be empty.
     * 
     * @group integration
     */
    public function testNoTokenRequest(){
        $request_uri = '/user/status';
        $response = $this->restclient->request($request_uri);
        
        //check if return http code is 401 (Unauthorized)
        $this->assertEquals(401, $response->info['http_code']);
        //check if return content is empty
        $this->assertEmpty($response->content);
    }

    /**
     * If a request suplies a 'fake' token the API should return a 401 code and
     * no content.
     * 
     * @group integration
     */
    public function testFakeTokenRequest(){
        $request_uri = '/user/status?token=thisisafaketoken';
        $response = $this->restclient->request($request_uri);
        
        //check if return http code is 401 (Unauthorized)
        $this->assertEquals(401, $response->info['http_code']);
        //check if return content is empty
        $this->assertEmpty($response->content);
    }
            
    protected function tearDown(){}
}