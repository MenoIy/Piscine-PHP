<?php

class UnholyFactory
{
	private $_absorbed = array();

	public function absorb($fighter)
	{
		if ($fighter instanceof Fighter)
		{
			if(!array_key_exists($fighter->id, $this->_absorbed))
			{
				$this->_absorbed[$fighter->id] = clone($fighter);
				print("(Factory absorbed a fighter of type ".$fighter->id.")". PHP_EOL);	
			}
			else
				print("(Factory already absorbed a fighter of type ".$fighter->id.")". PHP_EOL);	
		}
		else
			print("(Factory can't absorb this, it's not a fighter)". PHP_EOL);
	}

	public function fabricate($str_f)
	{
		if (array_key_exists($str_f , $this->_absorbed))
		{
			print ("(Factory fabricates a fighter of type ".$str_f.")". PHP_EOL);
			return (clone($this->_absorbed[$str_f]));
		}
		else
		{
			print("(Factory hasn't absorbed any fighter of type ".$str_f.")" . PHP_EOL);
			return (NULL);
		}
	}
}
?>
