# **************************************************************************** #
#                                                                              #
#                                                         :::      ::::::::    #
#    Camera.class.php                                   :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: kdaou <marvin@42.fr>                       +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2019/10/24 15:55:34 by kdaou             #+#    #+#              #
#    Updated: 2019/10/24 15:55:40 by kdaou            ###   ########.fr        #
#                                                                              #
# **************************************************************************** #

<?php
Class Camera
{
	private $_origin;
	private $_orien;
	private $_width;
	private $_height;
	private $_ratio;
	private $_fov;
	private $_near;
	private $_far;
	private $_opv;
	private $_opc;
	private $_cam;
	public static $verbose;
	private $_rm;
	private $_mult;
	private $_final;
	private $_need = 0;

	public function __construct(array $argv)
	{
		$this->_origin = $argv['origin'];
		$this->_orien = $argv['orientation'];
		$this->_width = $argv['width'];
		$this->_height = $argv['height'];
		if (array_key_exists('ratio', $argv))
			$this->_ratio = $argv['ratio'];
		else
			$this->_ratio = $this->_width / $this->_height;
		$this->_fov = $argv['fov'];
		$this->_near = $argv['near'];
		$this->_far = $argv['far'];
		$this->_opv = new Vector (array('dest' => $this->_origin));
		$this->_opvt = $this->_opv->opposite();
		$this->_cam = new Matrix(array( 'preset' => "TRANSLATION" , 'vtc' => $this->_opvt ));
		$this->_rm = $this->_trans($this->_orien);
		$this->_mult = $this->_rm->mult($this->_cam);
		$this->_final = clone($this->_mult);

		$this->_final->projection( $this->_fov, $this->_ratio ,$this->_near ,$this->_far);

		if (Camera::$verbose = True)
			echo "Camera instance constructed\n";					
	}
	public function __destruct()
	{
		if (Camera::$verbose = True)
			echo "Camera instance destructed\n";	
	}
	
	public static function doc()
	{
		echo (file_get_contents('Camera.doc.txt'));
	}

	public function __toString()
	{
		return (sprintf("Camera( \n+ Origine: %s\n+ tT:\n%s\n+ tR:\n%s\n+ tR->mult( tT ):\n%s\n+ Proj:\n%s\n)", $this->_origin, $this->_cam, $this->_rm, $this->_mult, $this->_final));
	}
	private function _trans(Matrix $m)
	{
		$tmp = array();
		$mat = $m->getm();
		$tmp[0] = $mat[0];
		$tmp[1] = $mat[4];
		$tmp[2] = $mat[8];
		$tmp[3] = $mat[12];
		$tmp[4] = $mat[1];
		$tmp[5] = $mat[5];
		$tmp[6] = $mat[9];
		$tmp[7] = $mat[13];
		$tmp[8] = $mat[2];
		$tmp[9] = $mat[6];
		$tmp[10] = $mat[10];
		$tmp[11] = $mat[14];
		$tmp[12] = $mat[3];
		$tmp[13] = $mat[7];
		$tmp[14] = $mat[11];
		$tmp[15] = $mat[15];
		$m->setm($tmp);
		return ($m);
	}
	public function watchVertex(Vertex $worldVertex)
	{
		$vert = $this->_final->transformVertex($worldVertex);
		$vert->setX($vert->getX() * $this->_ratio);
		$vert->setY($vert->getY() * $this->_ratio);
		$vert->setColorr($worldVertex->getColor());
		return($vert);
	}
}
?>
