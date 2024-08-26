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
      
      <section class="section_sitemap section_detail">
        <header class="header_section header_section_sitemap header_section_detail">
          <h2>サイトマップ</h2>
        </header>
        <div class="content_section content_section_sitemap">
          <article class="article_sitemap article_detail">

            <ul class="list_sitemap">
              <li class="link_footer_static"><a href="<?php bloginfo('url')?>">Topページ</a></li>
              <?php

                $args = array(
                  'public'   => true, // 真偽値。true のとき、公開された（public な）投稿タイプのみが返されます。
                );
                  
                $output = 'names'; // （文字列） （オプション） 戻り値の型を指定します。'names'（名前）または 'objects'（オブジェクト）。
                $operator = 'and'; //（文字列） （オプション） $args で複数の条件を指定する場合の演算子（'and' または 'or'）。
                $post_types = get_post_types( $args, $output, $operator ); 
                //「各種設定」ページのid取得
                $settings = get_page_by_path('settings');
                $settingsId = get_post( $settings );

                arsort( $post_types );
                foreach ( $post_types  as $post_type ) {
                  $object = get_post_type_object( $post_type );
                  $object_name = $object->name;
                  $object_url=$object->rewrite['slug'];
                  if( ($object_name != 'page') and ($object_name != 'attachment') and ($object_name != 'revision') and ($object_name != 'nav_menu_item')){
                    echo '<li class="link_footer_static"><a href="/'.$object_url.'">'.$object->label.'</a></li>';
                    if($object_name == 'shop'){//加盟店一覧ならエリアを表示
                      echo '<ul class="sublist_sitemap">';
                      $select_tax = 'shop_area';
                      $terms = get_terms($select_tax,['parent' => 0, 'hide_empty' => false, 'orderby' => 'description']);
                      foreach ( $terms as $term ) {
                        echo '<li><a href="'.get_term_link($term).'">'.esc_html($term->name).'</a></li>';
                        wp_reset_postdata();
                      }
                      echo '</ul>';
                    }elseif($object_name == 'post'){//ニュースならカテゴリを表示
                      echo '<ul class="sublist_sitemap">';
                      //$terms_news = get_terms('category');
                      $terms_news = get_terms('category',['hide_empty' => false, 'orderby' => 'description']);
                      foreach( $terms_news as $term_news ) {
                        echo '<li><a href="'.get_term_link($term_news).'">'.esc_html($term_news->name).'</a></li>';
                        wp_reset_postdata();
                      }
                      echo '</ul>';
                    }
                  }elseif($object_name=='page'){
                    $page_list = get_posts( 'numberposts=-1&order=ASC&orderby=date&post_type=page&exclude='.$settingsId->ID.'' ); // ページ情報の取得
                    foreach ( $page_list as $page_item ) {
                      echo '<li><a class="link_footer_static" href="'. get_page_link($page_item->ID).'">'.get_the_title($page_item->ID).'</a></li>'; // ページの情報を表示
                    }
                  }
                }

                //カスタム投稿、投稿、固定ページ別々
                /*
                $args = array(
                  'public'   => true,
                  '_builtin' => false,
                );
                $cp_types = get_post_types( $args, 'names', 'and' );

                if ( ! empty( $cp_types ) ) {
                  foreach ( $cp_types as $cp_name ) {
                    echo $cp_name;
                    $cp_data = get_post_type_object( $cp_name );
                    if ( $cp_data->has_archive == 1 ) {
                      $cp_url = get_post_type_archive_link( $cp_name );
                      echo '<li>';
                      echo '<a href="'.esc_url($cp_url).'">'.esc_html($cp_data->label).'</a>';
                      echo '</li>';
                    }
                  }
                }
                ?>
                <li><a class="link_footer_static" href="/news/">ニュース・キャンペーン情報</a></li>
                <?php // 固定ページ一覧を表示する
                  $page_list = get_posts( 'numberposts=-1&order=ASC&orderby=date&post_type=page&exclude=170,178' ); // ページ情報の取得
                  foreach ( $page_list as $page_item ) {
                    echo '<li><a class="link_footer_static" href="'. get_page_link($page_item->ID).'">'.get_the_title($page_item->ID).'</a></li>'; // ページの情報を表示
                  }
                */

              ?>
            </ul>
          </article>
        </div>
      </section>
    </div>

    <aside>
      <?php get_template_part('parts/aside', get_post_format()); ?>
    </aside>

  </div>
</section>


<?php get_footer(); ?>