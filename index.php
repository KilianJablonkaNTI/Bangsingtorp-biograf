<?php
if(!isset($_SESSION))
{
	session_start();
}

$_SESSION["signed-in-as"] = "none";

include_once "startpage.php";