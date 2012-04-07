<?php
require_once dirname(__FILE__) . '/../../../app/controller.class.php';
require_once dirname(__FILE__) . '/../../TestHelper.php';

class ControllerClassTest extends PHPUnit_Framework_TestCase {

    /**
     * Mock instance of the abstract class Controller.
     * 
     * @var Controller
     */
    protected $controller;

    /**
     * Mock method of check_role with the visibility changed to public for 
     * testing purposes.
     * 
     * @var Method
     */
    protected $method;
    
    /**
     * Creates a mock for the abstract class 'Controller', and changes the 
     * visibility of the 'check_role' method to public so it can be tested.
     * Also sets the session variable role to 'admin'.
     */
    protected function setUp() {
        //create a mock of the abstract class
        $this->controller = $this->getMockForAbstractClass('Controller');
        
        //change visibility of 'check_role' to public
        $this->method = TestHelper::getAccessibleMethod('Controller', 'check_role');
        
        //set the role to admin
        $_SESSION['role'] = 'admin';
    }
    
    /**
     * Tests the 'check_role' method 
     * 
     * @group unit
     */
    public function testCheckRole(){
        $this->assertFalse(
                $this->method->invokeArgs($this->controller, array('user')));
        $this->assertTrue(
                $this->method->invokeArgs($this->controller, array('admin')));
    }
    
    /**
     * Clear the session 
     */
    protected function tearDown() {
        unset($_SESSION);
    }
}