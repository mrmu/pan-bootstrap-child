<?php
/**
 * The home template file.
 * 
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pan-bootstrap-child
 * @since 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
get_header(); ?>

<div class="wrapper">
	<main>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- section -->
					<section>
						<?php get_template_part('loop'); ?>
						<?php get_template_part('pagination'); ?>
					</section>
					<!-- /section -->
                </div>
			</div><!-- /.row -->
		</div><!-- /.container -->
	</main>
</div>

<?php get_footer(); ?>
