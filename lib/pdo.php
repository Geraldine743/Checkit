<?php
try 
{
    $pdo = new PDO ("mysql:dbname=checkit;host=localhost","root","root");
}
catch(Exception $e)
{
    die ('Erreur'.$e->getMessage());
}
?>