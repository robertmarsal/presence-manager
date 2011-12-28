<?php

abstract class View{
        
    public function __destruct() {
        $this->render();
    }
    
    private function render(){
        echo '<!DOCTYPE html>';
        echo '<html lang="en">';
        echo $this->head();
        echo $this->body();
        echo '</html>';
    }
    
    abstract function head();
    
    abstract function body();
	
}