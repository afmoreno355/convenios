<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function autoload($class)
   {
       require_once __DIR__ . "/classes/$class.php";
   }
   spl_autoload_register('autoload');
