<?php

	require_once("config.php");

	//$sql = new Sql();

	//$usuarios = $sql->select("SELECT * FROM tb_usuarios");	
	//echo json_encode($usuarios);	

	//Carrega apenas um usuário.
	//$root = new Usuario();
	//$root->loadById(6);
	

	//Carrega uma Lista de usuários.	
	//$lista = Usuario::getList();	
	//echo json_encode($lista);

	//Carrega uma lista de usuários buscando pelo login.
	//$search = Usuario::search("fe");
	//echo json_encode($search);

	//Carregando um usuário usando login e senha.
	$usuario = new Usuario();
	$usuario->login("Felipe", "felipe@felipe");
	
	echo ($usuario);

?>