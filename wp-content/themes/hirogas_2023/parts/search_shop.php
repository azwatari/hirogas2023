<?php
//検索キーワード取得
$serchword = get_search_query();
?>

<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<input type="hidden" name="post_type" value="shop">
  
  <label>
    <span class="screen-reader-text">エリアで絞り込み</span>
    <span>エリア詳細</span>
    <div>
      <?php
        //https://sukigyu.net/filter-search/
        $query_object_area = get_queried_object();
        echo '<select name="shopArea">';
        echo '<option value="0">ー全てー</option>';
        $taxonomys_area = get_terms( 'shop_area', array(
          'hide_empty' => '0',  //投稿がないタームも表示
          'orderby'=>'term_order',
          'order'=>'ASC',
          ) );
        if(!is_wp_error($taxonomys_area) && count($taxonomys_area)){
          foreach($taxonomys_area as $taxonomy_area){
            if($query_object_area -> term_id){
              $r_tax_area = $query_object_area -> term_id;
            }else{
              $r_tax_area = filter_input(INPUT_GET,"shopArea");
            }
            if($taxonomy_area->parent){
              $selected_area["shopArea"] = [ $taxonomy_area->term_id => "" ];
              $selected_area["shopArea"][$r_tax_area?:""]='selected="selected"';
              echo '<option value="'.$taxonomy_area->term_id.'"';
              echo $selected_area["shopArea"][$taxonomy_area->term_id].'>';
              echo $taxonomy_area->name.'</option>';
            }
          }
        }
        echo '</select>';
      ?>
    </div>
  </label>
  <label>
    <span class="screen-reader-text">ジャンルで絞り込み</span>
    <span>ジャンル</span>
    <div>
      <?php
        // タクソノミーページで表示させたいターム名
        echo '<select name="shopGenre">';
        echo '<option value="0">ー全てー</option>';
        $query_object = get_queried_object();
        $taxonomys = get_terms( 'shop_genre', array(
          'hide_empty' => '0',  //投稿がないタームも表示
          'orderby'=>'description',
          ) );
          if(!is_wp_error($taxonomys) && count($taxonomys)){
            foreach($taxonomys as $taxonomy){
              if($query_object -> term_id){
                $r_tax = $query_object -> term_id;
              }else{
                $r_tax = filter_input(INPUT_GET,"shopGenre");
              }
              $selected["shopGenre"] = [ $taxonomy->term_id => "" ];
              $selected["shopGenre"][$r_tax?:""]='selected="selected"';
              //echo $r_tax;
              echo '<option value="'.$taxonomy->term_id.'"';
              echo $selected["shopGenre"][$taxonomy->term_id];
              echo '>'.$taxonomy->name.'</option>';
            }
          }
        echo '</select>';
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