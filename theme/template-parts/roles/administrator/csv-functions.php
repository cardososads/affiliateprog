<?php
// Verifica se a ação é definida e se é a ação esperada
if (isset($_POST['action']) && $_POST['action'] === 'process_csv_upload') {
	// Verifica se um arquivo CSV foi enviado
	if (!empty($_FILES['csv_file']['tmp_name'])) {
		$csv_file = $_FILES['csv_file']['tmp_name'];

		// Processa o arquivo CSV
		if (($handle = fopen($csv_file, 'r')) !== false) {
			$data = array();
			$first_line_skipped = false;

			// Lê o CSV linha por linha e armazena os dados em um array associativo
			while (($row = fgetcsv($handle, 1000, ',')) !== false) {
				// Ignora a primeira linha (títulos das colunas)
				if (!$first_line_skipped) {
					$first_line_skipped = true;
					continue;
				}

				$user_data = array(
					'CNPJ' => $row[0],
					'META FILTROS' => $row[1],
					'ATINGIDO % FILTROS' => $row[2],
					'META FILTRO DE OLÉO' => $row[3],
					'ATINGIDO % FILTRO DE ÓLEO' => $row[4],
					'META FILTRO DE CABINE' => $row[5],
					'ATINGIDO % FILTRO DE CABINE' => $row[6],
					'META FILTRO DE COMBUSTÍVEL' => $row[7],
					'ATINGIDO % FILTRO DE COMBUSTÍVEL' => $row[8],
					'META FILTRO DE AR' => $row[9],
					'ATINGIDO % FILTRO DE AR' => $row[10]
				);

				// Adiciona os dados ao array principal
				$data[] = $user_data;
			}

			fclose($handle);

			// Exibe os arrays tratados
			echo '<pre>';
			print_r($data);
			echo '</pre>';
		} else {
			echo "Erro ao abrir o arquivo CSV.";
		}
	} else {
		echo "Nenhum arquivo CSV foi enviado.";
	}
} else {
	echo "Ação inválida.";
}
?>
