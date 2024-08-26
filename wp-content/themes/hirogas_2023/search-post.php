<?php
/**
 * The main template file
 * @link http://codex.wordpress.org/Template_Hierarchy
 * @package WordPress
 * @subpackage hirogas_2023
 * @since watari 1.0
 */
get_header(); ?>
<?php
//検索キーワード取得
$serchword = get_search_query();
?>

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

      <?php 
        //https://sukigyu.net/filter-search/
        $s = $_GET['s'];
        
        if(isset($_GET['newsCat'])){
          $taxquerysp[] = array(
            'taxonomy'=> 'category',
            'terms'=> $_GET['newsCat'],
            'operator'=>'AND',
            'include_children'=>false
          );
          }else{
          $taxquerysp[] = '';
        }
        if(isset($_GET['newsGenre'])){
          $taxquerysp[] = array(
            'taxonomy'=> 'news_genre',
            'terms'=> $_GET['newsGenre'],
            'operator'=>'AND',
            'include_children'=>false
          );
        }else{
          $taxquerysp[] = '';
        }
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $search_args = array(
          'post_type'=>'post',
          's' => $s,
          'tax_query' => $taxquerysp,
          'paged' => $paged,
        );
        $wp_query = new WP_Query( $search_args );
      ?>
      <section class="section_pagination">
      <div class="pagination">
        <?php get_template_part('parts/pagenation', get_post_format()); ?>
        <div>
      </section>
    
      <section class="section_newslist">
        <header class="header_section header_section_newslist">
          <h2 class="title_header_section title_header_section_newslist">ニュース・キャンペーン情報</h2>
        </header>
        <div class="content_section content_section_newslist">

          <?php
            if($wp_query->have_posts()){
              while($wp_query->have_posts()){
                $wp_query->the_post();
                get_template_part( 'parts/list_news_archive', get_post_type() );
              }
            }else{
            echo '<article class="article_news_newslist"><h3 class="annotation_nopost">記事がありません</h3></article>';
            }
            /*簡単にすませるバージョン
           if(have_posts()){
            while(have_posts()){
              the_post();
              get_template_part( 'parts/list_news_archive', get_post_type() );
            }
           }else{
            echo '<article class="article_news_newslist"><h3 class="annotation_nopost">記事がありません</h3></article>';
           }
           */
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