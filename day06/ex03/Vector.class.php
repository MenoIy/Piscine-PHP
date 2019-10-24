<?php
require_once 'Color.class.php';
class Vector
{
	private $_x;
	private $_y;
	private $_z;
	private $_w;
	public static $verbose = False;

	function __construct(array $args)
	{
		$dest = $args['dest'];
		if (!array_key_exists('orig', $args))			
			$orig = new Vertex(array ('x' => 0 , 'y' => 0 , 'z' => 0, 'w' => 1));
		else
			$orig = $args['orig'];
		$this->_x = $dest->getX() - $orig->getX();
		$this->_y = $dest->getY() - $orig->getY();
		$this->_z = $dest->getZ() - $orig->getZ();
		$this->_w = 0;
		if (Vector::$verbose == True)
			printf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f ) constructed\n", $this->_x , $this->_y, $this->_z, $this->_w);
	}

	function __destruct()
	{
		if (Vector::$verbose == True)
			printf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f ) destructed\n", $this->_x , $this->_y, $this->_z, $this->_w);
	}

	function __toString()
	{
		return (sprintf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f )", $this->_x , $this->_y, $this->_z, $this->_w));
	}

	public static function doc()
	{
		echo (file_get_contents('Vector.doc.txt'));
	}

	public function magnitude()
	{
		return (sqrt(pow($this->_x, 2) + pow($this->_y, 2) + pow($this->_z , 2))); 
	}

	public function normalize()
	{
		$t = $this->magnitude();
		$dest = new Vertex(array('x' => $this->_x / $t ,
								 'y' => $this->_y / $t ,
								 'z' =>  $this->_z / $t ,
								 'w' => $this->_w / $t
							 ));
		return(new Vector(array('dest' => $dest)));
	}

	public function add(Vector $V)
	{
		$dest = new Vertex(array('x' => $this->_x + $V->_x,
								 'y' => $this->_y + $V->_y ,
								 'z' => $this->_z + $V->_z , 
								 'w' => $this->_w + $V->_w
							 ));
		return(new Vector(array('dest' => $dest)));
	}

	public function sub(Vector $V)
	{
		$dest = new Vertex(array('x' => $this->_x - $V->_x ,
	  				 			 'y' => $this->_y - $V->_y ,
						 	 	 'z' => $this->_z - $V->_z ,
								 'w' => $this->_w - $V->_w));
		return(new Vector(array('dest' => $dest)));
	}

	public function opposite()
	{	
		return ($this->scalarProduct(-1));
	}

	public function scalarProduct($k)
	{
		$dest = new Vertex(array('x' => $this->_x * $k ,
								 'y' => $this->_y * $k,
								 'z' => $this->_z * $k ,
								 'w' => $this->_w * $k));
		return(new Vector(array('dest' => $dest)));
	}

	public function dotProduct(Vector $V)
	{
		return($V->_x * $this->_x + $V->_y * $this->_y + $V->_z * $this->_z + $V->_w * $this->_w);
	}

	public function cos(Vector $V)
	{
		return ($this->dotProduct($V) / ($V->magnitude() * $this->magnitude()));
	}

	public function  crossProduct(Vector $V)
	{
		$dest = new Vertex(array(
			'x' => $this->_y * $V->_z - $this->_z * $V->_y,
			'y' => - ($this->_x * $V->_z - $this->_z * $V->_x) ,
			'z' =>  $this->_x * $V->_y - $this->_y * $V->_x
		));
		return (new Vector(array('dest' => $dest)));
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
}

?>
