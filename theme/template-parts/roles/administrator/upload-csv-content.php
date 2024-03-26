<?php

// Função para lidar com o upload do arquivo CSV
function handle_csv_upload() {
	if (isset($_FILES['csv_file'])) {
		$csv_file = $_FILES['csv_file'];

		// Verifica se o arquivo é um CSV
		if ($csv_file['type'] === 'text/csv') {
			$upload_dir = wp_upload_dir(); // Diretório de uploads do WordPress
			$file_path = $upload_dir['path'] . '/' . $csv_file['name'];

			// Move o arquivo para o diretório de uploads
			if (move_uploaded_file($csv_file['tmp_name'], $file_path)) {
				// Aqui você pode ler o arquivo CSV e importar os dados para uma variável
				$csv_data = array_map('str_getcsv', file($file_path));

				// Exemplo de manipulação dos dados CSV:
				foreach ($csv_data as $row) {
					// Aqui você pode fazer operações com cada linha do CSV
					// Por exemplo, imprimir cada linha
					echo implode(', ', $row) . '<br>';
				}

				// Também é possível retornar os dados para serem usados fora desta função
				return $csv_data;
			} else {
				echo 'Erro ao fazer upload do arquivo.';
			}
		} else {
			echo 'Por favor, envie um arquivo CSV válido.';
		}
	}
}

// Função para listar os arquivos CSV enviados
function list_uploaded_csv_files() {
	$upload_dir = wp_upload_dir(); // Diretório de uploads do WordPress
	$csv_files = scandir($upload_dir['path']); // Lista os arquivos no diretório de uploads

	// Exibe os arquivos CSV encontrados
	foreach ($csv_files as $file) {
		if (pathinfo($file, PATHINFO_EXTENSION) === 'csv') {
			echo '<a href="' . $upload_dir['url'] . '/' . $file . '">' . $file . '</a><br>';
		}
	}
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	handle_csv_upload();
}

?>

<form action="<?php echo esc_url(get_permalink()); ?>" method="post" enctype="multipart/form-data">
	<input type="file" name="csv_file" />
	<button type="submit">Enviar</button>
</form>

<!-- Exibe a lista de arquivos CSV enviados -->
<h2>Arquivos CSV enviados:</h2>
<ul>
	<?php
	list_uploaded_csv_files();
	?>
</ul>
