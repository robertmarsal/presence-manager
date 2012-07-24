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

    protected function tearDown() {}
}