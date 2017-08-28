<?php
	class Mwp_Metabox{
		function __construct(){
			add_action( 'add_meta_boxes', array($this, 'mwp_wm_add_meta_boxes') );
			add_action( 'save_post', array($this, 'mwp_wm_save_meta_box_data') );
		}

		function mwp_wm_add_meta_boxes( $post ){
			add_meta_box( 'mwp_wm_meta_box', 'World Map', array($this, 'mwp_wm_metabox'), 'mwp_world_map');
		}

		function mwp_wm_metabox( $post ){
			wp_nonce_field( basename( __FILE__ ), 'mwp_wm_metabox_nonce' );
			$mcoor_x_value = get_post_meta($post->ID, 'mcoor_x', true);
			$mcoor_y_value = get_post_meta($post->ID, 'mcoor_y', true);
			$mcoor_country_value = get_post_meta($post->ID, 'mcoor_country', true);
		?>
			<div id="map" style="width: 735px; height: 500px"></div>
			<div id="employee_meta_item">
				<label for="mcoor_x">Marker Coordinate x: </label>
				<input type="text" name="mcoor_x" value="<?php echo $mcoor_x_value; ?>" readonly>
				<br/>
				<label for="mcoor_y">Marker Coordinate y: </label>
				<input type="text" name="mcoor_y" value="<?php echo $mcoor_y_value; ?>" readonly>
				<br/>
				<label for="mcoor_coutry">Marker Country: </label>
				<input type="text" name="mcoor_country" value="<?php echo $mcoor_country_value; ?>" readonly>
		<?php
	 
			//Obtaining the linked mwpWorldMapDetails meta values
			$mwpWorldMapDetails = get_post_meta($post->ID,'mwpWorldMapDetails',true);
			$c = 0;
			if ( count( $mwpWorldMapDetails ) > 0 && is_array($mwpWorldMapDetails)) {
				foreach( $mwpWorldMapDetails as $mwpSliderDetail ) {
					if ( isset( $mwpSliderDetail['imageUrl'] ) || isset( $mwpSliderDetail['sliderCaption'] ) ) {
						printf( '
							<p class="mwp-slider-box">
								<a href="#" class="remove-package pull-right">%4$s</a>
								<label>Image url: </label>
								<br/>
								<input id="mwpWorldMapDetails[%1$s][imageUrl]" name="mwpWorldMapDetails[%1$s][imageUrl]" type="text" value="%2$s"  style="width:400px;" readonly/>
    						<input class="my_upl_button" type="button" value="Upload Image"/>
    						<br/>
    						<img src="%2$s" style="width:200px;" id="mwpWorldMapDetails[%1$s][imageUrl]"  />
								<br/><br/>
							</p>', $c, $mwpSliderDetail['imageUrl'], $mwpSliderDetail['sliderCaption'], '<i class="fa fa-trash-o fa-2x" aria-hidden="true""></i>' );
						$c = $c +1;
					}
				}
			}
	 
		?>
			<span id="output-package"></span>
			<a href="#" class="add_package"><?php _e('<i class="fa fa-plus-square fa-2x" aria-hidden="true"></i> image for Marker'); ?></a>
			<script>
				var $ =jQuery.noConflict();
				$(document).ready(function() {
					var count = <?php echo $c; ?>;
					$(".add_package").click(function() {
						count = count + 1;
						$('#output-package').append('<p class="mwp-slider-box-child"><a href="#" class="remove-package pull-right"><?php echo '<i class="fa fa-trash-o fa-2x" aria-hidden="true""></i>'; ?></a><label>Image url: </label><br/><input id="mwpWorldMapDetails['+count+'][imageUrl]" name="mwpWorldMapDetails['+count+'][imageUrl]" type="text" value="%2$s"  style="width:400px;" readonly/><input class="my_upl_button" type="button" value="Upload Image" /><br/><img src="%2$s" style="width:200px;" id="mwpWorldMapDetails['+count+'][imageUrl]"  /><br/><br/></p>' );
							return false;
					});
					$(document.body).on('click','.remove-package',function() {
						$(this).parent().remove();
					});
				});
			</script>
		</div>
		<?php
		}

		function mwp_wm_save_meta_box_data( $post_id ){
			// verify meta box nonce
			if ( !isset( $_POST['mwp_wm_metabox_nonce'] ) || !wp_verify_nonce( $_POST['mwp_wm_metabox_nonce'], basename( __FILE__ ) ) ){
				return;
			}
			// return if autosave
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
				return;
			}
		  // Check the user's permissions.
			if ( ! current_user_can( 'edit_post', $post_id ) ){
				return;
			}

			if ( isset( $_REQUEST['mcoor_x'] ) ) {
				update_post_meta( $post_id, 'mcoor_x', sanitize_text_field( $_POST['mcoor_x'] ) );
			}

			if ( isset( $_REQUEST['mcoor_y'] ) ) {
				update_post_meta( $post_id, 'mcoor_y', sanitize_text_field( $_POST['mcoor_y'] ) );
			}

			if ( isset( $_REQUEST['mcoor_country'] ) ) {
				update_post_meta( $post_id, 'mcoor_country', sanitize_text_field( $_POST['mcoor_country'] ) );
			}

			$mwpWorldMapDetails = $_POST['mwpWorldMapDetails'];
		  update_post_meta($post_id,'mwpWorldMapDetails',$mwpWorldMapDetails);
		}
	}
	new Mwp_Metabox;