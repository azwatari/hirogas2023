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


<section class="section_main section_main_index">
  <div class="wrapper_global">
    <section class="section_areamap_index">
      <header class="header_section header_section_areamap">
        <h2 class="title_header_section title_header_section_areamap title_header_index">加盟店をさがす</h2>
      </header>
      <div class="content_section content_section_areamap">
        <?php get_template_part('parts/areamap', get_post_format()); ?>
      </div>
      <footer class="footer_section footer_section_areamap">
        <a class="link_show_list" href="/shop/">加盟店一覧を見る</a>
      </footer>
    </section>

    <?php
      $settings = get_page_by_path('settings');
      $settingsId = get_post( $settings );
      $taxProd = get_field('new_shop_period',$settingsId->ID);
      $taxProd_nmbr = $taxProd['period_number'];
      $taxProd_unt = $taxProd['period_unit'];
      
      if($taxProd_nmbr > 0){
        $dtQery = array(
          array(
              'after'     => date("Y-m-d" ,strtotime("-$taxProd_nmbr $taxProd_unt")),
              'before'    => date("Y-m-d"),
              'inclusive' => true,
          ),
        );
      }elseif($taxProd_nmbr ==='0'){
        $dtQery = array(
        );
      }
        
      $recent_args = array(
        'post_type' => 'shop', //①カスタム投稿名 (通常の「投稿」はpost)
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => 4, //表示数を指定
        'date_query' => $dtQery,
      );

      if($taxProd_nmbr || $taxProd_nmbr ==='0'){
      $recent_query = new WP_Query( $recent_args );
      if ( $recent_query->have_posts() ) :
    ?>
      <section class="section_recent_index">
        <header class="header_section header_section_recent">
          <h2 class="title_header_section title_header_section_recent title_header_index">新しい加盟店</h2>
        </header>
        <div class="content_section content_section_recent">
          <?php
            while ( $recent_query->have_posts() ) {
              $recent_query->the_post(); 
                get_template_part('parts/list_pickup', get_post_format());
            }
          ?>
        </div>
      </section>
      <?php
        endif;
        wp_reset_postdata();
      }
    ?>

    <section class="section_pickup_index">
      <header class="header_section header_section_pickup">
        <h2 class="title_header_section title_header_section_pickup title_header_index">ピックアップ</h2>
      </header>
      <div class="content_section content_section_pickup">
        <?php
          $args = array(
            'post_type' => 'shop', //①カスタム投稿名 (通常の「投稿」はpost)
            'orderby' => 'rand',
            'posts_per_page' => 8, //表示数を指定
          );

          $custom_query = new WP_Query( $args );
          if ( $custom_query->have_posts() ) {
            while ( $custom_query->have_posts() ) {
              $custom_query->the_post(); 
                get_template_part('parts/list_pickup', get_post_format());
            }
          }else{
            echo '<article class="article_shop_pickup nopost"><h4 class="annotation_nopost">記事がありません</h4></article>';
          }
          wp_reset_postdata();
        ?>
      </div>
    </section>

    <section class="section_news_index">
      <header class="header_section header_section_news">
        <h2 class="title_header_section title_header_section_news title_header_index">ニュース・キャンペーン情報</h2>
      </header>
      <div class="content_section content_section_news">
        <?php
          //通常記事一覧
          $main_posts = new WP_Query(array(
            'post_type' => 'post',
            'posts_per_page' => 3,
          ));
          if ($main_posts->have_posts()){
            while($main_posts->have_posts()){
              $main_posts->the_post(); 
              get_template_part('parts/list_news_index', get_post_format());
            }
          }
          else{
            echo '<article class="article_news_index nopost"><h4 class="annotation_nopost">記事がありません</h4></article>';
          }
          wp_reset_postdata();
        ?>
      </div>

      <footer class="footer_section footer_section_news">
        <a class="link_show_list" href="/news/">一覧を見る</a>
      </footer>
    </section>

    <section class="section_signin_index">
      <?php
        //「各種設定」ページのid取得
        $settings = get_page_by_path('settings');
        $settingsId = get_post( $settings );
        $taxRgst1 = get_field( 'member_regist_images', $settingsId->ID )['member_regist_top']; 
        $taxRgstUrl = get_field( 'member_regist_images', $settingsId->ID )['member_regist_url']; 
        if($taxRgstUrl){
          if($taxRgst1){
            echo '<a class="link_signin link_signin_index" href="'.$taxRgstUrl.'" target="_blank"><img src="'.$taxRgst1.'" alt="広島ガスWeb会員サイト。会員登録をするともれなく200ポイントプレゼント。無料会員登録はこちら" /></a>';
          }else{
            echo '<a class="link_signin link_signin_index nophoto" href="'.$taxRgstUrl.'" target="_blank"><strong>広島ガスWeb会員サイトへ。</strong>会員登録をするともれなく200ポイントプレゼント。無料会員登録はこちら ＞</a>';
          }
        }
      ?>
    </section>
  </div>
</section>

<?php get_footer(); ?>