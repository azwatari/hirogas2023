<?php
/**
 * The main template file
 * @link http://codex.wordpress.org/Template_Hierarchy
 * @package WordPress
 * @subpackage hirogas_2023
 * @since watari 1.0
 */
get_header(); ?>

<?php get_template_part('parts/header_global', get_post_format()); ?>


<section class="section_main section_main_separate">
  <div class="wrapper_global">
		<div class="section_contents_main">
			<section class="section_shopdetail section_detail">
				<?php
					$args = array(
						'post_type' => 'shop', //①カスタム投稿名 (通常の「投稿」はpost)
						//'taxonomy' => $select_tax, //②タクソノミー名を指定 (通常の「投稿」はcategory)
						//'field' => 'slug',   //'term_id'、'slug'など、次の term を指定するフィールド名を指定
						//'term' => $term->slug,  //③タームを指定
						//'terms' => array('test','test2'), &nbsp;//③タームを指定 (複数の場合)
						'posts_per_page' => -1, //表示数を指定
					);

					$custom_query = new WP_Query( $args );
					if ( $custom_query->have_posts() ) {
							get_template_part('parts/content_shop_single', get_post_format());
					}
					wp_reset_postdata();
				?>
			</section>

			<section class="section_back">
				<a class="link_back" href="javascript:history.back();">前のページに戻る</a>
			</section>
		</div>

    <aside>
			<?php get_template_part('parts/aside', get_post_format()); ?>
    </aside>

  </div>
</section>


<?php get_footer(); ?>