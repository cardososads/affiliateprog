<?php
//// Importa o WordPress
//preg_match('/^(.+)wp-content\/.*/', dirname(__FILE__), $path);
//include($path[1] . 'wp-load.php');
//
//// Função para inserir dados do CSV na tabela do banco de dados
//function insert_csv_data_into_database($data) {
//	global $wpdb;
//	$table_name = $wpdb->prefix . 'historico_metas';
//
//	foreach ($data as $row_data) {
//		$data_registro = current_time('mysql');
//		unset($row_data['data_registro']);
//
//		foreach ($row_data as $key => $value) {
//			if (strpos($value, '%') !== false) {
//				$row_data[$key] = str_replace('%', '', $value);
//			}
//		}
//
//		$row_data['data_registro'] = $data_registro;
//
//		$wpdb->insert(
//			$table_name,
//			$row_data
//		);
//	}
//}
//
//// Função para obter as colunas da tabela
//function get_table_columns($table_name) {
//	global $wpdb;
//	$columns = $wpdb->get_results("DESCRIBE $table_name");
//	return $columns;
//}
//
//function table_exists($table_name) {
//	global $wpdb;
//	$sql = "SHOW TABLES LIKE '$table_name'";
//	$result = $wpdb->get_var($sql);
//	return $result === $table_name;
//}
//
//if (isset($_POST['action']) && $_POST['action'] === 'process_csv_upload') {
//	if (!empty($_FILES['csv_file']['tmp_name']) && file_exists($_FILES['csv_file']['tmp_name'])) {
//		$table_name = $wpdb->prefix . 'historico_metas';
//		if (!table_exists($table_name)) {
//			echo "A tabela $table_name não existe no banco de dados.";
//			exit;
//		}
//
//		$columns = get_table_columns($table_name);
//
//		$csv_file = $_FILES['csv_file']['tmp_name'];
//
//		// Processa o arquivo CSV
//		if (($handle = fopen($csv_file, 'r')) !== false) {
//			$data = array();
//			$first_line_skipped = false;
//
//			function remove_non_numeric_characters($string) {
//				// Remove todos os caracteres não numéricos, exceto "." e ","
//				$clean_value = preg_replace('/[^0-9.,]/', '', $string);
//
//				// Substitui vírgulas por pontos para o separador decimal
//				$clean_value = str_replace(',', '.', $clean_value);
//
//				// Substitui pontos por nada para remover separadores de milhares
//				$clean_value = str_replace('.', '', $clean_value);
//
//				return $clean_value;
//			}
//
//			// Lê o CSV linha por linha e armazena os dados em um array associativo
//			while (($row = fgetcsv($handle, 1000, ',')) !== false) {
//				// Ignora a primeira linha (títulos das colunas)
//				if (!$first_line_skipped) {
//					$first_line_skipped = true;
//					continue;
//				}
//
//				$user_data = array(
//					'cnpj' => $row[0],
//					'meta_filtro' => $row[1],
//					'atingido_filtro' => $row[2],
//					'meta_oleo' => $row[3],
//					'atingido_oleo' => $row[4],
//					'meta_cabine' => $row[5],
//					'atingido_cabine' => $row[6],
//					'meta_combustivel' => $row[7],
//					'atingido_combustivel' => $row[8],
//					'meta_ar' => $row[9],
//					'atingido_ar' => $row[10]
//				);
//
//				// Adiciona os dados ao array principal
//				$data[] = remove_non_numeric_characters($user_data);
//			}
//
//			fclose($handle);
//
//			// Salva os dados na tabela do banco de dados
//			insert_csv_data_into_database($data);
//
//			// Exibe os dados recuperados da tabela
//			$result = $wpdb->get_results("SELECT * FROM $table_name");
//			$total_rows = count($result);
//			echo "<p>Dados enviados com sucessoo!";
//			echo '<a href="javascript:history.back()" class="button">Voltar</a>';
//
//		} else {
//			echo "Erro ao abrir o arquivo CSV.";
//			echo '<a href="javascript:history.back()" class="button">Voltar</a>';
//
//		}
//	} else {
//		echo "Nenhum arquivo CSV foi enviado ou o arquivo não existe.";
//		echo '<a href="javascript:history.back()" class="button">Voltar</a>';
//
//	}
//} else {
//	echo "Ação inválida.";
//	echo '<a href="javascript:history.back()" class="button">Voltar</a>';
//}

