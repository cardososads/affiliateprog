<?php
/*
 * Template Name: Registro de Oficina
 */
get_header();

// Verifica se o formulário foi submetido e os campos necessários estão definidos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['codigo_invite'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$cnpj = $_POST['cnpj'];
	$codigo_invite = $_POST['codigo_invite'];

	// Define o status do usuário como pendente
	$user_status = 'pendente';

	// Adicione o usuário com a função "Oficina"
	$user_id = wp_create_user($username, $password, $email);
	if (!is_wp_error($user_id)) {
		// Defina a função do usuário como "Oficina"
		$user = new WP_User($user_id);
		$user->set_role('oficina');

		// Adicione o CNPJ como metadados do usuário
		update_user_meta($user_id, 'cnpj', $cnpj);

		// Adicione o código_invite como metadados do usuário
		update_user_meta($user_id, 'codigo_invite', $codigo_invite);

		// Defina o status do usuário como pendente
		update_user_meta($user_id, 'user_status', $user_status);

		// Exibir mensagem de sucesso
		echo '<p class="text-green-600">Parceiro adicionado com sucesso!</p>';
	} else {
		// Exiba uma mensagem de erro se houver algum problema ao criar o usuário
		echo '<p class="text-red-600">Ocorreu um erro ao adicionar o usuário.</p>';
	}
}
?>

<section class="h-screen">
	<div class="grid grid-cols-2">
		<div class="bg-gray-100 flex flex-col items-center justify-center">
			<div class="max-w-md mx-auto p-8 bg-white rounded-lg shadow-lg">
				<h2 class="text-2xl font-bold mb-4">Adicionar Novo Parceiro</h2>
				<form id="add-user-form" method="post" class="space-y-4">
					<div>
						<label for="username" class="block font-semibold">Nome de usuário:</label>
						<input type="text" id="username" name="username" class="w-full border rounded px-3 py-2" required>
					</div>
					<div>
						<label for="email" class="block font-semibold">E-mail:</label>
						<input type="email" id="email" name="email" class="w-full border rounded px-3 py-2" required>
					</div>
					<div>
						<label for="password" class="block font-semibold">Senha:</label>
						<input type="password" id="password" name="password" class="w-full border rounded px-3 py-2" required>
					</div>
					<div>
						<label for="cnpj" class="block font-semibold">CNPJ:</label>
						<input type="text" id="cnpj" name="cnpj" class="w-full border rounded px-3 py-2" required>
					</div>
					<div>
						<input type="hidden" id="codigo_invite" name="codigo_invite" class="w-full border rounded px-3 py-2" value="<?= $codigo_invite ?>" required>
					</div>
					<button type="submit" class="bg-green-600 hover:bg-green-800 text-white px-4 py-2 rounded hover:bg-blue-600">Adicionar Parceiro</button>
				</form>
				<?php
				if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['codigo_invite'])) {
					if (!is_wp_error($user_id)) {
						echo '<p class="text-green-600">Parceiro adicionado com sucesso!</p>';
					}
				}
				?>
			</div>
		</div>

		<div class="hidden md:block">
			<img src="<?= get_template_directory_uri() . '/img/login-bg-image.svg' ?>" alt="">
		</div>
	</div>
</section>

<?php
get_footer();
?>
