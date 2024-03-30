<?php
// db.php

// Estendendo a classe wpdb para criar uma classe de banco de dados personalizada
class DB extends wpdb {
	protected static $instance = null;

	// Método para obter uma instância única da classe DB
	public static function getInstance() {
		// Se a instância ainda não existir, criamos uma nova
		if (!self::$instance) {
			// Passamos as credenciais de banco de dados para o construtor da classe wpdb
			self::$instance = new DB(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
		}

		// Retornamos a instância existente ou recém-criada
		return self::$instance;
	}
}

// Criando uma instância única da classe DB e atribuindo-a à variável global $wpdb
$wpdb = DB::getInstance();
