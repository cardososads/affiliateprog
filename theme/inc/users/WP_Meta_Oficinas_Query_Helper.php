<?php

class WP_Meta_Oficinas_Query_Helper {
	protected $wpdb;

	public function __construct() {
		global $wpdb;
		$this->wpdb = $wpdb;
	}

	public function get_meta_oficinas_table() {
		return $this->wpdb->prefix . 'meta_oficinas';
	}

	public function get_meta_oficina_by_cnpj($cnpj) {
		$meta_oficinas_table = $this->get_meta_oficinas_table();

		// Prepara a consulta para buscar os dados pelo CNPJ
		$query = $this->wpdb->prepare("
        SELECT *
        FROM $meta_oficinas_table
        WHERE cnpj = %s
    ", $cnpj);

		// Executa a consulta e retorna a primeira linha encontrada como um array associativo
		$result = $this->wpdb->get_row($query, ARRAY_A);

		return $result;
	}


}
