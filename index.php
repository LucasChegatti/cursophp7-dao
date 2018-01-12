<?php

require_once("config.php");

// Carrega um usuario
// $usuario = new Usuario();
// $usuario->loadById(1);
// echo $usuario;

// Carrega uma lista de usuarios
// $lista = Usuario::getList();
// echo var_dump($lista);

// Carrega uma lista de usuarios buscandopelo login
// $search = Usuario::search("o");
// echo var_dump($search);

// Carrega usuario por login e senha
// $usuario = new Usuario();
// $usuario->login("root", "123456");
// echo var_dump($usuario);

// Insere usuario
// $aluno = new Usuario("teste", "teste");
// $aluno->insert();
// echo $aluno;

// Update usuario
$usuario = new Usuario();
$usuario->loadById(8);
$usuario->update("update", "update");
echo $usuario;

?>
