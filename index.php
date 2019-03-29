<?php
if(!isset($_SESSION))
{
	session_start();
}

$_SESSION["signed-in-as"] = "not-in";

include_once "startpage.php";