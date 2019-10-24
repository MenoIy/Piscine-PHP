<?php
Class NightsWatch 
{
	private $fighters = array();
	public function recruit($person)
	{
		$this->fighters[] = $person;
	}
	public function fight()
	{
		foreach($this->fighters as $fighter)
		{
			if ($fighter instanceof IFighter)
				$fighter->fight();
		}
	}
}

?>
