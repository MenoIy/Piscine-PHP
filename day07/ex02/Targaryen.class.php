<?php

Class Targaryen
{
	public function getBurned()
	{
		if (static::resistsFire())
			return ("emerges naked but unharmed");
		return ("burns alive");
	}
	protected function resistsFire()
	{
		return (FALSE);
	}	
}
?>
