<?php
// Verificar se o usuário atual é um administrador
if (current_user_can('administrator')) {
	if (isset($_POST['submit'])) {
		// Processar o formulário de cadastro de usuário
		if ($_POST['action'] == 'cadastro_usuario') {
			// Verificar campos obrigatórios
			if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {
				// Obter todos os campos personalizados
				$campos_personalizados = get_campos_personalizados_usuario();

				// Inicializar o array para armazenar os valores dos campos personalizados
				$meta_values = array();

				// Preencher o array com os valores dos campos personalizados enviados pelo formulário
				foreach ($campos_personalizados as $campo => $label) {
					if (isset($_POST[$campo])) {
						$meta_values[$campo] = sanitize_text_field($_POST[$campo]);
					}
				}

				// Criar o usuário
				$userdata = array(
					'user_login' => $_POST['username'],
					'user_email' => $_POST['email'],
					'user_pass' => $_POST['password'],
					'role' => $_POST['role']
				);

				// Inserir o usuário no WordPress
				$user_id = wp_insert_user($userdata);

				// Verificar se o usuário foi inserido com sucesso
				if (!is_wp_error($user_id)) {
					// Salvar os valores dos campos personalizados para o novo usuário
					foreach ($meta_values as $campo => $valor) {
						update_user_meta($user_id, $campo, $valor);
					}
					echo 'Usuário cadastrado com sucesso!';
				} else {
					echo 'Erro ao cadastrar o usuário.';
				}
			} else {
				echo 'Todos os campos são obrigatórios.';
			}
		}
	}

	// Formulário de cadastro de usuário
	?>
	<form method="post" class="space-y-4 mt-4 px-[40px] pb-[20px]">
		<input type="hidden" name="action" value="cadastro_usuario">
		<div class="grid grid-cols-2 gap-4">
			<!-- Primeira coluna -->
			<div>
				<label class="block mb-1">Nome de Usuário:</label>
				<input type="text" name="username" class="w-full border border-gray-300 rounded px-3 py-2" value="<?php echo isset($_POST['username']) ? esc_attr($_POST['username']) : ''; ?>">
			</div>
			<div>
				<label class="block mb-1">E-mail:</label>
				<input type="email" name="email" class="w-full border border-gray-300 rounded px-3 py-2" value="<?php echo isset($_POST['email']) ? esc_attr($_POST['email']) : ''; ?>">
			</div>
			<div>
				<label class="block mb-1">Senha:</label>
				<input type="password" name="password" class="w-full border border-gray-300 rounded px-3 py-2">
			</div>
			<div>
				<label class="block mb-1">Tipo:</label>
				<select name="role" class="w-full border border-gray-300 rounded px-3 py-2">
					<option value="varejista" <?php selected('varejista', isset($_POST['role']) ? $_POST['role'] : ''); ?>>Varejista</option>
					<option value="oficina" <?php selected('oficina', isset($_POST['role']) ? $_POST['role'] : ''); ?>>Oficina</option>
				</select>
			</div>

			<!-- Segunda coluna -->
			<?php
			$campos_personalizados = get_campos_personalizados_usuario();
			foreach ($campos_personalizados as $campo => $label) {
				?>
				<div>
					<label class="block mb-1"><?php echo $label; ?>:</label>
					<input type="text" name="<?php echo $campo; ?>" class="w-full border border-gray-300 rounded px-3 py-2" value="<?php echo isset($_POST[$campo]) ? esc_attr($_POST[$campo]) : ''; ?>">
				</div>
				<?php
			}
			?>
		</div>

		<button type="submit" name="submit" class="bg-blue-500 text-white rounded px-4 py-2">Cadastrar</button>
	</form>
	<script>
		jQuery(document).ready(function($) {
			$('#editUserForm').on('submit', function(e) {
				e.preventDefault();

				// Serializa o formulário apenas se o formulário não estiver vazio
				var formData = $(this).serialize();
				if (!formData) {
					console.error("O formulário está vazio.");
					return; // Aborta a submissão se o formulário estiver vazio
				}

				var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

				$.ajax({
					type: 'POST',
					url: ajaxurl,
					data: {
						action: 'editar_usuario',
						formData: formData
					},
					success: function(response) {
						// Lidar com a resposta do servidor, se necessário
					},
					error: function(xhr, status, error) {
						console.error("Ocorreu um erro na requisição AJAX:", error);
					}
				});
			});
		});

		// Verifica se data não é null e se data.languages está presente antes de desestruturar
		if (data && data.languages) {
			// Desestrutura a propriedade languages
			const { languages } = data;

			// Agora você pode usar a variável languages normalmente
			// Fazer qualquer operação necessária com a variável languages
			// Por exemplo:
			languages.forEach(language => {
				console.log(language);
				// Fazer algo com cada linguagem
			});
		} else {
			// Lidar com o caso em que data ou data.languages é null
			console.error("A propriedade 'languages' é nula ou não está presente.");
		}

	</script>

	<?php
} else {
	echo 'Você não tem permissão para acessar esta página.';
}
?>
