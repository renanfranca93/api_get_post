<?php

header('Contetnt-Type: application/json; charset:utf-8');

require "classes/Class.php";

if(isset($_REQUEST)){

    Api::open($_REQUEST);

}


?>