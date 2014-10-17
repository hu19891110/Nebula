<?php

//Create a placeholder box as an FPO element
function fpo($title='FPO', $description='', $icon='', $width='100%', $height="250px", $bg='#ddd', $color=0, $styles='', $classes='') {
	$safe_title = strtolower(str_replace(' ', '-', $title));
	
	$icon_html = '';
	if ( $icon != '' ) {
		if ( strpos($icon, 'fa-') === false ) {
			$icon = 'fa-' . $icon;
		}
		$icon_html = '<i class="fa ' . $icon . '"></i>';
	}
	
	if ( $color ) {
		$title_color = '#fff';
		$desc_color = '255';
	} else {
		$title_color = '#222';
		$desc_color = '0';
	}
	
	echo '<div class="nebula-fpo ' . $safe_title . ' valign ' . $classes . '" style="position: relative; text-align: center; width: ' . $width . '; height: ' . $height . '; padding: 10px; background: ' . $bg . '; ' . $styles . '">
			<div>
				<h3 style="font-size: 21px; color: ' . $title_color . ';">' . $icon_html . ' ' . $title . '</h3>
				<p style="font-size: 14px; color: rgba(' . $desc_color . ',' . $desc_color . ',' . $desc_color . ',0.6);">' . $description . '</p>
			</div>
		</div>';
}


//Placeholder form
function fpo_form($fields=array('Name', 'Email', 'Message'), $submit="Send", $action=null) {
	
	if ( !isset($action) ) {
		$action = get_template_directory_uri() . '/includes/mailer.php';
		echo '<script>
			jQuery(document).ready(function() {
				jQuery(document).on("submit", "#nebula-fpo-form", function(e){
					var contactData = [{
						"name": jQuery("#nebula-fpo-form input.name").val(),
						"email": jQuery("#nebula-fpo-form input.email").val(),
						"message": jQuery("#nebula-fpo-form textarea.message").val(),
					}];
					
					jQuery("#form-messages").html("<i class=\"fa fa-spinner fa-spin sending\"></i> Sending...");
					
					jQuery.ajax({
						type: "POST",
						url: "' . get_template_directory_uri() . '/includes/mailer.php",
						data: {
							data: contactData,
						},
						success: function(response){
							if ( response.indexOf("Thank you") > -1 ) {					
								jQuery("#nebula-fpo-form input:not(#contact-submit), #nebula-fpo-form textarea").val("").trigger("keyup");
								jQuery("#nebula-fpo-form").slideUp();
							}
							jQuery("#form-messages").html(response);
						},
						error: function(MLHttpRequest, textStatus, errorThrown){
							jQuery("#form-messages").text(errorThrown);
						},
						timeout: 60000
					});
					e.preventDefault();
					return false;
				});
			});
		</script>';
	}
	
	$return = '<form id="nebula-fpo-form" name="nebula-fpo-form" class="nebula-fpo-form" method="POST" action="' . $action . '"><ul>';
	foreach ( $fields as $field ) {
		$safe_field = strtolower(str_replace(' ', '-', $field));
		if ( $field == 'Message' || $field == 'Comments' ) {
			$return .= '<li class="field"><span class="contact-form-heading">' . $field . '</span><textarea class="input textarea ' . $safe_field . '" placeholder="' . $field . '" style="resize: vertical;"></textarea></li>';
		} elseif ( $field == 'Email' ) {
			$return .= '<li class="field"><span class="contact-form-heading">' . $field . '</span><input class="input ' . $safe_field . '" type="email" placeholder="' . $field . '" /></li>';
		} else {
			$return .= '<li class="field"><span class="contact-form-heading">' . $field . '</span><input class="input ' . $safe_field . '" type="text" placeholder="' . $field . '" /></li>';
		}
	}
	$return .= '<li class="field"><input class="submit" type="submit" value="' . $submit . '"></li></ul></form><div id="form-messages"></div>';
	
	echo $return;
	
}


//Placeholder menu
//Parameters: menu name, styles
//@TODO: How to do a dropdown or mega-menu?
function fpo_menu() {
	
}


//Placeholder slider
//@TODO: Pass an object to set options.
function fpo_slider($slides=3) {
	$return = '<div class="nebula-fpo-slider"><ul class="bxslider fposlider">';
	if ( is_int($slides) ) {
		$i = 1;
		while ( $i <= $slides ) {
			$return .= '<li><img class="random-unsplash" src="' . random_unsplash(800, 400) . '" alt="Slide ' . $i . '" /></li>';
			$i++;	
		}
	} else {
		foreach ( $slides as $slide ) {
			$return .= '<li><img src="' . $slide . '" /></li>';
		}
	}
	$return .= '</ul></div><!--/nebula-fpo-slider-->';
	
	$return .= '<script>
		jQuery(window).on("load", function() {
			setTimeout(function(){
				jQuery(".fposlider").bxSlider({
					mode: "fade",
					speed: 800,
					captions: false,
					pager: false,
					auto: false,
					pause: 8000,
					autoHover: true,
					adaptiveHeight: true,
					useCSS: true,
					controls: true
				});
			}, 1000);
		});
	</script>';
	echo $return;
}


//Placeholder video
//@TODO: both metas are null... same issue as elsewhere when using the metas.
function fpo_video($id='jtip7Gdcf0Q', $service='youtube') {
	
	if ( $service == 'vimeo' || $service == 'Vimeo' ) {
		
		vimeo_meta($id);
		echo '<iframe id="' . $vimeo_meta['safetitle'] . '" class="vimeoplayer" src="http://player.vimeo.com/video/' . $vimeo_meta['id'] . '?api=1&player_id=' . $vimeo_meta['safetitle'] . '" width="560" height="315" autoplay="1" badge="1" byline="1" color="00adef" loop="0" portrait="1" title="1" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
	
	} else {
		
		youtube_meta($id);
		echo '<iframe id="' . $youtube_meta['safetitle'] . '" class="youtubeplayer" width="560" height="315" src="http://www.youtube.com/embed/' . $youtube_meta['id'] . '?wmode=transparent&enablejsapi=1&origin=' . $youtube_meta['origin'] . '" frameborder="0" allowfullscreen=""></iframe>';
	
	}
}



//eCommerce suite, ad buckets, lightbox, 