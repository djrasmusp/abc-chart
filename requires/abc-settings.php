<?php

add_action( 'admin_menu', 'abc_chart_parser_menu' );

function abc_chart_parser_menu() {
	//create custom top-level menu
	add_menu_page( 'ABC Chart Parser',
	               'ABC Chart Parser',
	               'manage_options',
	               'abc_chart_parser',
	               'abc_chart_parser_add' );

	add_submenu_page( 'abc_chart_parser',
	                  'Add Chart',
	                  'Add Chart',
	                  'manage_options',
	                  'abc_chart_parser',
	                  'abc_chart_parser_add' );

	add_submenu_page( 'abc_chart_parser',
	                  'All Charts',
	                  'All Charts',
	                  'manage_options',
	                  'abc_chart_parser_all' );

	add_submenu_page( 'abc_chart_parser',
	                  'Settings',
	                  'Settings',
	                  'manage_options',
	                  'abc_chart_parser_settings',
	                  'abc_chart_parser_settings' );
}

function abc_chart_parser_add() {
	echo '<div class="wrap"><h1>Add New Chart</h1></div>';
}

function abc_chart_parser_settings() {
	if ( $_POST ) {
		$settings = array(
			'api_key'       => $_POST['api_key'],
			'client_id'     => $_POST['client_id'],
			'client_secret' => $_POST['client_secret']
		);
		update_option( 'abc_parser_settings', serialize( $settings ) );
		echo '<div id="message" class="updated notice notice-success is-dismissible">
            <p>Settings have been saved.</p>
                <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
            </div>';
	}

	$settings = unserialize( get_option( 'abc_parser_settings', null ) );

	if ( is_null( $settings ) ) {
		$settings = array();
	}

	?>
    <div class="wrap">
        <h1>ABC Chart Parser Settings</h1>
        <form action="admin.php?page=<?php echo $_GET['page'] ?>&change=true"
              method="POST">
            <h2 class="title">CameleonPDF API Settings</h2>
            <table class="form-table" role="presentation">
                <tbody>
                <tr>
                    <th scope="row">
                        <label for="api_key">API Key</label>
                    </th>
                    <td>
                        <input style="width:600px;" type="text" name="api_key"
                               value="<?php
						       if ( ! empty( $settings['api_key'] ) ) {
							       echo $settings['api_key'];
						       } ?>"/>
                        <p class="description">Get API Key for <a
                                    href="https://rapidapi.com/feelmare/api/cameleonpdf"
                                    target="_blank">CameleonPDF</a>.</p>
                    </td>
                </tr>
                </tbody>
            </table>
            <h2 class="title">Spotify API Settings</h2>
            <table class="form-table" role="presentation">
                <tbody>
                <tr>
                    <th scope="row">
                        <label for="client_id">Client Id</label>
                    </th>
                    <td>
                        <input style="width:600px;" type="text" name="client_id"
                               value="<?php
						       if ( $settings['client_id'] !== null ) {
							       echo $settings['client_id'];
						       } ?>"/>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="client_secret">Client Secret</label>
                    </th>
                    <td>
                        <input style="width:600px;" type="text"
                               name="client_secret"
                               value="<?php
						       if ( $settings['client_secret'] !== null ) {
							       echo $settings['client_secret'];
						       } ?>"/>
                        <p class="description">Get Client ID and Secret for <a
                                    href="https://developer.spotify.com"
                                    target="_blank">Spotify</a>.</p>
                    </td>
                </tr>
                </tbody>
            </table>
            <p class="submit">
                <input type="submit" class="button button-primary"
                       value="Save Changes"/>
            </p>
        </form>
    </div>
	<?php
}

;
