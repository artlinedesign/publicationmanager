<?php

/**
 * Template Name: Publikationen y
 */

get_header();

?>


	<div id="content" class="full-width">
	
		<h1>Bücher</h1>
		<?php while ( have_posts() ) : the_post(); ?>
		
		<?php

			$posts = get_posts(array(
				'posts_per_page'	=> -1,
				'post_type'			=> 'books'
			));
		
			
		
			if( $posts ): ?>
				<div class="books-modul">


					<?php foreach( $posts as $post ):
						setup_postdata( $post );
						?>

						<ul>
						<a href="<?php the_field('website')?>"> 
						<?php if( get_field('buch_bild') ): ?>
						<img src="<?php the_field('buch_bild'); ?>" />

						<?php endif; ?>
					
						<li class="buch-titel"><?php the_field('buch_titel') ?></li></a>
						<li><?php the_field('buch_auflage') ?></li>
						<li><?php the_field('buch_verlag') ?></li>
						
				
				<!-- get author  -->
				<?php 
					$posts = get_field('buch_autor');
					if( $posts ): ?>
							<?php foreach( $posts as $post):  ?>
								<?php setup_postdata($post); ?>						
									<li><?php the_title(); ?>  </li>
							<?php endforeach; ?>
						<?php wp_reset_postdata(); ?>
				<?php endif; ?>

				<!--  author end -->


					</ul>
					<?php endforeach; ?>


				</div>
				<?php wp_reset_postdata(); ?>

			<?php endif; ?>



		<?php endwhile; // end of the loop. ?>



		<!-- Publikaton  -->
		<h1>Publikationen</h1>
		<?php while ( have_posts() ) : the_post(); ?>

		<?php

			$posts = get_posts(array(
				'posts_per_page'	=> -1,
				'post_type'			=> 'publications'
			));

			if( $posts ): ?>
				<div class="pubs-modul">
					<?php foreach( $posts as $post ):
						setup_postdata( $post );
						?>
						<a href="<?php the_field('pdf_pub') ?>" target="_blank"> 
						<div class="pubs-modul-wrapper">
						<img src="http://localhost/ALD/BTP/wp-content/uploads/2018/12/pdf_placeholder.jpg" alt="">

						<div class="pub-list">

							<p class="pub-titel"> <?php the_field('pub_titel') ?></p></a>
							<p class="pub-infos">


							<?php the_field('pub_herausgeber') ?> <?php the_field('pub_seite') ?>, <?php the_field('pub_jahr') ?>,


							<?php
								$posts = get_field('pub_autor');
								if( $posts ): ?>
									<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
										<?php setup_postdata($post); ?>
										<?php the_title(); ?>
											<?php the_field('pub_autor'); ?>
									<?php endforeach; ?>
									<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
							<?php endif; ?>


									</p>
								</div>
							
						</div>









					<?php endforeach; ?>
				</div>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		<?php endwhile; // end of the loop. ?>


		<!-- Articles  -->
		<h1>Beiträge</h1>
				<?php while ( have_posts() ) : the_post(); ?>

				<?php

					$posts = get_posts(array(
						'posts_per_page'	=> -1,
						'post_type'			=> 'articles'
					));

					if( $posts ): ?>
						<div class="articles-modul">
							<?php foreach( $posts as $post ):
								setup_postdata( $post );
								?>
								<div class="articles-modul-wrapper">
								<img src="http://localhost/ALD/BTP/wp-content/uploads/2018/12/pdf_placeholder.jpg" alt="">

								<div class="article-list">

									<p class="article-titel"> <?php the_field('article_titel') ?></p>
									<p class="article-infos"><?php the_field('article_autor') ?>, <?php the_field('article_herausgeber') ?> <?php the_field('article_seite') ?> <?php the_field('article_jahr') ?>   </p>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
				<?php endwhile; // end of the loop. ?>







	</div><!-- #content -->


<?php get_footer(); ?>