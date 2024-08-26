
<article class="article_news_aside article_list_aside">
  <?php
    $taxTmb = get_field('news_thumbnail');
    //「各種設定」ページのid取得
    $settings = get_page_by_path('settings');
    $settingsId = get_post( $settings );
    //echo $settingsId->ID;     //IDを表示
    $taxNopht = get_field('nophoto',$settingsId->ID);

    echo '<a class="img_news img_news_aside img_list_archive img_list" href="'.get_the_permalink().'">';
    if($taxTmb){
      echo '<img class="img_round img_round_small" src="'.$taxTmb.'" alt="" />';
    }else{
      if($taxNopht){
        echo '<img class="img_round img_round_small" src="'.$taxNopht.'" alt="" />';
      }else{
        echo '<span class="img_round img_round_small annotation_nophoto">画像無し</span>';
      }
    }
    echo '</a>';
    echo '<a href="'.get_the_permalink().'">';
    echo '<em class="date_news date_news_aside">'.get_the_date().'</em>';
    echo '<div class="body_news body_news_aside body_list">'.mb_strimwidth( strip_tags( get_the_title() ), 0, 50, '…', 'UTF-8' ).'</div>';
    echo '</a>';
  ?>
</article>