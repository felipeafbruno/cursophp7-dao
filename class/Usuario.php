<?php

	class Usuario {

		private $id_usuario;
		private $des_login;
		private $des_senha;
		private $dt_cadastro;

		public function __construct($login = "", $senha = "") {

			$this->setDesLogin($login);
			$this->setDesSenha($senha);

		}

		public function getIdUsuario() {
			return $this->id_usuario;
		}

		public function setIdUsuario($value) {
			$this->id_usuario = $value;
		}		

		public function getDesLogin() {
			return $this->des_login;
		}

		public function setDesLogin($value) {
			$this->des_login = $value;
		}		

		public function getDesSenha() {
			return $this->des_senha;
		}

		public function setDesSenha($value) {
			$this->des_senha = $value;
		}

		public function getDtCadastro() {
			return $this->dt_cadastro;
		}

		public function setDtCadastro($value) {
			$this->dt_cadastro = $value;
		}

		public function loadById($id) {

			$sql = new Sql();

			 $results = $sql->select("SELECT * FROM tb_usuarios WHERE id_usuario = :ID", 
			 	array(":ID" => $id));
			 
			 if(count($results) > 0) {

			 	$this->setData($results[0]);
			 }
		}

		public static function getList() {

			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios ORDER BY des_login");
		}

		public static function search($login) {

			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios WHERE des_login LIKE :LOGIN ORDER BY des_login", 
				array(
					":LOGIN" => "%" . $login . "%"
				));
		}

		public function login($login, $password) {

			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_usuarios WHERE des_login LIKE :LOGIN and des_senha = :PASSWORD", array(
					":LOGIN" => $login,
					":PASSWORD" => $password 
				));

			if(count($results) > 0) {

				$this->setData($results[0]);

			} else {

				throw new Exception("Login e/ou senha inválidos.");

			}
		}

		public function insert() {

			$sql = new Sql();

			$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
				":LOGIN" => $this->getDesLogin(),
				":PASSWORD" => $this->getDesSenha()
			));

			if(count($results) > 0) {

				$this->setData($results[0]);				

			}

		}

		public function setData($data) {

			$this->setIdUsuario($data["id_usuario"]);
			$this->setDesLogin($data["des_login"]);
			$this->setDesSenha($data["des_senha"]);
			$this->setDtCadastro(new DateTime($data["dt_cadastro"]));

		}

		public function __toString() {

			return json_encode(array(
				"id_usuario" => $this->getIdUsuario(),
				"des_login" => $this->getDesLogin(),
				"des_senha" => $this->getDesSenha(),
				"dt_cadastro" => $this->getDtCadastro()->format("d-m-Y H:i:s")
			));

		}

	}

?>