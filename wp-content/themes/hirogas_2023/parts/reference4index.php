

<section class="section_guide">

<strong class="strong_type">
	<a href="<?php echo get_post_type_archive_link( 'post' ); ?>">通常記事一覧</a>
	<a href="/news/">通常記事一覧</a>
</strong>
	<div class="a_category">
		<?php
		//通常記事一覧
			$main_posts = new WP_Query(array(
				'post_type' => 'post',
				'posts_per_page' => -1,
			));
			if ($main_posts->have_posts()){
				while(have_posts()){
					the_post();
					get_template_part('parts/content_list', get_post_format());
				}
			}
			else{
				get_template_part( 'parts/content_list', 'none' );
				echo 'no-post';
			}
			?>
	</div>
</section>


<section class="section_guide">
	<strong class="strong_type"><a href="<?php echo get_post_type_archive_link( 'shop' ); ?>">ショップリスト</a></strong>
	<?php //if(post_type_exists('hosp_guide')) ://if3
	//広島の医院病院ガイドの投稿タイプ
			echo '<h1 class="main_title portfolio_main_title">ピックアップ</h1>';
	?>
	<div class="a_category">
		<?php
			$args = array(
				'post_type' => 'shop', //①カスタム投稿名 (通常の「投稿」はpost)
				//'taxonomy' => $select_tax, //②タクソノミー名を指定 (通常の「投稿」はcategory)
				//'field' => 'slug',   //'term_id'、'slug'など、次の term を指定するフィールド名を指定
				//'term' => $term->slug,  //③タームを指定
				//'terms' => array('test','test2'), &nbsp;//③タームを指定 (複数の場合)
				'orderby' => 'rand',
				'posts_per_page' => -1, //表示数を指定
			);

			$custom_query = new WP_Query( $args );
			if ( $custom_query->have_posts() ) {
				while ( $custom_query->have_posts() ) {
					$custom_query->the_post(); 
					get_template_part('parts/content_list', get_post_format());
				}
			}
			wp_reset_postdata();
		?>
	</div>
</section>






<section class="section_pickup_index">
          <header class="header_section header_section_pickup">
            <h2 class="title_header_section title_header_section_pickup title_header_index">ピックアップ</h2>
          </header>
          <div class="content_section content_section_pickup">
              <?php
                $args = array(
                  'post_type' => 'shop', //①カスタム投稿名 (通常の「投稿」はpost)
                  //'taxonomy' => $select_tax, //②タクソノミー名を指定 (通常の「投稿」はcategory)
                  //'field' => 'slug',   //'term_id'、'slug'など、次の term を指定するフィールド名を指定
                  //'term' => $term->slug,  //③タームを指定
                  //'terms' => array('test','test2'), &nbsp;//③タームを指定 (複数の場合)
                  //'meta_key' => 'invisible',
                  //'meta_value' => 'visible',
                  'orderby' => 'rand',
                  'posts_per_page' => 8, //表示数を指定
                );
                
                //上位コーナー？通常と上位コーナーのみ表示
                /*
                $args = Array(
                  'post_type' => 'shop',      // 投稿
                  'post_status' => 'publish', // 公開された投稿、または固定ページを表示(デフォルト)
                  'posts_per_page' => 8,     // 表示する投稿数(-1を指定すると全投稿を表示)
                  'meta_key' => 'display_classification',        // カスタムフィールドのキーを指定
                  'meta_value' => array('onlyhigher','excludehigher'),    // カスタムフィールドの値を指定
                  'orderby' => 'rand',  // ソートする基準となる項目を指定
              );
              */

                $custom_query = new WP_Query( $args );
                if ( $custom_query->have_posts() ) {
                  while ( $custom_query->have_posts() ) {
                    $custom_query->the_post(); 
                    //if($taxDsply == 'excludehigher'){
                      get_template_part('parts/list_pickup', get_post_format());
                    //}
                  }
                }
                wp_reset_postdata();
              ?>
          </div>
        </section>


<section class="section_guide">
<?php
//echo do_shortcode('[ivory-search id="73" title="Custom Search Form"]');
get_template_part('parts/search_shop', get_post_format());
?>
</section>

<section class="section_guide">
	<strong class="strong_type">親ごとに囲った子ターム一覧</strong>
  <div class="categories">
  <?php
  //https://akonomunon.hatenablog.com/entry/2015/08/19/144936
  //【Wordpress】カスタムタクソノミーを階層表示させるには
  //↑のサイトを参考
	$select_tax = 'shop_area';
  $terms = get_terms($select_tax,['parent' => 0]);
  foreach ( $terms as $term ) {
		echo '<div class="a_category">';
    echo '<h3 class="category_name"><a href="'.get_term_link($term).'">'.esc_html($term->name).'</a></h3>';

    $children = get_terms('shop_area','hierarchical=0&parent='.$term->term_id);
    if($children){//子があるなら
      $parentId = $term->term_id;
      $childargs = array(
        'parent' => $parentId,
        'hide_empty' => false//投稿がない場合も隠さずにだす
      );
    $childterms = get_terms($select_tax,$childargs);
      foreach ($childterms as $childterm) {
        $targetSlug = $childterm->slug;
        echo '<div class="a_category">';
        echo '<h4><a href="'.get_term_link($childterm).'">'.$childterm->name.'</a></h4>';//子タームの名前
        /*
        //子ターム情報が取得できたので、ここからget_posts用に準備
        $postargs = array(
            'post_type' => 'shop',//さっきのbrandsタクソノミーを使ってる“投稿”のポストタイプ
            'tax_query' => array(
                array(
                    'taxonomy' => $select_tax,
                    'field' => 'slug',//フィールドをslugにしておくterm_idとかでも良いはず
                    'terms' => $targetSlug//上で準備してある$childterm->slug
                )
            )
        );
        //あとはいつも通り取得
        $postslist = get_posts( $postargs );
        foreach ( $postslist as $post ) {
					 setup_postdata( $post );
        get_template_part('parts/content_list', get_post_format());
				}
        wp_reset_postdata();
				*/
        echo '</div>';
    }}else{
      $args = array(
        'parent' => $parentId,
        'post_type' => 'shop', //①カスタム投稿名 (通常の「投稿」はpost)
        'taxonomy' => $select_tax, //②タクソノミー名を指定 (通常の「投稿」はcategory)
        'field' => 'slug',   //'term_id'、'slug'など、次の term を指定するフィールド名を指定
        'term' => $term->slug,  //③タームを指定
        //'terms' => array('test','test2'), &nbsp;//③タームを指定 (複数の場合)
        'posts_per_page' => -1, //表示数を指定
      );
      $custom_query = new WP_Query( $args );
      if ( $custom_query->have_posts() ) {
        while ( $custom_query->have_posts() ) {
            $custom_query->the_post(); 
			 get_template_part('parts/content_list', get_post_format()); 
        }
      }
    }
		wp_reset_postdata();
    echo '</div>';
  }
  ?>
  </div>
</section>









<section class="section_guide">
	<strong class="strong_type">子がなければ直接記事一覧、子があれば子ごとにまとめて記事一覧</strong>
  <div class="categories">
  <?php
  //https://akonomunon.hatenablog.com/entry/2015/08/19/144936
  //【Wordpress】カスタムタクソノミーを階層表示させるには
  //↑のサイトを参考
	$select_tax = 'shop_area';
  $terms = get_terms($select_tax,['parent' => 0]);
  foreach ( $terms as $term ) {
		echo '<div class="a_category">';
    echo '<h2 class="category_name"><a href="'.get_term_link($term).'">'.esc_html($term->name).'</a></h2>';

    $children = get_terms('shop_area','hierarchical=0&parent='.$term->term_id);
    if($children){//子があるなら
     
      $parentId = $term->term_id;
      $childargs = array(
        'parent' => $parentId,
        'hide_empty' => false//投稿がない場合も隠さずにだす
      );
    $childterms = get_terms($select_tax,$childargs);
      foreach ($childterms as $childterm) {
        $targetSlug = $childterm->slug;
        echo '<div class="a_category">';
        echo "<h3>$childterm->name</h3>";//子タームの名前
        
        //子ターム情報が取得できたので、ここからget_posts用に準備
        $postargs = array(
            'post_type' => 'shop',//さっきのbrandsタクソノミーを使ってる“投稿”のポストタイプ
            'tax_query' => array(
                array(
                    'taxonomy' => $select_tax,
                    'field' => 'slug',//フィールドをslugにしておくterm_idとかでも良いはず
                    'terms' => $targetSlug//上で準備してある$childterm->slug
                )
            )
        );
        //あとはいつも通り取得
        $postslist = get_posts( $postargs );
 
        foreach ( $postslist as $post ) {
					 setup_postdata( $post );
        get_template_part('parts/content_list', get_post_format());
				}
        wp_reset_postdata();
        echo '</div>';
    }}else{
      $args = array(
        'parent' => $parentId,
        'post_type' => 'shop', //①カスタム投稿名 (通常の「投稿」はpost)
        'taxonomy' => $select_tax, //②タクソノミー名を指定 (通常の「投稿」はcategory)
        'field' => 'slug',   //'term_id'、'slug'など、次の term を指定するフィールド名を指定
        'term' => $term->slug,  //③タームを指定
        //'terms' => array('test','test2'), &nbsp;//③タームを指定 (複数の場合)
        'posts_per_page' => -1, //表示数を指定
      );
      $custom_query = new WP_Query( $args );
      if ( $custom_query->have_posts() ) {
        while ( $custom_query->have_posts() ) {
            $custom_query->the_post(); 
			 get_template_part('parts/content_list', get_post_format()); 
        }
      }
    }
		wp_reset_postdata();
    echo '</div>';
  }
  ?>
  </div>
</section>