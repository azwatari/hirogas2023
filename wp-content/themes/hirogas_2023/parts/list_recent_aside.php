<article class="article_shop_recent_aside article_list_aside">
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
      echo '<a class="img_shop img_shop_recent_aside img_list_archive img_list" href="'.get_the_permalink().'">';
      echo '<img class="img_round img_round_small" src="'.$taxPhtMin.'" alt="'.get_the_title().'" />';
      echo '</a>';
    }else{
      if($taxNopht){
        echo '<a class="img_shop img_shop_recent_aside img_list_archive img_list" href="'.get_the_permalink().'">';
        echo '<img class="img_round img_round_small" src="'.$taxNopht.'" alt="'.get_the_title().'" />';
        echo '</a>';
      }else{
        echo '<a class="img_shop img_shop_recent_aside img_list_archive has_nophoto" href="'.get_the_permalink().'">';
        echo '<span class="annotation_nophoto img_round_small img_round">画像無し</span>';
        echo '</a>';
      }
    };
    echo '<div class="box box_grid">';
    echo '<em class="title_shop title_shop_recent"><a href="'.get_the_permalink().'">'.get_the_title().'</a></em>';
    echo '<div class="body_shop body_shop_recent body_list">'.mb_strimwidth( strip_tags( get_the_content() ), 0, 60, '…', 'UTF-8' ).'</div>';
    echo '</div>';
  ?>
</article>
