<?php

function moduleLoader($class) {
    include 'class/' . $class . 'Class.php';
}

spl_autoload_register('moduleLoader');