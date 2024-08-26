
<article class="article_news_newslist article_list">
  <?php
    $taxTmb = get_field('news_thumbnail');
    $taxGnrs = get_the_terms(get_the_ID(), 'news_genre');
    //$taxGnr = $taxGnrs[0];
    $taxCats = get_the_category(get_the_ID());
    $taxCat = get_the_category();
    $taxAras = get_the_terms(get_the_ID(), 'news_area',['parent'=>0,]);
    //「各種設定」ページのid取得
    $settings = get_page_by_path('settings');
    $settingsId = get_post( $settings );
    //echo $settingsId->ID;     //IDを表示
    $taxNopht = get_field('nophoto',$settingsId->ID);

    echo '<em class="date_news date_news_index">'.get_the_date().'</em>';
    echo '<h3 class="title_news title_news_newslist title_list img_list_archive"><a class="" href="'.get_the_permalink().'">'.get_the_title().'</a></h3>';
    echo '<div class="inner">';
    echo '<a class="img_news img_news_newslist img_list" href="'.get_the_permalink().'">';
    if($taxTmb){
      echo '<img class="img_round" src="'.$taxTmb.'" alt="" />';
    }else{
      if($taxNopht){
        echo '<img class="img_round" src="'.$taxNopht.'" alt="" />';
      }else{
        echo '<span class="img_round annotation_nophoto">画像無し</span>';
      }
    }
    echo '</a>';
    echo '<div class="body_news body_news_newslist body_list">'.mb_strimwidth( strip_tags( get_the_content() ), 0, 164, '…', 'UTF-8' ).'</div>';
    echo '<div class="inner inner_content_footer inner_content_newslist_footer">';
    echo '<div class="inner inner_content_genre">';
    if($taxGnrs){
      foreach ( $taxGnrs as $taxGnr ){
        //echo '<a href="'.get_term_link($taxGnr).'">';
        echo '<em class="genre_news genre_news_'.$taxGnr->slug.' genre_news_newslist">'.esc_html($taxGnr->name).'</em>';
        //echo '</a>';
      };
    }
    if($taxCats){
      foreach ( $taxCats as $taxCat ){
        //echo '<a href="'.get_category_link($taxCat[0]->term_id).'">';
      echo '<em class="cat_news  cat_news_newslist">'.$taxCat->name.'</em>';
      //echo '</a>';
      }
    }
    /*
    if($taxAras){
      foreach ( $taxAras as $taxAra ){
      //echo '<a href="'.get_term_link($taxAra).'">';
      if($taxAra->parent!=0){
        echo '<em class="area_news area_news_'.$taxAra->slug.' area_news_newslist">'.esc_html($taxAra->name).'</em>';
      }
      //echo '</a>';
      }
    }
    */
    echo '</div>';
    echo '<a class="link_show_detail" href="'.get_the_permalink().'">詳細はこちら</a>';
    echo '</div>';
    echo '</div>'
  ?>
</article>