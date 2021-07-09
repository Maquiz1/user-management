<?php

require_once 'test3.php';

class SubClass extends BaseClass {
    // function __construct() {
        // parent::__construct();
        // print "In SubClass constructor\n";
    // }
}

// In BaseClass constructor
// In SubClass constructor
$obj = new SubClass();

?>