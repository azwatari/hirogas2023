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
  /*
  //選択状態を維持できない
      $terms = get_terms('shop_area'); // タクソノミーの指定
      echo '<select name="shop_area" id="shop_area" class="postform">';
      echo '<option value="0" selected="selected">指定しない</option>';
      foreach ( $terms as $term ){
      if($term->parent){
          echo '<option class="level-0" value="'.$term->slug.'">' . $term->name . '</option>';
      }
    };
      echo '</select>';
      */
  ?>
  
  <?php

    $terms = get_terms('shop_area',array( 'orderby' => 'term_order','order' => 'ASC','hide_empty'  =>0 )); // タクソノミーの指定

    $post_type = 'shop_area';
    $shop_area_selected = get_query_var($post_type,0);

    echo '<select name="shop_area" id="shop_area" class="postform">';
    echo '<option value="0">ー全てー</option>';
    foreach ( $terms as $term ){
    if($term->parent){
        echo '<option class="level-0" value="'.$term->slug.'"';
        if($term->slug===$shop_area_selected){
          echo 'selected="selected"';
        }
        echo '>' . $term->name . '</option>';
    }
    };
    echo '</select>';




/*
    //セレクトボックス、かつ親タームは除外
    $shop_area_terms = get_terms('shop_area',array( 'orderby' => 'term_order','order' => 'ASC' )); //タクソノミー「勤務地」のターム取得
    //$shop_area_selected = array(); //前回の検索条件を保持するための配列
    $foo = 'shop_area';
    $shop_area_selected = get_query_var($foo,0);
    echo $shop_area_selected;
    ?>
    <select name="shop_area">
      <option value="">--全て--</option>
      <?php foreach($shop_area_terms as $shop_area_term){
        if($shop_area_term->parent){
          echo '<option value="'.$shop_area_term->slug.'" ';
          if($shop_area_selected){ //現時点の検索条件に selected="selected" を設定
            foreach($shop_area_selected as $value){
              if($value==$shop_area_term->slug){
                echo 'selected="selected"';
              }
            }
          }
          echo '>'.$shop_area_term->name.'</option>';
        }
      }
      */
      ?>
    </select>
  </div>
</label>

        <?php
          /*
          //チェックボックスならうまくいく
          //https://senoweb.jp/note/wp-checkbox-keep/
        $taxonomy_name = 'shop_area';
        $args = array('orderby' => 'description', 'hide_empty' => false);
        $taxonomys = get_terms($taxonomy_name, $args);


        if (!is_wp_error($taxonomys) && count($taxonomys)) {
          
          echo '<select name="shop_area" id="shop_area" class="postform">';
          echo '<option value="0" >指定しない</option>';
        foreach ($taxonomys as $taxonomy) {
        $tax_posts = get_posts(
        array(
        'post_type' => 'shop',
        'taxonomy' => $taxonomy_name,
        'term' => $taxonomy->slug
        )
        );
        if ($tax_posts) {
        if (!empty($_GET['post_tag'])) { //$_POSTではなく$_GET
        foreach ($_GET['post_tag'] as $value) {
        $search_cat[] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
        } 

        //チェックがついているタクソノミー（項目）にcheckedを付与するため
        $selected = '';
        if (in_array($taxonomy->slug, $search_cat, true)) {
        $selected = ' selected';

        };
          echo '<input type="checkbox" name="post_tag[]" value="<?php echo $taxonomy->slug; ?>" <?php echo esc_attr($checked); ?>>';
          echo '<span class="c-checkbox">';
          $taxonomy->name;
          echo '</span>';
        }
        }
        echo '</select>';
        }
        */
        ?>
        


<label>
  <span class="screen-reader-text">ジャンルで絞り込み</span>
  <span>ジャンル</span>
  <div>
    <?php
      $taxonomy = 'shop_genre'; //タクソノミーをスラッグで指定
      $selected = get_query_var($taxonomy,0);
      $args = array(
          'show_option_all' => 'ー全てー', //何も指定しない場合の表示
          'taxonomy'    => $taxonomy,
          'name'        => $taxonomy,
          'value_field' => 'slug',
          'orderby' => 'description',
          'hide_empty'  => 0, //投稿のないタームを非表示（表示は「0」）
          'selected'    => $selected,
      );
      wp_dropdown_categories($args);
    ?>
  </div>
</label>
  <label>
    <span>キーワード検索</span>
    <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'キーワード …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
  </label>


  <input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
</form>