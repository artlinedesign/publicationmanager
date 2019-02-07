<?php

/**
 * Template Name: Team
 */

get_header();

?>


	<div id="content" class="full-width">

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
										<p class="lawyer-name-team"><?php the_field('vorname_nachname') ?></p></a>
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
		</div>


	</div><!-- #content -->


<?php get_footer(); ?>
