<!--<aside>-->
  <?php
    $settings = get_page_by_path('settings');
    $settingsId = get_post( $settings );
    $taxRgst2 = get_field( 'member_regist_images', $settingsId->ID )['member_regist_aside']; 
    $taxRgstUrl = get_field( 'member_regist_images', $settingsId->ID )['member_regist_url']; 
    $taxRgstSmry = get_field( 'member_regist_images', $settingsId->ID )['member_regist_summary']; 
    if($taxRgstUrl){
      echo '<section class="section_signin_aside">';
      if($taxRgst2){
        echo '<a class="link_signin link_signin_aside" href="'.$taxRgstUrl.'" target="_blank"><img src="'.$taxRgst2.'" alt="広島ガスWeb会員サイト。';
        if($taxRgstSmry){
          echo $taxRgstSmry;
        }
        echo '" /></a>';
      }else{
        echo '<a class="link_signin link_signin_aside nophoto" href="'.$taxRgstUrl.'" target="_blank"><strong>広島ガスWeb会員サイトへ。';
        if($taxRgstSmry){
          echo '</strong>'.$taxRgstSmry.' ＞';
        }
        echo '</a>';
      }
      echo '</section>';
    }
  ?>
  <section class="section_area_aside">
    <header class="header_section header_section_area_aside">
      <h2 class="title_header_section title_header_section_area_aside">エリア</h2>
    </header>
    <div class="content_section content_section_area_aside">
      <ul class="link_list_area_aside">
        <?php
          //https://akonomunon.hatenablog.com/entry/2015/08/19/144936
          //【Wordpress】カスタムタクソノミーを階層表示させるには
          //↑のサイトを参考
          $select_tax = 'shop_area';
          $terms = get_terms($select_tax,['parent' => 0, 'hide_empty' => false, 'orderby' => 'description']);
          foreach ( $terms as $term ) {
            echo '<li><a class="link_map_areamap link_map_areamap_'.$term->slug.'" href="'.get_term_link($term).'">'.esc_html($term->name).'</a></li>';
            wp_reset_postdata();
          }
        ?>
      </ul>
    </div>
  </section>
  
  <!--
  <section class="section_recent_aside section_list_aside">
    <header class="header_section header_section_recent_aside">
      <h2 class="title_header_section title_header_section_recent_aside">新しい加盟店</h2>
    </header>
    <div class="content_section content_section_recent_aside">
      <?php
        /*
        $recent_args = array(
          'post_type' => 'shop', //①カスタム投稿名 (通常の「投稿」はpost)
          'orderby' => 'date',
          'order' => 'DESC',
          'posts_per_page' => 10, //表示数を指定
          'date_query' => array(
            array(
                'after'     => date("Y-m-d", strtotime("-1 month")),
                'before'    => date("Y-m-d"),
                'inclusive' => true,
            ),
        ),
        );
        $recent_query = new WP_Query( $recent_args );
        if ( $recent_query->have_posts() ) {
          while ( $recent_query->have_posts() ) {
            $recent_query->the_post(); 
              get_template_part('parts/list_recent_aside', get_post_format());
          }
        }
        wp_reset_postdata();
        */
      ?>
    </div>
  </section>
      -->

  <section class="section_news_aside section_list_aside">
    <header class="header_section header_section_news_aside">
      <h2 class="title_header_section title_header_section_news_aside"><span>ニュース・</span><span>キャンペーン</span><span>情報</span></h2>
    </header>
    <div class="content_section content_section_news_aside">
      <?php
        //通常記事一覧
        $main_posts = new WP_Query(array(
          'post_type' => 'post',
          'posts_per_page' => 3,
        ));
        if ($main_posts->have_posts()){
          while($main_posts->have_posts()){
            $main_posts->the_post(); 
            get_template_part('parts/list_news_aside', get_post_format());
          }
        }
        else{
          echo '<article class="article_news_aside"><h4>記事がありません</h4></article>';
        }
      ?>
    </div>
  </section>
<!--</aside>-->