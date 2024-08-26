<?php
//検索キーワード取得
$serchword = get_search_query();
?>
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<input type="hidden" name="post_type" value="post">
  <label>
    <span class="screen-reader-text">カテゴリで絞り込み</span>
    <span>カテゴリ</span>
    <div>
      <?php
        echo '<select name="newsCat">';
        echo '<option value="0">ー全てー</option>';
        $exclude_cat = get_category_by_slug( 'uncategorized' )->cat_ID;
        $taxonomys_cat = get_terms('category',array(
          'hide_empty'  => 0, //投稿のないタームを非表示（表示は「0」）
          'exclude'  => $exclude_cat,
          'orderby' => 'description',
        ));
        if(!is_wp_error($taxonomys_cat) && count($taxonomys_cat)){
          foreach($taxonomys_cat as $taxonomy_cat){
            $r_tax_cat = filter_input(INPUT_GET,"newsCat");
            $selected_cat["newsCat"] = [ $taxonomy_cat->term_id => "" ];
            $selected_cat["newsCat"][$r_tax_cat?:""]='selected="selected"';
            //echo $r_tax;
            echo '<option value="'.$taxonomy_cat->term_id.'"';
            echo $selected_cat["newsCat"][$taxonomy_cat->term_id];
            echo '>'.$taxonomy_cat->name.'</option>';
          }
        }
        echo '</select>';
      ?>

      <?php 
      /*
      $exclude_cat = get_category_by_slug( 'uncategorized' )->cat_ID;
        $cats = array(
          'show_option_all' => '--全て--', //何も指定しない場合の表示
          'hide_empty'  => 0, //投稿のないタームを非表示（表示は「0」）
          'exclude'  => $exclude_cat,
        );
        wp_dropdown_categories($cats);
        */
      ?>
    </div>
  </label>
  
  <label>
    <span class="screen-reader-text">ジャンルで絞り込み</span>
    <span>ジャンル</span>
    <div>
      <?php
        //https://sukigyu.net/filter-search/
        
        $query_object_area = get_queried_object();
        echo '<select name="newsGenre">';
        echo '<option value="0">ー全てー</option>';
        $taxonomys_area = get_terms( 'news_genre', array(
          'hide_empty' => '0',  //投稿がないタームも表示
          'orderby'=>'term_order',
          'order'=>'ASC',
          ) );
        if(!is_wp_error($taxonomys_area) && count($taxonomys_area)){
          foreach($taxonomys_area as $taxonomy_area){
            $r_tax_area = filter_input(INPUT_GET,"newsGenre");
            $selected_area["newsGenre"] = [ $taxonomy_area->term_id => "" ];
            $selected_area["newsGenre"][$r_tax_area?:""]='selected="selected"';
            echo '<option value="'.$taxonomy_area->term_id.'"';
            echo $selected_area["newsGenre"][$taxonomy_area->term_id].'>';
            echo $taxonomy_area->name.'</option>';
          }
        }
        echo '</select>';
      ?>

      <?php
      /*
        $taxonomy = 'news_genre'; //タクソノミーをスラッグで指定
        $selected = get_query_var($taxonomy,0);
        $args = array(
            'show_option_all' => '--全て--', //何も指定しない場合の表示
            'taxonomy'    => $taxonomy,
            'name'        => $taxonomy,
            'value_field' => 'slug',
            'hide_empty'  => 0, //投稿のないタームを非表示（表示は「0」）
            'selected'    => $selected,
            'orderby' => 'description',
        );
        wp_dropdown_categories($args);
        */
      ?>
    </div>
  </label>

  <label>
    <span>キーワード検索</span>
    <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'キーワード …', 'placeholder' ) ?>" value="<?php echo esc_html( get_search_query() ); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" /><span></span>
  </label>

  <input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
</form>