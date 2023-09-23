<?php
spl_autoload_register("Autoloader");

function Autoloader ($className){
    

   $path ="classes/";
   $extension =".classes.php";
   $fileName = $path.$className.$extension;

   if (!file_exists($fileName)){
        return false;
   }
   
   include_once  $path.$className.$extension;


   }