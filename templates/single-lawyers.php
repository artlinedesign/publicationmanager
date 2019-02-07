<?php
/**
 * Template Name: Anwalt Profil
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
    <section id="content" class="full-width">
        <?php echo do_shortcode('[fusion_builder_container admin_label="Seperator" hundred_percent="no" hundred_percent_height="no" hundred_percent_height_scroll="no" hundred_percent_height_center_content="yes" equal_height_columns="no" menu_anchor="" hide_on_mobile="small-visibility,medium-visibility,large-visibility" status="published" publish_date="" class="toggle--seperator" id="" background_color="#ffffff" background_image="https://btp.at/btp-content/uploads/2018/03/seperator.jpg" background_position="center center" background_repeat="no-repeat" fade="no" background_parallax="none" enable_mobile="no" parallax_speed="0.3" video_mp4="" video_webm="" video_ogv="" video_url="" video_aspect_ratio="16:9" video_loop="yes" video_mute="yes" video_preview_image="" border_size="" border_color="" border_style="solid" margin_top="15px" margin_bottom="40px" padding_top="25px" padding_right="" padding_bottom="25px" padding_left="" admin_toggled="no"][fusion_builder_row][fusion_builder_column type="1_1" layout="1_1" spacing="" center_content="no" hover_type="none" link="" min_height="" hide_on_mobile="small-visibility,medium-visibility,large-visibility" class="" id="" background_color="" background_image="" background_position="left top" background_repeat="no-repeat" border_size="0" border_color="" border_style="solid" border_position="all" padding_top="" padding_right="" padding_bottom="" padding_left="" margin_top="" margin_bottom="" animation_type="" animation_direction="left" animation_speed="0.3" animation_offset="" last="no"][/fusion_builder_column][/fusion_builder_row][/fusion_builder_container]'); ?>
        <?php while ( have_posts() ) : ?>
            <?php the_post(); ?>

            <div id="lawyer-profile">
                <div class="lawyer-id">
                    <h1>
                        <?php the_field('akademischer_titel') ?>
                        <?php the_field('vorname') ?>
                        <?php the_field('nachname') ?>
                        <?php the_field('titel_nachgestellt') ?>
                    </h1>

                    <?php if( get_field('portrait') ): ?>
                        <img src="<?php the_field('portrait'); ?>" />
                    <?php endif; ?>
                </div>

                <div class="lawyer-info">
                    <?php the_field('intro') ?>
                    <h2><?php _e( 'Experience', 'btp-cm' ) ?></h2> <?php the_field('berufserfahrung') ?>
                    <h2><?php _e( 'Degrees & Training', 'btp-cm' ) ?></h2><?php the_field('studium_&_ausbildung') ?>
                    <h2><?php _e( 'Others', 'btp-cm' ) ?></h2>

                    <?php the_field('sonstiges') ?>
                    <div class="mail-backoffice">
                        <a href="mailto:<?php the_field('e-mail') ?>"><?php the_field('e-mail') ?></a>

                        <?php if ( get_field('backoffice_name') && get_field('backoffice_e-mail')) :?>
                            <p>Backoffice: <?php the_field('backoffice_name') ?> <br>
                                <a href="mailto:<?php the_field('backoffice_e-mail') ?>"><?php the_field('backoffice_e-mail') ?></a></p>
                        <?php endif; ?>


                        <?php if ( get_field('backoffice_name_2') && get_field('backoffice_e-mail_2')) :?>
                            <p>Backoffice: <?php the_field('backoffice_name_2') ?> <br>
                                <a href="mailto:<?php the_field('backoffice_e-mail_2') ?>"><?php the_field('backoffice_e-mail_2') ?></a></p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>



            <div class="lawyer-books">
                <h1><?php _e('Books', 'btp-cm') ?></h1>
                <div class="lawyer-id">
                    <?php
                    $posts = get_posts(array(
                        'posts_per_page'	=> -1,
                        'post_type'			=> 'books',
                        'meta_query' => array(
                            array(
                                'key' => 'buch_autor',
                                'value' => '"' . get_the_ID() . '"',
                                'compare' => 'LIKE'
                            )
                        )

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
                </div>
            </div>


            <div class="lawyer-articles">
                <h1><?php _e('Articles', 'btp-cm') ?></h1>
                <div class="lawyer-id">

                    <?php
                    $posts = get_posts(array(
                        'posts_per_page'	=> -1,
                        'post_type'			=> 'articles'
                    ));
                    if( $posts ): ?>
                        <ul>
                            <?php foreach( $posts as $post ):
                                setup_postdata( $post );
                                ?>
                                <li>
                                    <?php the_title(); ?>

                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="lawyer-publications">
                <h1><?php _e('Publications', 'btp-cm') ?></h1>
                <div class="lawyer-id">
                    <?php
                    $posts = get_posts(array(
                        'posts_per_page'	=> -1,
                        'post_type'			=> 'publications'
                    ));
                    if( $posts ): ?>
                        <ul>
                            <?php foreach( $posts as $post ):
                                setup_postdata( $post );
                                ?>
                                <li>
                                    <?php the_title(); ?>

                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>
            </div>









        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    </section>
<?php do_action( 'avada_after_content' ); ?>
<?php
get_footer();
remove_filter('acf/settings/current_language', '__return_false');
/* Omit closing PHP tag to avoid "Headers already sent" issues. */
