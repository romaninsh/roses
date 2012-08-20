<?php
class Controller_Roses extends AbstractController {
	public $depth=100;

	public $distance=null;

	public $n,$a,$b,$c,$d;



	/**
	 * Calculates total cost of buying $x batches form first and $y from second vendor
	 */
	function getCost($x,$y){
		echo "x=$x * ".$this->b." buys us ".($x*$this->a)." roses for ".($x*$this->b).
		" and y=$y * ".$this->d." buys us ".($y*$this->c)." roses for ".($y*$this->d).
		"\n";
		return $x*$this->b + $y*$this->d;
	}


	/**
	 * $n - Roses we need
	 * $a roses for $b euros
	 * $c roses for $d euros
	 */
	function solve($n,$a,$b,$c,$d){
		return min(
			$this->_solve($n,$a,$b,$c,$d),
			$this->_solve($n,$c,$d,$a,$b)
			);
	}

	function _solve($n,$a,$b,$c,$d){

		list($this->n, $this->a, $this->b, $this->c, $this->d)=
			array($n,$a,$b,$c,$d);


		// We start of by attempting to purchase zero roses from first vendor.
		// We then try several depths of buying more from first vendor to improve result
		$mincost=null;

		for($x=0;$x<$this->depth;$x++){

			// calculate $y
			$y = ceil(($n-$x*$this->a)/$this->c);
			$cost=$this->getCost($x,$y);

			echo "Cost: ".$cost."\n";
			if(is_null($mincost) || $cost<$mincost){

				if(!$this->distance)$this->distance=$x;
				// calculate the distance to result from extreme
				//else $this->distance=min($x,$this->distance);

				$mincost=$cost;

			}
		}

		return $mincost;

	}
}