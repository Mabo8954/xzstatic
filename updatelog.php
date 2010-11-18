<?php
date_default_timezone_set("Asia/Hong_Kong");
$date = date("y/m/d");
$logXML = simplexml_load_file('log.xml');
if(isset($_POST['log'])){
    $logB = $logXML -> addChild('logB');
    $logB -> addChild('date',$date);
    $logB -> addChild('contain',$_POST['log']);
    $strXML = $logXML -> asXML();
	$file = fopen('log.xml','w');
	fwrite($file,$strXML);
	fclose($file);
}else{
	echo "Nothing Post to this page!";
}
?>
