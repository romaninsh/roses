<?php
include'atk4/loader.php';
$api=new ApiWeb();
$api->add('jUI');

$f=$api->add('Form');
$f->addField('line','n');
$f->addField('line','a');
$f->addField('line','b');
$f->addField('line','c');
$f->addField('line','d');

$f->addField('line','result');
$f->addField('line','distance');
$f->addField('text','output');
$f->addSubmit();
$at=$f->addButton('Autotest');

if($at->isClicked()){
	$api->add('Controller_RoseTester')->test();
	echo "OK";
	exit;
}

if($f->isSubmitted()){
	ob_start();
	$ctl=$api->add('Controller_Roses');
	$res=$ctl->solve(
		$f->get('n'),
		$f->get('a'),
		$f->get('b'),
		$f->get('c'),
		$f->get('d') );

	$out=ob_get_contents();
	ob_end_clean();

	$js=array();
	$js[]=$f->getElement('result')->js()->val($res);
	$js[]=$f->getElement('output')->js()->val($out);
	$js[]=$f->getElement('distance')->js()->val($ctl->distance);
	$f->js(null,$js)->execute();
}

$api->main();