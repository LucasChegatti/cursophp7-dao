<?php

class Usuario 
{
	private $idusuario;
	private $deslogin;
	private $desdenha;
	private $dtcadastro;

	public function getIdusuario()
	{
		return $this->idusuario;
	}

	public function setIdusuario($value)
	{
		$this->idusuario = $value;
	}

	public function getDeslogin()
	{
		return $this->deslogin;
	}

	public function setDeslogin($value)
	{
		$this->deslogin = $value;
	}

	public function getDesdenha()
	{
		return $this->desdenha;
	}

	public function setDesdenha($value)
	{
		$this->desdenha = $value;
	}

	public function getDtcadastro()
	{
		return $this->dtcadastro;
	}

	public function setDtcadastro($value)
	{
		$this->dtcadastro = $value;
	}

	// Carrega dados do usuario pelo ID
	public function loadById($id)
	{
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID"=>$id
		));

		if (count($results) > 0) {
			$row = $results[0];
			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDesdenha($row['desdenha']);
			$this->setDtcadastro($row['dtcadastro']);
		}
	}

	// Carrega lista de usuarios
	public static function getList() 
	{
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
	}

	// Carrega usuario pelo nome
	public static function search($login) 
	{
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			':SEARCH'=>"%".$login."%"
		));
	}

	public function login($login, $password) {
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND desdenha = :PASSWORD", array(
			":LOGIN"=>$login,
			":PASSWORD"=>$password
		));

		if (count($results) > 0) {
			$row = $results[0];
			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDesdenha($row['desdenha']);
			$this->setDtcadastro($row['dtcadastro']);
		} else {
			throw new Exception("Login ou senha incorrretos");
		}
	}

	public function __toString ()
	{
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"desdenha"=>$this->getDesdenha(),
			"dtcadastro"=>$this->getDtcadastro()
		));
	}


}

?>