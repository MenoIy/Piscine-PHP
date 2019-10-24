<?php
Class Color
{
	public $red;
	public $green;
	public $blue;
	public static $verbose = False;

	function __construct(array $kwargs)
	{
		if (array_key_exists('rgb', $kwargs))
		{
			$rgb = $kwargs['rgb'];
			$this->red = ($rgb >> 16) & 255;
			$this->green = ($rgb >> 8) & 255;
			$this->blue = $rgb & 255;
		}
		else	
		{
			if (!array_key_exists('red', $kwargs))
				$this->red = 0;
			else
				$this->red = (int)$kwargs['red'];
			if (!array_key_exists('green', $kwargs))
				$this->green = 0;
			else 
				$this->green = (int)$kwargs['green'];
			if (!array_key_exists('blue', $kwargs))
				$this->blue = 0;
			else
				$this->blue = (int)$kwargs['blue'];
		}
		if (Color::$verbose == True)
			printf("Color( red: %3d, green: %3d, blue: %3d ) constructed.\n",$this->red, $this->green, $this->blue);
		return ;
	}

	function __destruct()
	{
		if (Color::$verbose == True)
			printf("Color( red: %3d, green: %3d, blue: %3d ) destructed.\n",$this->red, $this->green, $this->blue);
		return ;
	}
	
	public function __toString()
	{
		return (sprintf("Color( red: %3d, green: %3d, blue: %3d )",$this->red, $this->green, $this->blue));
	}
	public static function doc()
	{
		echo file_get_contents('Color.doc.txt');
	}
	function add(Color $obj)
	{
		return (new Color (array (
			'red' => (int)$this->red + (int)$obj->red,
			'green'=> (int)$this->green + (int)$obj->green,
			'blue' => (int)$this->blue + (int)$obj->blue
		)));
	}
	function sub(Color $obj)
	{
		return ( new Color (array (
			'red' => (int)$this->red - (int)$obj->red,
			'green'=> (int)$this->green - (int)$obj->green,
			'blue' => (int)$this->blue - (int)$obj->blue
		)));
	}
	function mult($m)
	{
		return (new Color (array (
			'red' => (int)$this->red * $m , 
			'green'=> (int)$this->green * $m , 
			'blue' => (int)$this->blue * $m)));
	}
}
?>
