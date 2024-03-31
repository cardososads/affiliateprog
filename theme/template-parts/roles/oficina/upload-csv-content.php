<form action="<?php echo esc_url(get_template_directory_uri() . '/template-parts/roles/administrator/csv-functions.php'); ?>" method="post" enctype="multipart/form-data">
	<input type="hidden" name="action" value="process_csv_upload">
	<input type="file" name="csv_file" accept=".csv">
	<input type="submit" value="Enviar CSV">
</form>

<!--esc_url( admin_url('admin-post.php') );-->
