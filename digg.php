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
	
	if(isset($argv["bgcolor"])) {	
		$diggBgColor = trim($argv["bgcolor"]);
	} 
	else {
		$diggBgColor = "";
	}
	if(isset($argv["style"])) {
		$diggStyle = trim($argv["style"]);
	}
	else {
		 $diggStyle = "";
	}
	
	if($diggStyle !== "compact") {
		$diggStyle = "";
	}


	if(empty($diggBgColor) && empty($diggStyle)) { 
		$output = "<script type='text/javascript'>digg_url = '$input';</script><script src='http://digg.com/api/diggthis.js' type='text/javascript'></script>";
	}
	elseif(empty($diggBgColor) && !empty($diggStyle)) {
		$output = "<script type='text/javascript'>digg_url = '$input'; digg_skin = '$diggStyle'; digg_bgcolor = '';</script><script src='http://digg.com/api/diggthis.js' type='text/javascript'></script>";
	}
	elseif(!empty($diggBgColor) && empty($diggStyle)) {
		$output = "<script type='text/javascript'>digg_url = '$input'; digg_skin = ''; digg_bgcolor = '$diggBgColor';</script><script src='http://digg.com/api/diggthis.js' type='text/javascript'></script>";
	}
	else {
		$output = "<script type='text/javascript'>digg_url = '$input'; digg_skin = '$diggStyle'; digg_bgcolor = '$diggBgColor';</script><script src='http://digg.com/api/diggthis.js' type='text/javascript'></script>";
	}    
	
	return $output;
}
?>

