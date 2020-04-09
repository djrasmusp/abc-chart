<?php

if ( metadata_exists( 'post', get_the_ID(), 'chart' ) ) {
	$chart_type = get_post_meta( get_the_ID(), 'chart' )[0]['chart'];
	$chart_type = get_term_by( 'slug', $chart_type, 'chart_type' );

	$chart_types = get_terms( [
		                          'taxonomy'   => 'chart_type',
		                          'hide_empty' => false,
	                          ] ); ?>
    <table class="form-table" role="presentation">
        <tr>
            <th scope="row"><label for="file">Chart type</label></th>
            <td><select name="chart_type" required>
					<?php
					echo '<option value="' . $chart_type->slug . '">'
					     . $chart_type->name
					     . '</option>';
					echo '<option disabled="disabled">-----</option>';
					foreach ( $chart_types as $type ) {
						echo '<option value="' . $type->slug . '">'
						     . $type->name
						     . '</option>';
					}
					?>
                </select>
            </td>
        </tr>
    </table>
    <table class="form-table" role="presentation">
        <thead>
        <tr class="alternate">
            <th style="width: 10px">Pl</th>
            <th style="width: 10px">SU</th>
            <th style="width: 10px">W</th>
            <th>Track</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
		<?php
		$evn_row    = 1;
		$row_number = 0;
		foreach ( get_post_meta( get_the_ID(), 'chart' )[0]['tracks'] as $item )
		{
			if ( $evn_row % 2 ) {
				echo '<tr>';
			} else {
				echo '<tr class="alternate">';
			}
			$evn_row ++; ?>
                <td class="row-title"><?php echo $item['position'] ?></td>
                <td><input class="small-text"
                           name="tracks[<?php echo $row_number ?>][last_week]"
                           value="<?php echo $item['last_week'] ?>"></td>
                <td><input class="small-text"
                           name="tracks[<?php echo $row_number ?>][number_of_weeks]"
                           value="<?php echo $item['number_of_weeks'] ?>"></td>
                <td><input class="large-text"
                           name="tracks[<?php echo $row_number ?>][track]"
                           value="<?php echo $item['track'] ?>">
                </td>
                <td>
                    <input type="text"
                           name="tracks[<?php echo $row_number ?>][update]"
                           class="large-text" value=""
                           placeholder="udfyld med spotify album id">
                </td>
                <td>
                    <img src="<?php echo $item['spotify']['url'] ?>" height="100">
                    <input type="hidden" name="tracks[<?php echo $row_number ?>][album_id]" value="<?php echo $item['spotify']['id']?>">
                    <input type="hidden" name="tracks[<?php echo $row_number ?>][album_url]" value="<?php echo $item['spotify']['url']?>">
                </td>
            </tr>
			<?php
			$row_number ++;
		} ?>
        </tbody>
    </table>
	<?php return;
} ?>
<form action="<?php echo admin_url( 'admin.php' ) ?>" method="post">
    <table class="form-table" role="presentation">
        <tr>
            <th scope="row"><label for="file">Chart type</label></th>
            <td><select name="chart_type">
                    <option value="">Vælg chart type</option>
					<?php
					$terms = get_terms( array(
						                    'taxonomy'   => 'chart_type',
						                    'hide_empty' => false
					                    ) );

					foreach ( $terms as $term ) {
						echo '<option value="' . $term->slug . '">'
						     . $term->name
						     . '</option>';
					}
					?>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="file">File</label></th>
            <td><input type="file" class="regular-text"
                       name="file"
                       accept="application/pdf,application/vnd.ms-excel"/>
            </td>
        </tr>
    </table>
    <input type="hidden" name="action" value="wpse10500">
    <input type="hidden" name="chart_post_id"
           value="<?php echo get_the_ID() ?>">
	<?php wp_nonce_field( 'wpse10500', 'make_chart_nonce' ); ?>
    <input type="submit" name="submit" value="Submit">
</form>
