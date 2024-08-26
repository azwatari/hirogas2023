<?php
//検索キーワード取得
$serchword = get_search_query();
?>

<nav class="nav_pagination">
  <div class="hit_number">
    
  <?php
    if(is_category()){
      $tax = get_taxonomy('category');
      $post_type = $tax->object_type[0];
    }elseif(is_tax()){
      $term = get_query_var('taxonomy');
      $tax = get_taxonomy( $term );
      $post_type = $tax->object_type[0];
    }elseif(is_archive()){
      $post_type = get_query_var( 'post_type' );
    }
    
    //shopエリア
    $terms_shop_area = get_terms('shop_area',array( 'orderby' => 'term_order','order' => 'ASC','hide_empty'  =>0 )); // タクソノミーの指定
    $foo_shop_area = 'shop_area';
    $shop_area_selected = get_query_var($foo_shop_area,0);
    //shopジャンル
    $terms_shop_genre = get_terms('shop_genre',array( 'orderby' => 'term_order','order' => 'ASC','hide_empty'  =>0 )); // タクソノミーの指定
    $foo_shop_genre = 'shop_genre';
    $shop_genre_selected = get_query_var($foo_shop_genre,0);
    //echo $post_type;
    
    //ニュースカテゴリ
    $terms_news_cat = get_categories('news_genre',array( 'orderby' => 'term_order','order' => 'ASC','hide_empty'  =>0 )); // タクソノミーの指定
    $news_cat_selected = get_query_var('category_name');
    //ニュースジャンル
    $terms_news_genre = get_terms('news_genre',array( 'orderby' => 'term_order','order' => 'ASC','hide_empty'  =>0 )); // タクソノミーの指定
    $foo_news_genre = 'news_genre';
    $news_genre_selected = get_query_var($foo_news_genre,0);
  
    //検索ワード
    $terms_word = get_search_query();

    //何かが選択されていたら
    if($shop_area_selected || $shop_genre_selected || $news_cat_selected || $news_genre_selected || $terms_word){
      echo '<span class="genre_pagination">';
      //shop
      if($post_type == 'shop'){
        //shopエリア
        foreach ( $terms_shop_area as $term_shop_area ){
          if($term_shop_area->slug===$shop_area_selected){
            echo '<span>';
            echo $term_shop_area->name;
            echo '</span>';
          }
        };
        //shopジャンル
        foreach ( $terms_shop_genre as $term_shop_genre ){
          if($term_shop_genre->slug===$shop_genre_selected){
            echo '<span>';
            echo $term_shop_genre->name;
            echo '</span>';
          }
        };
      }
      //news
      if($post_type == 'post'){
        //newsカテゴリ
        foreach ( $terms_news_cat as $term_news_cat ){
          if($term_news_cat->slug===$news_cat_selected){
            echo '<span>';
            echo $term_news_cat->name;
            echo '</span>';
          }
        };
        //newsジャンル
        foreach ( $terms_news_genre as $term_news_genre ){
          if($term_news_genre->slug===$news_genre_selected){
            echo '<span>';
            echo $term_news_genre->name;
            echo '</span>';
          }
        };
      }
      echo '<span>'.get_search_query().'</span>';
      echo '</span>';
    };
  ?>
  <span class="shop_number_pagination">
    該当
    <?php	//加盟店数
      echo $wp_query->found_posts;
    ?>件
  </span>
</div>

  <?php
    if($wp_query->found_posts >2){
      echo '<div class="list_pagination">';
      echo paginate_links( array ( 
        'prev_text' => '«',
        'next_text' => '»',
        'mid_size' => '2'
      ));
      echo '</div>';
    }
    ?>
</nav>