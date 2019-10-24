<?php
Class Jaime extends Lannister
{
	public function cansleep($person)
	{
		if ($person instanceof Cersei)
			echo "With pleasure, but only in a tower in Winterfell, then.\n";
		else if ($person instanceof Lannister)
			echo "Not even if I'm drunk !\n";
		else
			echo "Let's do this.\n";
	}
}

?>
