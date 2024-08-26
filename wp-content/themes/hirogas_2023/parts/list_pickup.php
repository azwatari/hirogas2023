<article class="article_shop_pickup">
  <?php
    $taxPhtMin=get_field('photo_main');
    $taxGnrs = get_the_terms(get_the_ID(), 'shop_genre');
    //「各種設定」ページのid取得
    $settings = get_page_by_path('settings');
    $settingsId = get_post( $settings );
    //echo $settingsId->ID;     //IDを表示
    $taxNopht = get_field('nophoto',$settingsId->ID);
    //$taxGnr = $taxGnrs[0];

    if($taxPhtMin){
          echo '<a class="img_shop img_shop_pickup img_list_archive" href="'.get_the_permalink().'">';
          echo '<img class="img_round" src="'.$taxPhtMin.'" alt="'.get_the_title().'" />';
          echo '</a>';
    }else{
      if($taxNopht){
        echo '<a class="img_shop img_shop_pickup img_list_archive" href="'.get_the_permalink().'">';
        echo '<img class="img_round" src="'.$taxNopht.'" alt="'.get_the_title().'" />';
        echo '</a>';
      }else{
        echo '<a class="img_shop img_shop_pickup img_list_archive has_nophoto img_round" href="'.get_the_permalink().'">';
        echo '<span class="annotation_nophoto">画像無し</span>';
        echo '</a>';
      }
    };
    if($taxGnrs){
      echo '<div class="genres_pickup">';
      foreach ( $taxGnrs as $taxGnr ){
        echo '<em class="genre_shop genre_shop_'.$taxGnr->slug.' genre_shop_pickup">';
      //echo '<a href="'.get_term_link($taxGnr).'">'.esc_html($taxGnr->name).'</a>';
      echo esc_html($taxGnr->name);
      echo '</em>';
      }
      echo '</div>';
    }else{
      echo '<div class="genres_pickup">';
      echo '<em class="genre_shop genre_shop_blank genre_shop_pickup">';
      echo '　　';
      echo '</em>';
      echo '</div>';
    }
    echo '<h3 class="title_shop title_shop_pickup"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>';
    echo '<div class="body_shop body_shop_pickup body_list">'.mb_strimwidth( strip_tags( get_the_content() ), 0, 72, '…', 'UTF-8' ).'</div>';
  ?>
</article>