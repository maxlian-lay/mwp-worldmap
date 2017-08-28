<?php
	class Mwp_Metabox{
		function __construct(){
			add_action( 'add_meta_boxes', array($this, 'mwp_wm_add_meta_boxes') );
			add_action( 'save_post', array($this, 'mwp_wm_save_meta_box_data') );
		}

		function mwp_wm_add_meta_boxes( $post ){
			add_meta_box( 'mwp_wm_meta_box', 'World Map', array($this, 'mwp_wm_metabox'), 'mwp_world_map');
		}

		function mwp_slider_metabox( $post ){
			wp_nonce_field( basename( __FILE__ ), 'mwp_wm_metabox_nonce' );
		?>
			<div id="employee_meta_item">
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
								<input id="mwpWorldMapDetails[%1$s][imageUrl]" name="mwpWorldMapDetails[%1$s][imageUrl]" type="text" value="%2$s"  style="width:400px;" />
    						<input class="my_upl_button" type="button" value="Upload Image" />
    						<br/>
    						<img src="%2$s" style="width:200px;" id="mwpWorldMapDetails[%1$s][imageUrl]"  />
								<br/><br/>
								<label>Slider caption: </label>
								<br/>
								<textarea name="mwpWorldMapDetails[%1$s][sliderCaption]"  rows="4" cols="50" >%3$s</textarea>
								<br/>
							</p>', $c, $mwpSliderDetail['imageUrl'], $mwpSliderDetail['sliderCaption'], '<i class="fa fa-trash-o fa-2x" aria-hidden="true""></i>' );
						$c = $c +1;
					}
				}
			}
	 
		?>
			<span id="output-package"></span>
			<a href="#" class="add_package"><?php _e('<i class="fa fa-plus-square fa-2x" aria-hidden="true"></i> image for Slider'); ?></a>
			<script>
				var $ =jQuery.noConflict();
				$(document).ready(function() {
					var count = <?php echo $c; ?>;
					$(".add_package").click(function() {
						count = count + 1;
						$('#output-package').append('<p class="mwp-slider-box-child"><a href="#" class="remove-package pull-right"><?php echo '<i class="fa fa-trash-o fa-2x" aria-hidden="true""></i>'; ?></a><label>Image url: </label><br/><input id="mwpWorldMapDetails['+count+'][imageUrl]" name="mwpWorldMapDetails['+count+'][imageUrl]" type="text" value="%2$s"  style="width:400px;" /><input class="my_upl_button" type="button" value="Upload Image" /><br/><img src="%2$s" style="width:200px;" id="mwpWorldMapDetails['+count+'][imageUrl]"  /><br/><br/><label>Slider caption: </label><br/><textarea name="mwpWorldMapDetails['+count+'][sliderCaption]" rows="4" cols="50" ></textarea><br/></p>' );
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

			$mwpWorldMapDetails = $_POST['mwpWorldMapDetails'];
		  update_post_meta($post_id,'mwpWorldMapDetails',$mwpWorldMapDetails);
		}
	}
	new Mwp_Metabox;