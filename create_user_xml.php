<?php

$xz = $_POST['xz'];
$love = $_POST['love'];
$work = $_POST['work'];
$luck = $_POST['luck'];

$xml = simplexml_load_file('data/user.xml');
$xml -> addChild('xz',$xz);
$xml -> addChild('love',$love);
$xml -> addChild('work',$work);
$xml -> addChild('luck',$luck);
$str = $xml -> asXML();

//将个人信息存入userXML
$ext = '.xml';
srand();
$randomNumber = rand(10000,99999);
$name = date("ymd").time().'_'.$randomNumber.$ext;  //随机文件名
$dir='data/user/'.$name; 
$file = fopen($dir,'w'); //必须在存在的文件夹中才能新建文件，如果没有指定的文件夹就会失败
fwrite($file,$str);
fclose($file);

//取出平均值 计算新的平均值
$avg = simplexml_load_file('data/result.xml');

for($i = 0;$i < 12;$i++){
	if($xz == $i){
	$avgNo = $avg -> xz[$i] -> no;
	$avgLove = $avg -> xz[$i] ->love;
	$avgWork = $avg -> xz[$i] ->work;
	$avgLuck = $avg -> xz[$i] ->luck;
	break;
	}
}

$avgLove = ($avgLove*$avgNo + $love)/($avgNo+1);
$avgWork = ($avgWork*$avgNo + $work)/($avgNo+1);
$avgLuck = ($avgLuck*$avgNo + $luck)/($avgNo+1);
$avgNo +=1;


$avg -> xz[intval($xz)] -> no = $avgNo;  //用作字符串系数需要强制转换
$avg -> xz[intval($xz)] -> love = $avgLove;
$avg -> xz[intval($xz)] -> work = $avgWork;
$avg -> xz[intval($xz)] -> luck = $avgLuck;
$new = $avg -> asXML();


$filer = fopen('data/result.xml','w');
fwrite($filer,$new);
fclose($filer);
/*
$list = simplexml_load_file('data/list.xml'); //将新用户数据名称加入列表XML
$no = $list -> no;
$no +=1;
$list -> no = $no;
$list -> addChild('dir',$name);
$listStr = $list -> asXML();
$file = fopen('data/list.xml','w');
fwrite($file,$listStr);
fclose($file);
*/
?>
