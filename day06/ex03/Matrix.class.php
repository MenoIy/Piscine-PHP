<?php
Class Matrix
{
	const IDENTITY = 'IDENTITY';
	const SCALE = 'SCALE';
	const RX = 'Ox ROTATION';
	const RY = 'Oy ROTATION';
	const RZ = 'Oz ROTATION';
	const TRANSLATION = 'TRANSLATION';
	const PROJECTION = 'PROJECTION';
	private $_preset;
	private $_scale;
	private $_angle;
	private $_vtc;
	private $_fov;
	private $_ratio;
	private $_near;
	private $_far;
	private $_matrix;
	static public $verbose = False;

	function __construct(array $argv)
	{
		$this->_matrix = $this->new_matrix();
		$this->_preset = $argv['preset'];
		$this->_scale = $argv['scale'];
		$this->_angle = $argv['angle'];
		$this->_vtc = $argv['vtc'];
		$this->_ratio = $argv['ratio'];
		$this->_near = $argv['near'];
		$this->_far = $argv['far'];
		$this->_fov = $argv['fov'];
		$this->error();
		$this->type_matrix();	
		if (Matrix::$verbose  == True)
		{
			if ($this->_preset != 'IDENTITY')
				echo "Matrix ". $this->_preset." preset instance constructed\n";
			else
				echo "Matrix ". $this->_preset  ." instance constructed\n";
		}
	}
	function __destruct()
	{
		if (Matrix::$verbose  == True)
			echo "Matrix instance destructed\n";
	}
	function __toString()
	{
		return (sprintf("M | vtcX | vtcY | vtcZ | vtxO\n-----------------------------\nx | %.2f | %.2f | %.2f | %.2f\ny | %.2f | %.2f | %.2f | %.2f\nz | %.2f | %.2f | %.2f | %.2f\nw | %.2f | %.2f | %.2f | %.2f",$this->_matrix[0], $this->_matrix[1],  $this->_matrix[2], $this->_matrix[3], $this->_matrix[4], $this->_matrix[5],  $this->_matrix[6], $this->_matrix[7], $this->_matrix[8], $this->_matrix[9], $this->_matrix[10], $this->_matrix[11], $this->_matrix[12], $this->_matrix[13], $this->_matrix[14], $this->_matrix[15]));
	}
	private function new_matrix()
	{
		$this->_matrix = array();
		for($i = 0; $i<16 ; $i++)
			$this->_matrix[$i] = 0;
	}
	public static function doc()
	{
		echo (file_get_contents('Matrix.doc.txt'));
	}

	public function mult(Matrix $M)
	{
	
		$tmp = array();
		for ($i = 0; $i < 16; $i += 4) {
			for ($j = 0; $j < 4; $j++) {
				$tmp[$i + $j] = 0;
				$tmp[$i + $j] += $this->_matrix[$i + 0] * $M->_matrix[$j + 0];
				$tmp[$i + $j] += $this->_matrix[$i + 1] * $M->_matrix[$j + 4];
				$tmp[$i + $j] += $this->_matrix[$i + 2] * $M->_matrix[$j + 8];
				$tmp[$i + $j] += $this->_matrix[$i + 3] * $M->_matrix[$j + 12];
			}
		}
		$matrice = clone($this);
		$matrice->_matrix = $tmp;
		return $matrice;
	}
	public function transformVertex(Vertex $V)
	{
		$x = $V->getX();
		$y = $V->getY();
		$z = $V->getZ();
		$w = $V->getW();
		$vx = $this->_matrix[0] * $x +  $this->_matrix[1] * $y + $this->_matrix[2] * $z + $this->_matrix[3] * $w; 
		$vy = $this->_matrix[4] * $x +  $this->_matrix[5] * $y + $this->_matrix[6] * $z + $this->_matrix[7] * $w; 
		$vz = $this->_matrix[8] * $x +  $this->_matrix[9] * $y + $this->_matrix[10] * $z + $this->_matrix[11] * $w; 
		$vw = $this->_matrix[12] * $x +  $this->_matrix[13] * $y + $this->_matrix[14] * $z + $this->_matrix[15] * $w; 
		$dest = new Vertex(array('x' => $vx , 'y' => $vy ,'z' => $vz , 'w' => $vw));
		return($dest);

		return $Vertex;
	}
	private function error()
	{
		if (!isset($this->_scale) && $this->_preset == 'SCALE')
			exit("error");
		if (!isset($this->_vtc) && $this->_preset == 'TRANSLATION')
			exit("error");
		if (!isset($this->_angle) && ($this->_preset == 'RX' || $this->_preset == 'RY' || $this->_preset == 'RZ'))
			exit("error");
		if ((!isset($this->_fov) ||  !isset($this->_ratio) || !isset($this->_near) || !isset($this->_far))&& $this->_preset == 'PROJECTION')
			exit("error");
	}

	private function type_matrix()
	{
		if ($this->_preset == self::IDENTITY)
			$this->identity(1);
		if ($this->_preset == self::SCALE)
			$this->scalee($this->_scale);
		if ($this->_preset == self::RX)
			$this->rx($this->_angle);
		if ($this->_preset == self::RY)
			$this->ry($this->_angle);
		if ($this->_preset == self::RZ)
			$this->rz($this->_angle);
		if ($this->_preset == self::TRANSLATION)
			$this->translation($this->_vtc);
		if ($this->_preset == self::PROJECTION)
			$this->projection($this->_fov, $this->_ratio, $this->_near, $this->_far);
	}
	private function identity($o)
	{
		$this->_preset = 'IDENTITY';
		$this->_matrix[0] = $o;
		$this->_matrix[5] = $o;
		$this->_matrix[10] = $o;
		$this->_matrix[15] = $o;
	}
	private function scalee($s)
	{
		$this->identity(1);
		$this->_preset = 'SCALE';
		$this->_matrix[0] *= $s;
		$this->_matrix[5] *= $s;
		$this->_matrix[10] *= $s;
		$this->_matrix[15] = 1;

	}
	private function translation(Vector $V)
	{
		$this->identity(1);
		$this->_preset = 'TRANSLATION';
		$this->_matrix[3] = $V->getX();
		$this->_matrix[7] = $V->getY();
		$this->_matrix[11] = $V->getZ();

	}

	private function rx($a)
	{
		$this->identity(1);
		$this->_preset = 'Ox ROTATION';
		$this->_matrix[5] = cos($a);
		$this->_matrix[6] = -sin($a);
		$this->_matrix[9] = sin($a);
		$this->_matrix[10] = cos($a);
	}
	private function ry($a)
	{
		$this->identity(1);
		$this->_preset = 'Oy ROTATION';
		$this->_matrix[0] = cos($a);
		$this->_matrix[2] = sin($a);
		$this->_matrix[8] = -sin($a);
		$this->_matrix[10] = cos($a);

	}
	private function rz($a)
	{
		$this->identity(1);
		$this->_preset = 'Oz ROTATION';
		$this->_matrix[0] = cos($a);
		$this->_matrix[1] = -sin($a);
		$this->_matrix[4] = sin($a);
		$this->_matrix[5] = cos($a);
	}
	private function projection($f , $r , $n , $a)
	{
		$this->identity(0);
		$this->_preset = 'PROJECTION';
		$top = $n * tan(deg2rad($f)/2);
		$bot = -$top;
		$right = $top * $r;
		$left = -$right;
		$this->_matrix[0] = 2*$n/($right - $left);
		$this->_matrix[3] = -$n * ($right + $left) / ($right - $left);
		$this->_matrix[5] = 2 * $n / ($top - $bot);
		$this->_matrix[7] = -$n * ($top + $bot) / ($top - $bot);
		$this->_matrix[10] = -($a + $n) / ($a - $n);
		$this->_matrix[11] =  2 * $a * $n/($n - $a);
		$this->_matrix[14] = -1;
	}
}
?>
