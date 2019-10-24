<?php
abstract Class Lannister
{
	public function sleepWith($person)
	{
		if ($this instanceof self)
			$this->cansleep($person);
	}
}
?>
