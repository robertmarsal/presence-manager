<?php

require_once dirname(__FILE__) . '/../../../config/config.php';
require_once dirname(__FILE__) . '/../../../app/model.class.php';
require_once dirname(__FILE__) . '/../../../app/models/UserModel.php';
require_once dirname(__FILE__) . '/../../../lib/DB.php';

/**
 * Test class for Model. UserModel class is used to test the core Model 
 * functions because a Model class is binded to a database table and the parent
 * model class is not binded to one beeing an abstract class
 */
class ModelTest extends PHPUnit_Framework_TestCase {
    
    protected $id = '999999';
    protected $identifier = 'tester';
    protected $pass = 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3';
    protected $role = 'user';
    protected $firstname = 'John';
    protected $lastname = 'Doe';
    protected $position = 'Tester';
    protected $uuid = '1x2';
    protected $mac = 'M:A:C';   
    
    protected function setUp() {
        //set up the database connection
        global $CONFIG;
        DB::setUp($CONFIG);
        
        //prepare presence_users table for testing
        $sql = "INSERT INTO `presence_users` (`id`,`identifier`, `password`, 
                    `role`, `firstname`, `lastname`, `position`, `UUID`, `mac`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        DB::runSQL($sql, array($this->id, $this->identifier, $this->pass, 
            $this->role, $this->firstname, $this->lastname, $this->position, 
            $this->uuid, $this->mac));
    }

    protected function tearDown() {
        //restore presence_users table state
       
        //remove possible tester users
        $sql = "DELETE 
                FROM presence_users 
                WHERE id = ? OR id = ? OR id = ? LIMIT 1";
        DB::runSQL($sql, array('999999', '999998', '999997'));  
    }

    /**
     * Returns the total rows of the presence_users table.
     * @return type Integer
     */
    protected function total(){
        //get the total count
        $sql = "SELECT COUNT(*) as total
                FROM presence_users";
        $total = DB::getRecord($sql, array());
        return $total->total;
    }

    //+------------------------------------------------------------------------+
    //+ Tests for the abstract Model functions using UserModel as instance     +
    //+------------------------------------------------------------------------+
    
    /**
     * Tests the find method
     */
    public function testFind() {
        
        //existing user
        $user = UserModel::find('999999');

        //assert all the values!
        $this->assertEquals($this->id, $user->id);
        $this->assertEquals($this->identifier, $user->identifier);
        $this->assertEquals($this->pass, $user->password);
        $this->assertEquals($this->role, $user->role);
        $this->assertEquals($this->firstname, $user->firstname);
        $this->assertEquals($this->lastname, $user->lastname);
        $this->assertEquals($this->position, $user->position);
        $this->assertEquals($this->uuid, $user->UUID);
        $this->assertEquals($this->mac, $user->mac);
        
        //unexistent user
        $false_user = UserModel::find('xxxx');
        //this should return false
        $this->assertFalse($false_user);
    }

    /**
     * Tests for the find_all method
     */
    public function testFindAll() {
        //compare the count of results
        $this->assertEquals($this->total(), count(UserModel::find_all()));
    }

    /**
     * Tests the create method
     */
    public function testCreate() {

        //create fake user
        $user = new stdClass();
        $user->id = '999998';
        $user->identifier = 'tester2';

        //store the fake user
        UserModel::create($user);
        $db_user = UserModel::find('999998');
        
        //compare the id's
        $this->assertEquals($user->id, $db_user->id);
    }

    /**
     * Tests the delete method
     */
    public function testDelete() {
        
        //create fake user
        $user = new stdClass();
        $user->id = '999997';
        $user->identifier = 'tester3'; 
        
        //store the fake user
        UserModel::create($user);
        
        //delete the fake user
        UserModel::delete('999997');
    
        //check that the user is gone
        $this->assertFalse(UserModel::find('999997'));
    }

    /**
     * Tests the update method
     */
    public function testUpdate() {
        
        //update main tester user data
        UserModel::update('999999', array('UUID' => '1x3'));
        $updated_user = UserModel::find('999999');
        
        //check if the data is updated
        $this->assertEquals($updated_user->UUID, '1x3');
    }

    /**
     * Tests the pages method
     */
    public function testPages() {
        
        //calculate pages
        $total = $this->total();
        $rest = ($total % 10) > 0 ? 1 : 0;
        $pages = (($total - ($total % 10)) / 10) + $rest;
        
        //compare page numbers
        $this->assertEquals($pages, UserModel::pages());
    }
   
    //+------------------------------------------------------------------------+
    //+ Tests for the UserModel class specific functions                      +
    //+------------------------------------------------------------------------+
    
    public function testFindByIdentifier() {
        
        //get the user using his identifier
        $user = UserModel::find_by_identifier('tester');
        //compare the id's
        $this->assertEquals($this->id, $user->id);
    }

}

?>
