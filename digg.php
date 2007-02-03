<?php

##
# Digg.com "Show Digg Counts on Your Site" Code:
# http://digg.com/tools/count
##

$wgExtensionFunctions[] = "wfDiggExtension";

function wfDiggExtension() {
    global $wgParser;
    $wgParser->setHook( "digg", "renderDigg" );
}

# The callback function for converting the input text to HTML output
function renderDigg( $input, $argv, &$parser ) {
    $output = "<script>digg_url = '$input';</script><script src='http://digg.com/api/diggthis.js'></script>";
    return $output;
}
?>

