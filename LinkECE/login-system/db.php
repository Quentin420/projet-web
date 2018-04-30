<?php
/* Database connection settings */
$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'linkece';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
