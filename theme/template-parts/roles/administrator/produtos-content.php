<section>
	<!-- Formulário de Upload de Arquivo CSV -->
	<form id="csv-upload-form" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="action" value="process_csv_upload">
		<input type="file" name="csv_file" accept=".csv">
		<input type="submit" value="Enviar">
	</form>
</section>
