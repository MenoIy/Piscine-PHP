<?php

abstract class Fighter
{
	public $id;
	abstract public function fight($target);

	public function __construct($fighter)
	{
		$this->id = $fighter;
	}

}

?>
