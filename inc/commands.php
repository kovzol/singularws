<?php

include_once("conf.php");
include_once("base.php");

global $commands;

# SingularWS API
$commands['t']="test";
$commands['s']="singular_direct";

# Test for availability.
# Example: http://$IP/?c=t
function test() {
# Currently this is set to a dummy "ok".
 response("ok");
}

# Direct Singular call.
# Example: http://$IP/?c=s&123-56;
function singular_direct() {
 global $_GET, $_POST, $TIMEOUT;
 $problem=$_GET['p'];
 if (!$problem)
  $problem=$_POST['p'];
 $dirname=time().rand(10000000,99999999); // FIXME: for being collision-safe
 mkdir("cache/$dirname");
 $f=fopen("cache/$dirname/input","w");
 fwrite($f,$problem);
 fclose($f);
 passthru("cat cache/$dirname/input | /usr/bin/timeout $TIMEOUT Singular -q > cache/$dirname/output 2> cache/$dirname/error");
 echo file_get_contents("cache/$dirname/output");
 }

?>
