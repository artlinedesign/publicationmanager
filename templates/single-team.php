<?php
/**
 * Template Name: Team 
 * A full-width template.
 *
 * @package Avada
 * @subpackage Templates
 */
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
add_filter('acf/settings/current_language', '__return_false');
?>
<?php get_header(); ?>

<section id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>



		<h1> <?php _e( 'RechtsanwältInnen', 'btp-cm' ) ?> </h1>

		<div id="btp-team">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
					$posts = get_posts(array(
						'posts_per_page'	=> -1,
						'post_type'			=> 'lawyers'
					));
					if( $posts ): ?>
					
							<?php foreach( $posts as $post ):
								setup_postdata( $post );
								?>
								<div class="lawyer-id-team">
									<?php if( get_field('portrait') ): ?>
									<a href=' <?php echo get_the_permalink(); ?>'>
										<img src="<?php the_field('portrait'); ?>" />
										<?php endif; ?>
										<p class="lawyer-name-team">
										<?php the_field('vorname')?> 
										<?php the_field('nachname') ?>
										</p></a>
										<?php
										$position = get_field('position');
										if( $position ): ?>
										<p><?php echo $position->name; ?> </p>
										<?php endif; ?>
										<a href="mailto:<?php the_field('e-mail') ?>"><?php the_field('e-mail') ?></a>
								</div>
							<?php endforeach; ?>
						</div>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
			<?php endwhile; // end of the loop. ?>

			<h1> <?php _e( 'RechtsanwaltsanwärterInnen', 'btp-cm' ) ?> </h1>

							
			<h1> <?php _e( 'ExpertInnen', 'btp-cm' ) ?> </h1>

			<h1> <?php _e( 'Backoffice', 'btp-cm' ) ?> </h1>

			<h1> <?php _e( 'Juristische MitarbeiterInnen', 'btp-cm' ) ?> </h1>

		</div>

	<?php wp_reset_postdata(); ?>
	
</section>


<?php do_action( 'avada_after_content' ); ?>
<?php
get_footer();
remove_filter('acf/settings/current_language', '__return_false');
/* Omit closing PHP tag to avoid "Headers already sent" issues. */

