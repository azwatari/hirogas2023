<article class="article_shop_shoplist article_list">
  <?php
    $taxPhtMin = get_field('photo_main');
    $taxGnrs = get_the_terms(get_the_ID(), 'shop_genre');
    //$taxGnr = $taxGnrs[0];
    $taxAras = get_the_terms(get_the_ID(), 'shop_area');
    //「各種設定」ページのid取得
    $settings = get_page_by_path('settings');
    $settingsId = get_post( $settings );
    //echo $settingsId->ID;     //IDを表示
    $taxNopht = get_field('nophoto',$settingsId->ID);
    //$taxAra = $taxAras[0];

    echo '<h3 class="title_shop title_shop_shoplist title_list img_list_archive"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>';
    echo '<div class="inner">';
    echo '<a class="img_shop img_list img_shop_shoplist" href="'.get_the_permalink().'">';
    if($taxPhtMin){
      echo '<img class="img_round" src="'.$taxPhtMin.'" alt="'.get_the_title().'" />';
    }else{
      if($taxNopht){
        echo '<img class="img_round" src="'.$taxNopht.'" alt="" />';
      }else{
        echo '<span class="annotation_nophoto img_round">画像無し</span>';
      }
      
    }
    echo '</a>';
    echo '<div class="body_shop body_shop_pickup body_list">'.mb_strimwidth( strip_tags( get_the_content() ), 0, 264, '…', 'UTF-8' ).'</div>';
    echo '<div class="inner inner_content_footer inner_content_shopslist_footer">';
    echo '<div class="inner inner_content_genre">';
    if($taxGnrs){
      foreach ( $taxGnrs as $taxGnr ){
        //echo '<a href="'.get_term_link($taxGnr).'">';
        echo '<em class="genre_shop genre_shop_'.$taxGnr->slug.' genre_shop_shoplist">'.esc_html($taxGnr->name).'</em>';
        //echo '</a>';
      };
    }
    if($taxAras){
      foreach ( $taxAras as $taxAra ){
        if($taxAra->parent){
          //echo '<a href="'.get_term_link($taxAra).'">';
          echo '<em class="area_shop area_shop_'.$taxAra->slug.' area_shop_shoplist">'.esc_html($taxAra->name).'</em>';
          //echo '</a>';
        }
      }
    }
    echo '</div>';
    echo '<a class="link_show_detail" href="'.get_the_permalink().'">詳細はこちら</a>';
    echo '</div>';
    echo '</div>';
  ?>
</article>

