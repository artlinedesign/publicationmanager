<?php
/**
 * Template Name: 404
 * A full-width template.
 *
 * @package Avada
 * @subpackage Templates
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<?php get_header(); ?>
<section id="content" class="full-width">
	<div id="post-404page">
		<div class="post-content">
			<?php
			// Render the page titles.
			$subtitle = esc_html__( 'Oops, This Page Could Not Be Found!', 'Avada' );
			Avada()->template->title_template( $subtitle );
			?>
			<div class="custom-404-wrapper">


			<span class="h-404">404</span>

			<div class="custom-404">

				<h3><?php esc_html_e( 'Search Our Website', 'Avada' ); ?></h3>
				<p><?php esc_html_e( 'Can\'t find what you need? Take a moment and do a search below!', 'Avada' ); ?></p>
				<div class="custom-404-search">
					<?php echo get_search_form( false ); ?>
				</div>
			</div>

	</div>

	</div>
</section>
<?php
get_footer();

/* Omit closing PHP tag to avoid "Headers already sent" issues. */
