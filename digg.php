<?php
 
 /**
 * mediawiki-digg-extension : "Show Digg Counts on Your Site".
 * Copyright (C) 2007 Thomas Amsler
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 **/
 

 /**
 *
 * @version 1.0.2
 * @author Thomas Amsler
 * @copyright Thomas Amsler 2007
 *
 **/

$wdVersion = '1.0.2';

$wgExtensionCredits['other'][] = array
  (
   'name' => "Show Digg.com Counts On Your Site",
   'version' => $wdVersion,
   'author' => 'Thomas Amsler',
   'url' => 'http://thomasamsler.org/wiki/MediaWiki',
   'description' => 'Show Digg.com Counts On Your Site'
   );


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

