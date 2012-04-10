<?php
require_once dirname(__FILE__) . '/../../../app/view.class.php';
require_once dirname(__FILE__) . '/../../TestHelper.php';

class ViewClassTest extends PHPUnit_Framework_TestCase {

    /**
     * Mock of the abstract class 'View'
     * 
     * @var View
     */
    protected $view;

    /**
     * Creates a mock of the abstract class 'View'  
     */
    protected function setUp() {
        $this->view = $this->getMockForAbstractClass('View');
    }
    
    /**
     * Tests if the title is set correctly
     * 
     * @group unit
     */
    public function testSetTitle(){
        //get & call the title method with the 'Foo Bar' value
        $title_method = TestHelper::getAccessibleMethod('View', 'title');
        $title_method->invokeArgs($this->view, array('Foo Bar'));
        //get the title attribute
        $title_attr = TestHelper::getAccessibleAttribute('View', '_title');
        //check if the title is set
        $this->assertEquals('Foo Bar', $title_attr->getValue($this->view));
    }
   
    protected function tearDown() {}
}