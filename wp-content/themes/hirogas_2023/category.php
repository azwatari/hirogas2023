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

      <section class="section_search section_search_news">
        <header class="header_section header_section_searchnews">
          <h2 class="title_header_section title_header_section_searchnews">ニュースを探す</h2>
        </header>
        <div class="content_section content_section_search">
          <?php get_template_part('parts/search_news', get_post_format()); ?>
        </div>
      </section>
      
      <section class="section_pagination">
        <div class="pagination">
          <?php get_template_part('parts/pagenation', get_post_format()); ?>
        <div>
      </section>
      
      <section class="section_newslist section_list">
        <header class="header_section header_section_newslist header_section_list">
          <h2>ニュース・キャンペーン情報</h2>
        </header>
        <div class="content_section content_section_list content_section_newslist">
          <?php
            //https://hacknote.jp/archives/40057/
            //WordPress : カテゴリーアーカイブページでカテゴリースラッグを確実に取得する
            $category_slug = get_query_var('category_name');
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $main_posts = new WP_Query(array(
              'post_type' => 'post',
              'taxonomy'=>'category',
              'term'=>$category_slug,
              'paged' => $paged,
              'posts_per_page' => 2,
            ));
            if ($main_posts->have_posts()){
              while($main_posts->have_posts()){
                $main_posts->the_post(); 
                get_template_part('parts/list_news_archive', get_post_format());
              }
            }else{
              echo '<article class="article_news_newslist"><h3 class="annotation_nopost">記事がありません</h3></article>';
            }
            wp_reset_postdata();
          ?>
        </div>
      </section>

      <section class="section_back">
        <a class="link_back" href="javascript:history.back();">前のページに戻る</a>
      </section>

      <section class="section_pagination">
        <div class="pagination">
          <?php get_template_part('parts/pagenation', get_post_format()); ?>
        <div>
      </section>

    </div>
    <aside>
      <?php get_template_part('parts/aside', get_post_format()); ?>
    </aside>

  </div>
</section>
<?php get_footer(); ?>