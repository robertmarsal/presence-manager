<?php

class View{
    
    public function __construct() {
        $this->doctype = '<!DOCTYPE html>';
    }
    
    public function __destruct() {
        $this->render();
    }
    
    private function render(){
        echo $this->doctype;
        $this->start('html');
        
        $this->end('html');
    }
    
    private function start($tag){
        echo '<'.$tag.'>';
    }
    
    private function end($tag){
        echo '</'.$tag.'>';
    }
}