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
			$this->setData($results[0]);
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

	// Carrega o usuario pelo login e senha
	public function login($login, $password) {
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND desdenha = :PASSWORD", array(
			":LOGIN"=>$login,
			":PASSWORD"=>$password
		));

		if (count($results) > 0) {
			$this->setData($results[0]);
		} else {
			throw new Exception("Login ou senha incorrretos");
		}
	}

	// Seta as propriedades da classe
	public function setData($data)
	{
		$this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDesdenha($data['desdenha']);
		$this->setDtcadastro($data['dtcadastro']);
	}

	// Metodo para inserir um usuario no banco
	public function insert ()
	{
		$sql = new Sql();
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDesdenha()
		));

		if (count($results) > 0) {
			$this->setData($results[0]);
		}
	}

	// Metodo construtor
	public function __construct ($login = "", $password = "") 
	{
		$this->setDeslogin($login);
		$this->setDesdenha($password);
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