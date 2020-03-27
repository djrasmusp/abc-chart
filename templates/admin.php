<div class="wrap">
    <h1>ABC Chart Settings</h1>
    <?php settings_errors() ?>
    <form action="options.php" method="POST">
        <?php
        settings_fields('acp_settings');
        do_settings_sections('chart_settings');
        submit_button();?>
    </form>
</div>
