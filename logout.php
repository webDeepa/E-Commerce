<?php
session_start();
$_SESSION = array();
session_unset();
session_destroy();	
$logoutinfo= '<p> <b>You have been successfully logged out.</b></p>';