<?php

include_once("inc/commands.php");
include_once("inc/errors.php");

function exec_request() {
 global $_GET, $commands;
 $command=$_GET["c"];
 $function=$commands[$command];
 if (!$function) {
  error_response("NoSuchCommand");
  }
 else {
  $function();
  }
 }

function error_response($errtext) {
 global $errors;
 $errcode=$errors[$errtext];
 if (!$errcode) {
  $errcode="e0:".$errtext;
  }
 response($errcode);
 }

function response($text) {
 echo $text;
 die();
 }

?>
