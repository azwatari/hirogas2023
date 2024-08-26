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


<section class="section_main section_main_separate with_search">
  <div class="wrapper_global">
    <div class="section_contents_main">
      <section class="section_search section_search_shop">
        <header class="header_section header_section_searchshop">
          <h2 class="title_header_section title_header_section_searchshop">加盟店を探す</h2>
        </header>
        <div class="content_section content_section_search">
          <?php get_template_part('parts/search_shop', get_post_format()); ?>
        </div>
      </section>

      <?php
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $shop_args = array(
          'post_type' => 'shop',
          'taxonomy'=>'shop_area',
          'term'=>$term,
          'posts_per_page' => 10,
          'paged' => $paged,
          //'meta_key' => 'invisible',
          //'meta_value' => 'visible'
        );
        $wp_query =new WP_Query($shop_args);
      ?>
    
      <section class="section_pagination">
        <div class="pagination">
          <?php get_template_part('parts/pagenation', get_post_format()); ?>
        <div>
      </section>
    
      <section class="section_shoplist section_list">
        <header class="header_section header_section_shoplist">
          <h2>広ガスクーポン取扱い加盟店をさがす</h2>
        </header>
        <div class="content_section content_section_list content_section_shoplist">
          <?php
            //通常記事一覧
            if (have_posts()){
              while($wp_query->have_posts()){
                $wp_query->the_post(); 
                get_template_part('parts/list_shop_archive', get_post_format());
              }
            }else{
              echo '<article class="article_shop_shoplist"><h3 class="annotation_nopost">記事がありません</h3></article>';
            }
            wp_reset_postdata();
          ?>
        </div>
      </section>

      <section class="section_back">
        <a class="link_back" href="javascript:history.back();">前のページに戻る</a>
      </section>

      <section class="section_pagination">
        <?php get_template_part('parts/pagenation', get_post_format()); ?>
      </section>
    </div>

    <aside>
      <?php get_template_part('parts/aside', get_post_format()); ?>
    </aside>

  </div>
</section>

<?php get_footer(); ?>