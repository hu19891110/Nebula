<?php if ( !is_search() && (array_key_exists('s', $_GET) || array_key_exists('rs', $_GET)) ): ?>
	<div id="header-drawer" class="container-fluid single-result-redirect">
		<div class="row">
			<div class="col-md-12">
				<h5>Your search returned only one result. You have been automatically redirected.</h5>
				<a class="close" href="<?php echo get_the_permalink(); ?>">&times;</a>
				<?php echo nebula_search_form(); ?>
			</div><!--/col-->
		</div><!--/row-->
	</div><!--/container-->
<?php elseif ( (is_page('search') || is_page_template('tpl-search.php')) && array_key_exists('invalid', $_GET) ): ?>
	<div id="header-drawer" class="container-fluid invalid">
		<div class="row">
			<a class="close" href="<?php echo get_the_permalink(); ?>">&times;</a>
			<div class="col-md-12">
				<h5>Your search was invalid. Please try again.</h5>
				<?php echo nebula_search_form(); ?>
			</div><!--/col-->
		</div><!--/row-->
	</div><!--/container-->
<?php elseif ( is_404() || !have_posts() || array_key_exists('s', $_GET) || is_page_template('http_status.php') ): ?>
	<div id="header-drawer" class="container-fluid suggestedpage">
		<div class="row">
			<div class="col-md-12">
				<h3>Did you mean?</h3>
				<p><a class="suggestion" href="#"></a></p>
				<a class="close" href="<?php echo get_the_permalink(); ?>">&times;</a>
			</div><!--/col-->
		</div><!--/row-->
	</div><!--/container-->
<?php endif; ?>