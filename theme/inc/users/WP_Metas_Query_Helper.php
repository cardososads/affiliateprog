<?php

class WP_Metas_Query_Helper {
	protected $wpdb;

	public function __construct() {
		global $wpdb;
		$this->wpdb = $wpdb;
	}

	public function get_metas_table() {
		return $this->wpdb->prefix . 'metas';
	}

	public function get_all_metas_data() {
		$metas_table = $this->get_metas_table();

		$results = $this->wpdb->get_results("SELECT * FROM $metas_table");

		return $results;
	}

	public function get_column_values($column_name) {
		$metas_table = $this->get_metas_table();

		$results = $this->wpdb->get_col("SELECT $column_name FROM $metas_table");

		return $results;
	}

	public function sum_column_values($column_name) {
		$metas_table = $this->get_metas_table();

		$sum = $this->wpdb->get_var("SELECT SUM($column_name) FROM $metas_table");

		return $sum;
	}

	public function calculate_percentage($column1, $column2) {
		$metas_table = $this->get_metas_table();

		$total_column1 = $this->wpdb->get_var("SELECT SUM($column1) FROM $metas_table");
		$total_column2 = $this->wpdb->get_var("SELECT SUM($column2) FROM $metas_table");

		// Verifica se o denominador é zero para evitar divisão por zero
		if ($total_column1 == 0) {
			return 0; // Se o total da primeira coluna for zero, a porcentagem também é zero
		}

		// Calcula a porcentagem
		$percentage = ($total_column2 / $total_column1) * 100;

		return $percentage;
	}

	public function get_monthly_data($column1, $column2) {
		$metas_table = $this->get_metas_table();

		$monthly_data = array();

		// Loop through each month of the year
		for ($month = 1; $month <= 12; $month++) {
			// Get the first and last day of the month
			$start_date = date('Y-m-01', mktime(0, 0, 0, $month, 1, date('Y')));
			$end_date = date('Y-m-t', mktime(0, 0, 0, $month, 1, date('Y')));

			// Query to get the values of specified columns for this month
			$result = $this->wpdb->get_row($this->wpdb->prepare("
            SELECT $column1 as value_column1, $column2 as value_column2
            FROM $metas_table
            WHERE data_registro >= %s AND data_registro <= %s
        ", $start_date, $end_date), ARRAY_A);

			// Add the values to the monthly array
			$monthly_data[date('F', mktime(0, 0, 0, $month, 1, date('Y')))] = array(
				'column1' => $result['value_column1'],
				'column2' => $result['value_column2']
			);
		}

		return $monthly_data;
	}

	public function get_monthly_column_totals_with_percentage($column1, $column2) {
		$metas_table = $this->get_metas_table();

		$monthly_totals = array();

		// Loop through each month of the year
		for ($month = 1; $month <= 12; $month++) {
			// Get the first and last day of the month
			$start_date = date('Y-m-01', mktime(0, 0, 0, $month, 1, date('Y')));
			$end_date = date('Y-m-t', mktime(0, 0, 0, $month, 1, date('Y')));

			// Query to get the sum of specified columns for this month
			$results = $this->wpdb->get_results($this->wpdb->prepare("
            SELECT SUM($column1) as total_column1, (SUM($column2) / SUM($column1)) * 100 as total_column2_percentage
            FROM $metas_table
            WHERE data_registro >= %s AND data_registro <= %s
        ", $start_date, $end_date), ARRAY_A);

			// Add the summed values to the monthly array
			$monthly_totals[date('F', mktime(0, 0, 0, $month, 1, date('Y')))] = array(
				'total_column1' => $results[0]['total_column1'],
				'total_column2' => $results[0]['total_column2_percentage']
			);
		}

		return $monthly_totals;
	}

	public function get_metas_by_cnpj($cnpj) {
		$metas_table = $this->get_metas_table();

		// Obtém o primeiro e o último dia do mês corrente
		$start_of_month = date('Y-m-01');
		$end_of_month = date('Y-m-t');

		// Prepara a consulta para buscar os dados pelo CNPJ e do mês corrente
		$query = $this->wpdb->prepare("
        SELECT *
        FROM $metas_table
        WHERE cnpj = %s
        AND MONTH(data_registro) = MONTH(CURDATE()) AND YEAR(data_registro) = YEAR(CURDATE())
    ", $cnpj);

		// Executa a consulta e retorna os resultados
		$results = $this->wpdb->get_results($query);

		return $results;
	}

	public function get_metas_by_cnpj_all_months($cnpj) {
		$metas_table = $this->get_metas_table();

		// Prepara a consulta para buscar os dados pelo CNPJ
		$query = $this->wpdb->prepare("
        SELECT *, MONTH(data_registro) as mes
        FROM $metas_table
        WHERE cnpj = %s
    ", $cnpj);

		// Executa a consulta e retorna os resultados
		$results = $this->wpdb->get_results($query);

		// Inicializa um array para armazenar os resultados agrupados por mês
		$results_grouped_by_month = array();

		// Obtém os nomes dos meses em português
		$meses = array(
			1 => 'Janeiro',
			2 => 'Fevereiro',
			3 => 'Março',
			4 => 'Abril',
			5 => 'Maio',
			6 => 'Junho',
			7 => 'Julho',
			8 => 'Agosto',
			9 => 'Setembro',
			10 => 'Outubro',
			11 => 'Novembro',
			12 => 'Dezembro'
		);

		// Inicializa o array com os nomes dos meses como chaves e arrays vazios como valores
		foreach ($meses as $numero_mes => $nome_mes) {
			$results_grouped_by_month[$nome_mes] = array();
		}

		// Agrupa os resultados por mês
		foreach ($results as $result) {
			$month = $result->mes;
			$nome_mes = $meses[$month];
			// Adiciona o resultado diretamente ao array do mês correspondente
			$results_grouped_by_month[$nome_mes] = (array) $result;
		}

		return $results_grouped_by_month;
	}


}
