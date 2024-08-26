<?php
  $taxGnrs = get_the_terms(get_the_ID(), 'news_genre');
  $taxGnr = $taxGnrs[0];
  $taxCat = get_the_category();
  $taxSrc = get_field('news_search');
  $taxGrpMin = get_field('news_group_main');
  $taxGrpMin_com = nl2br($taxGrpMin['news_comment_main']);
  $taxGrpMin_pht = $taxGrpMin['news_photo_main'];
  $taxGrpSb = get_field('news_group_sub');
  $taxGrpSb_com = nl2br($taxGrpSb['news_comment_sub']);
  $taxGrpSb_pht = $taxGrpSb['news_photo_sub'];
  $taxGrpLft = get_field('news_group_left');
  $taxGrpLft_com = nl2br($taxGrpLft['news_comment_left']);
  $taxGrpLft_pht = $taxGrpLft['news_photo_left'];
  $taxGrpRit = get_field('news_group_right');
  $taxGrpRit_com = nl2br($taxGrpRit['news_comment_right']);
  $taxGrpRit_pht = $taxGrpRit['news_photo_right'];
  $taxAntn = get_field('news_annotation');
  $taxAntn_ttl = $taxAntn['news_annotation_title'];
  $taxAntn_bdy = $taxAntn['news_annotation_body'];
  $taxEtn = get_field('news_external');
  $taxEtn_ttl = $taxEtn['news_external_site'];
  $taxEtn_url = $taxEtn['news_external_url'];
  ?>

<header class="header_section header_section_detail header_section_newsdetail">
  <?php
  $taxCat = get_the_category();
  ?>
  <h2><?php echo $taxCat[0]->name; ?></h2>
</header>
<div class="content_section content_section_newsdetail content_section_detail">
  <article class="article_news_newsdetail article_detail">
    
    <?php
      echo '<div class="genres_news genres_detail">';
      if($taxGnr){
        //echo '<a href="'.get_term_link($taxGnr).'">';
        foreach ( $taxGnrs as $taxGnr ){
          echo '<em class="genre_news genre_news_'.$taxGnr->slug.' genre_news_shopdetail">'.esc_html($taxGnr->name).'</em>';
        };
        //echo '</a>';
      }
      echo '</div>';
      echo '<em class="date_news date_news_index">'.get_the_date().'</em>';
      echo '<h3 class="title_news title_news_newslist title_list">'.get_the_title().'</h3>';
      echo '<div class="inner inner_newsdetail inner_newsdetail_content inner_detail">';
      //echo '<a href="'.get_category_link($taxCat[0]->term_id).'">';
      //echo '<em class="cat_news  cat_news_newslist">'.$taxCat[0]->name.'</em>';
      //echo '</a>';

      echo '<div class="body_news body_news_single body_single">'.get_the_content().'</div>';

      if($taxGrpMin_pht){
        echo '<div class="mainphoto_news additional_photo_news photo_single ">';
        echo '<div class="box_photo_single box_mainphoto">';
        echo '<img class="img_mainphoto img_photo_single" src="'.$taxGrpMin_pht.'" />';
        echo '</div>';
        if($taxGrpMin_com){
          echo '<div class="box_txt box_maintxt box_txt_single">';
          echo $taxGrpMin_com;
          echo '</div>';
        }
        echo '</div>';
      }
      if($taxGrpSb_pht){
        echo '<div class="subphoto_news additional_photo_news photo_single">';
        echo '<div class="box_photo_single box_subphoto">';
        echo '<img class="img_subphoto img_photo_single" src="'.$taxGrpSb_pht.'" />';
        echo '</div>';
        if($taxGrpSb_com){
          echo '<div class="box_txt box_subtxt box_txt_single">';
          echo $taxGrpSb_com;
          echo '</div>';
        }
        echo '</div>';
      }
      if($taxGrpLft_pht || $taxGrpRit_pht){
        if($taxGrpLft_pht && $taxGrpRit_pht){
          echo '<div class="sub2photo_news additional_photo_news photo_single sub2_news">';
        }else{
          echo '<div class="sub2photo_news additional_photo_news photo_single sub2_news nogrid">';
        }
        if($taxGrpLft_pht){
          echo '<div class="box_photo_single box_sub2photo box_photo_left">';
          echo '<img class="img_sub2photo img_photo_single" src="'.$taxGrpLft_pht.'" />';
          echo '</div>';
          if($taxGrpLft_com){
            echo '<div class="box_txt box_sub2txt  box_txt_left box_txt_single">';
            echo$taxGrpLft_com;
            echo '</div>';
          }
        }
        if($taxGrpRit_pht){
          echo '<div class="box_photo_single box_sub2photo box_photo_right">';
          echo '<img class="img_sub2photo img_photo_single" src="'.$taxGrpRit_pht.'" />';
          echo '</div>';
          if($taxGrpRit_com){
            echo '<div class="box_txt box_sub2txt  box_txt_right box_txt_single">';
            echo$taxGrpRit_com;
            echo '</div>';
          }
        }
        echo '</div>';
      }
      
      if($taxAntn || $taxEtn){
        echo '<div class="annotation_news">';
        if($taxAntn_ttl){
          echo '<h4>'.$taxAntn_ttl.'</h4>';
        }
        if($taxAntn_bdy){
          echo '<p>'.$taxAntn_bdy.'</p>';
        }
        if($taxEtn_ttl && $taxEtn_url){
          echo '<a class="link_external link_external_news" href="'.$taxEtn_url.'" target="_blanlk">'.$taxEtn_ttl.'</a>';
        }elseif($taxEtn_url && !$taxEtn_ttl){
          echo '<a class="link_external link_external_news" href="'.$taxEtn_url.'" target="_blanlk">'.$taxEtn_url.'</a>';
        }
        echo '</div>';
      }

      if($taxSrc){?>
        <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
          <input type="hidden" name="post_type" value="shop">
          <label>
            <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
            <input type="hidden" class="search-field" placeholder="<?php echo esc_attr_x( 'キーワード …', 'placeholder' ) ?>" value="<?php echo $taxSrc ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
          </label>
          <button type="submit" class="link_show_detail link_news_show_detail" value="<?php echo $taxSrc; ?>"><?php echo $taxSrc; ?> 店舗一覧を見る</button>
        </form>
      <?php  
      }
      echo '</div>'
      ?>
  </article>
</div>