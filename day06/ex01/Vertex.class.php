<?php
Class Vertex
{
	private $_x;
	private $_y;
	private $_z;
	private $_color;
	private $_w;
	public static $verbose = False;

	function __construct(array $kwargs)
	{
		$this->_x = $kwargs['x'];
		$this->_y = $kwargs['y'];
		$this->_z = $kwargs['z'];
		if (!array_key_exists('w', $kwargs))
			$this->_w = 1.0;
		else
			$this->_w = $kwargs['w'];
		if (!array_key_exists('color', $kwargs))
			$this->_color = new Color( array( 'red' =>   255, 'green' => 255, 'blue' =>   255 ) );
		else
			$this->_color = $kwargs['color'];
		if (Vertex::$verbose == True)
			printf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s ) constructed\n",$this->_x , $this->_y, $this->_z , $this->_w , $this->_color);
		return ;
	}
	function __destruct()
	{
		if (Vertex::$verbose == True)
			printf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s ) destructed\n",$this->_x , $this->_y, $this->_z , $this->_w, $this->_color);
		return ;
	}
	Public static function doc()
	{
		echo (file_get_contents('Vertex.doc.txt'));
	}
	function __tostring()
	{
		if (Vertex::$verbose == True)
			return (sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s )",$this->_x , $this->_y, $this->_z , $this->_w, $this->_color));
		return (sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f )",$this->_x , $this->_y, $this->_z , $this->_w));
	}
	public function getX()
	{
		return($this->_x);
	}
	public function getY()
	{
		return($this->_y);
	}
	public function getZ()
	{
		return($this->_z);
	}
	public function getW()
	{
		return($this->_w);
	}
	public function setX($x)
	{
		$this->_x = $x;
	}
	public function setY($y)
	{
		$this->_y = $y;
	}
	public function setZ($z)
	{
		$this->_z = $z;
	}
	public function setW($w)
	{
		$this->_w = $w;
	}
}
?>
