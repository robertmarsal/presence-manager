<?php

require_once dirname(__FILE__) . '/../../../lib/Lang.php';
require_once dirname(__FILE__) . '/../../../lang/en.php';

/**
 * Test class for Lang
 */
class LangTest extends PHPUnit_Framework_TestCase {

    protected function setUp() {
    }

    protected function tearDown() {
    }

    /**
     * Tests get method
     */
    public function testGet() {
        
        //test equals
        $brand  = 'Presence';
        $this->assertEquals($brand, Lang::get('brand'));
    }

}

?>
