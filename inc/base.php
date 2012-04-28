<?php

include_once("inc/commands.php");
include_once("inc/errors.php");
include_once("inc/conf.php");

function exec_request() {
 global $_GET, $_POST, $commands;
 $command=$_GET["c"];
 if (!$command)
  $command=$_POST["c"];
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

function debug($text) {
 global $LOGFILE;
 if (!$LOGFILE)
  return;
 $f=fopen($LOGFILE,"a");
 fwrite($f,$text."\n");
 fclose($f);
 }

function info() {
 global $LOGFILE;
 if (!$LOGFILE)
  return;
 $f=fopen($LOGFILE,"a");
 ob_start();
 phpinfo(INFO_VARIABLES);
 fwrite($f,ob_get_contents());
 ob_end_clean();
 fclose($f);
 }

?>
