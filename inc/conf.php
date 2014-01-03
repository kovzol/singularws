<?php

$TIMEOUT=30;
$LOGFILE="/tmp/singularws.log";
// Some Singular compilations lack option "-q",
// e.g. the Raspberry Pi version. Use the proper way
// for filtering out unneeded texts from the Singular output:
// $SILENT=" | grep -v ^//"; // for Raspberry Pi
$SILENT=" -q "; // for other systems

?>
