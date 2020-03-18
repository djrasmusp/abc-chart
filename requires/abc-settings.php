<?php

add_action( 'admin_menu', 'abc_chart_parser_menu' );

function abc_chart_parser_menu() {
	//create custom top-level menu
	add_menu_page( 'ABC Chart Parser',
	               'ABC Chart Parser',
	               'manage_options',
	               'abc_parser_settings',
	               'abc_chart_parser_settings' );
}

function abc_chart_parser_settings() {
	if ( $_POST && isset( $_POST['api_key'] ) && $_POST['api_key'] !== '' ) {
		update_option( 'abc_parser_settings', $_POST['api_key'] );
		echo '<p style="font-size: 110%; color:green"><strong>API KEY updateded.</strong></p>';
	}

	$settings = get_option( 'abc_parser_settings', null );

	if ( is_null( $settings ) ) {
		$settings = '';
	}

	?>
    <div class="wrap">
        <h2>ABC Chart Parser Settings</h2>

        <form action="admin.php?page=<?php echo $_GET['page'] ?>" method="post">
            API KEY: <input style="width:600px;" type="text" name="api_key"
                            value="<?php
			                if ( $settings !== null ) {
				                echo $settings;
			                } ?>"/>
            <br/><input type="submit"/>
        </form>
    </div>

	<?php
}

;
