<?php

class WP_User_Query_Helper {
	protected $wpdb;

	public function __construct() {
		global $wpdb;
		$this->wpdb = $wpdb;
	}

	public function get_users_table() {
		return $this->wpdb->prefix . 'users';
	}

	public function get_non_admin_users_count() {
		$users_table = $this->get_users_table();

		$count = $this->wpdb->get_var("
            SELECT COUNT(*)
            FROM $users_table
            WHERE ID NOT IN (
                SELECT user_id
                FROM {$this->wpdb->prefix}usermeta
                WHERE meta_key = '{$this->wpdb->prefix}capabilities'
                AND meta_value LIKE '%administrator%'
            )
        ");

		return $count;
	}

	public function get_users_registered_this_month_count() {
		$users_table = $this->get_users_table();

		$count = $this->wpdb->get_var("
            SELECT COUNT(*)
            FROM $users_table
            WHERE YEAR(user_registered) = YEAR(CURRENT_DATE())
            AND MONTH(user_registered) = MONTH(CURRENT_DATE())
            AND ID NOT IN (
                SELECT user_id
                FROM {$this->wpdb->prefix}usermeta
                WHERE meta_key = '{$this->wpdb->prefix}capabilities'
                AND meta_value LIKE '%administrator%'
            )
        ");

		return $count;
	}

	public function get_users_with_meta($meta_key, $meta_value) {
		$users_table = $this->get_users_table();

		$results = $this->wpdb->get_results($this->wpdb->prepare("
            SELECT u.*
            FROM $users_table u
            INNER JOIN {$this->wpdb->prefix}usermeta um ON u.ID = um.user_id
            WHERE um.meta_key = %s
            AND um.meta_value = %s
        ", $meta_key, $meta_value));

		return $results;
	}

	public function get_users_by_role($role) {
		$users_table = $this->get_users_table();

		$results = $this->wpdb->get_results($this->wpdb->prepare("
            SELECT u.*
            FROM $users_table u
            INNER JOIN {$this->wpdb->prefix}usermeta um ON u.ID = um.user_id
            WHERE um.meta_key = '{$this->wpdb->prefix}capabilities'
            AND um.meta_value LIKE %s
        ", '%' . $role . '%'));

		return $results;
	}

	public function get_users_registered_and_active_per_month() {
		$months_data = array();

		// Loop through each month of the current year
		for ($month = 1; $month <= 12; $month++) {
			$start_date = date('Y-m-01', mktime(0, 0, 0, $month, 1, date('Y')));
			$end_date = date('Y-m-t', mktime(0, 0, 0, $month, 1, date('Y')));

			// Count registered non-admin users for this month
			$registered_count = $this->wpdb->get_var($this->wpdb->prepare("
            SELECT COUNT(*)
            FROM {$this->get_users_table()} u
            LEFT JOIN {$this->wpdb->prefix}usermeta um ON u.ID = um.user_id
            WHERE um.meta_key = '{$this->wpdb->prefix}capabilities'
            AND um.meta_value NOT LIKE %s
            AND user_registered BETWEEN %s AND %s
        ", '%"administrator"%', $start_date, $end_date));

			// Count active non-admin users for this month
			$active_count = $this->wpdb->get_var($this->wpdb->prepare("
            SELECT COUNT(*)
            FROM {$this->get_users_table()} u
            INNER JOIN {$this->wpdb->prefix}usermeta um ON u.ID = um.user_id
            WHERE um.meta_key = 'user_status' AND um.meta_value = 'ativo'
            AND u.ID NOT IN (
                SELECT user_id
                FROM {$this->wpdb->prefix}usermeta
                WHERE meta_key = '{$this->wpdb->prefix}capabilities'
                AND meta_value LIKE '%administrator%'
            )
            AND user_registered BETWEEN %s AND %s
        ", $start_date, $end_date));

			// Store data for this month
			$months_data[date('F', mktime(0, 0, 0, $month, 1, date('Y')))] = array(
				'registered_count' => $registered_count,
				'active_count' => $active_count
			);
		}

		return $months_data;
	}

	public function get_current_user_data() {
		// Get the current user ID
		$current_user_id = get_current_user_id();

		// Check if a user is logged in
		if ($current_user_id) {
			// Get the user's data from the WordPress user table
			$user_data = get_userdata($current_user_id);

			// Get the user's metadata
			$user_meta = get_user_meta($current_user_id);

			// Combine user data and metadata into a single array
			$user_all_data = array_merge((array) $user_data->data, $user_meta);

			return $user_all_data;
		} else {
			// If no user is logged in, return null
			return null;
		}
	}

	public function get_users_indicated_by_current_user_this_month() {
		// Get the current user ID
		$current_user_id = get_current_user_id();

		// Check if a user is logged in
		if ($current_user_id) {
			// Get the current user's codigo_invite metadata
			$codigo_invite = get_user_meta($current_user_id, 'codigo_invite', true);

			// If codigo_invite is not set for the current user, return null
			if (empty($codigo_invite)) {
				return null;
			}

			// Get the current month and year
			$current_month = date('m');
			$current_year = date('Y');

			// Get the start and end date of the current month
			$start_date = date('Y-m-01', mktime(0, 0, 0, $current_month, 1, $current_year));
			$end_date = date('Y-m-t', mktime(0, 0, 0, $current_month, 1, $current_year));

			// Query to get users indicated by the current user in the current month
			$indicated_users = $this->wpdb->get_results($this->wpdb->prepare("
            SELECT u.*
            FROM {$this->get_users_table()} u
            INNER JOIN {$this->wpdb->prefix}usermeta um ON u.ID = um.user_id
            WHERE um.meta_key = 'codigo_invite'
            AND um.meta_value = %s
            AND u.ID != %d
            AND u.ID NOT IN (
                SELECT user_id
                FROM {$this->wpdb->prefix}usermeta
                WHERE meta_key = '{$this->wpdb->prefix}capabilities'
                AND meta_value LIKE '%administrator%'
            )
            AND DATE(u.user_registered) BETWEEN %s AND %s
        ", $codigo_invite, $current_user_id, $start_date, $end_date));

			return $indicated_users;
		} else {
			// If no user is logged in, return null
			return null;
		}
	}

	public function get_users_indicated_by_current_user_with_status_this_month($codigo_invite) {
		// Get the current user ID
		$current_user_id = get_current_user_id();

		// Check if a user is logged in
		if ($current_user_id) {
			// Get the current user's codigo_invite metadata
			$current_user_codigo_invite = get_user_meta($current_user_id, 'codigo_invite', true);

			// If codigo_invite is not set for the current user, return null
			if (empty($current_user_codigo_invite)) {
				return null;
			}

			// Get the current month and year
			$current_month = date('m');
			$current_year = date('Y');

			// Get the start and end date of the current month
			$start_date = date('Y-m-01', mktime(0, 0, 0, $current_month, 1, $current_year));
			$end_date = date('Y-m-t', mktime(0, 0, 0, $current_month, 1, $current_year));

			// Query to get users indicated by the current user in the current month with active status
			$indicated_users = $this->wpdb->get_results($this->wpdb->prepare("
            SELECT u.*
            FROM {$this->get_users_table()} u
            INNER JOIN {$this->wpdb->prefix}usermeta um1 ON u.ID = um1.user_id
            LEFT JOIN {$this->wpdb->prefix}usermeta um2 ON u.ID = um2.user_id AND um2.meta_key = 'user_status'
            WHERE um1.meta_key = 'codigo_invite'
            AND um1.meta_value = %s
            AND u.ID != %d
            AND u.ID NOT IN (
                SELECT user_id
                FROM {$this->wpdb->prefix}usermeta
                WHERE meta_key = '{$this->wpdb->prefix}capabilities'
                AND meta_value LIKE '%administrator%'
            )
            AND (um2.meta_value IS NULL OR um2.meta_value = 'ativo')
            AND DATE(u.user_registered) BETWEEN %s AND %s
        ", $codigo_invite, $current_user_id, $start_date, $end_date));

			return $indicated_users;
		} else {
			// If no user is logged in, return null
			return null;
		}
	}

	public function get_promotor_of_user_oficina() {
		// Get the current user ID
		$current_user_id = get_current_user_id();

		// Check if a user is logged in
		if ($current_user_id) {
			// Get the current user's codigo_invite metadata
			$codigo_invite = get_user_meta($current_user_id, 'codigo_invite', true);

			// If codigo_invite is not set for the current user, return null
			if (empty($codigo_invite)) {
				return null;
			}

			// Query to get the promotor of the user oficina with metadata "nome_fantasia"
			$promotor = $this->wpdb->get_row($this->wpdb->prepare("
            SELECT u.*, umf.meta_value as nome_fantasia
            FROM {$this->get_users_table()} u
            INNER JOIN {$this->wpdb->prefix}usermeta um ON u.ID = um.user_id
            INNER JOIN {$this->wpdb->prefix}usermeta umf ON u.ID = umf.user_id
            WHERE um.meta_key = 'codigo_invite'
            AND um.meta_value = %s
            AND umf.meta_key = 'nome_fantasia'
            AND u.ID != %d
            AND u.ID NOT IN (
                SELECT user_id
                FROM {$this->wpdb->prefix}usermeta
                WHERE meta_key = '{$this->wpdb->prefix}capabilities'
                AND meta_value LIKE '%administrator%'
            )
        ", $codigo_invite, $current_user_id));

			return $promotor;
		} else {
			// If no user is logged in, return null
			return null;
		}
	}

}
