<?php
class Controller_RoseTester extends AbstractController {
	function test(){
		echo "<pre>";

		for($x=0;$x<10;$x++){
			$n=rand(1,100000);
echo "here";

			$a=rand(1,10000);
			$b=rand(1,10000);
			$c=$a+1;
			$d=$b+1;

			echo "== $n $a, $b, $c, $d ==\n";

			$c=$this->add('Controller_Roses');
			$res = $c->solve($n,$a,$b,$c,$d);
			var_dump($res);

			var_Dump($c->distance);


		}

	}
}