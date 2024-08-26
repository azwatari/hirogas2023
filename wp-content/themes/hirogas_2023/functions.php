<?php

//https://wp-labo.com/wordress-page-list-slug-name/
// 固定ページ一覧にスラッグを追加する 
function add_page_column_slug_title( $columns ) {
	$columns[ 'slug' ] = "スラッグ";
	return $columns;
}
function add_page_column_slug( $column_name, $post_id ) {
	if( $column_name == 'slug' ) {
		$post = get_post( $post_id );
		$slug = $post->post_name;
		echo esc_attr( $slug );
	}
}
add_filter( 'manage_pages_columns', 'add_page_column_slug_title' );
add_action( 'manage_pages_custom_column', 'add_page_column_slug', 10, 2 );


//https://rmtmhome.com/blogs-archive-1820
// 投稿アーカイブページの作成 
/*
function post_has_archive( $args, $post_type ) {
	if ( 'post' == $post_type ) {
		$args['rewrite'] = true;
		$args['has_archive'] = 'news'; //任意のスラッグ名
	}
	return $args;

}
add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 );
*/


//https://satoshimurata.com/wordpress-archive-another-url
//WordPressの投稿（投稿タイプpost）の一覧を任意のURLに変更し、投稿パーマリンクを下層ページに位置付ける方法
add_filter('register_post_type_args', function($args, $post_type) {
  if ($post_type === 'post') {
    $slug = 'news';
    $args['labels'] = array(
      'name' => 'ニュース・キャンペーン情報'
    );
    $args['has_archive'] = $slug;
    $args['rewrite'] = array(
      'slug' => $slug,
      'with_front' => false,
    );
  }
  return $args;
}, 10, 2);


//WordPress のカスタム投稿タイプが多い時に管理画面メニューでの並び順をまとめるスニペット
//http://pimpmysite.net/archives/164
add_filter( 'custom_menu_order', '__return_true' );
add_filter( 'menu_order'       , 'pm_menu_order' );  

function pm_menu_order( $menu_order ) {
  $menu = array();

  foreach ( $menu_order as $key => $val ) {
      if ( 0 === strpos( $val, 'edit.php' ) )
          break;
          
      $menu[] = $val;
      unset( $menu_order[$key] );
  }
  
  foreach ( $menu_order as $key => $val ) {
      if ( 0 === strpos( $val, 'edit.php' ) ) {
          $menu[] = $val;
          unset( $menu_order[$key] );
      }
  }

  return array_merge( $menu, $menu_order );
}






//https://yuki.world/wordpress-post-permalink-customize/
//"投稿"のパーマリンクだけカスタマイズ：/news/%post_id%にする
// 投稿ページのパーマリンクをカスタマイズ
function add_article_post_permalink( $permalink ) {
  $permalink = '/news' . $permalink;
  return $permalink;
}
add_filter( 'pre_post_link', 'add_article_post_permalink' );

function add_article_post_rewrite_rules( $post_rewrite ) {
  $return_rule = array();
  foreach ( $post_rewrite as $regex => $rewrite ) {
      $return_rule['news/' . $regex] = $rewrite;
  }
  return $return_rule;
}
add_filter( 'post_rewrite_rules', 'add_article_post_rewrite_rules' );





//https://cocotiie.com/custom-post-url-numbers/
//[WordPress]カスタム投稿タイプのURLをポストIDにする
//カスタム投稿パーマリンク

add_filter('post_type_link', 'generateCustomPostLink', 1, 2);
add_filter('rewrite_rules_array', 'addRewriteRules');

function generateCustomPostLink($link, $post){
  if($post->post_type === 'shop'){
    // IDはschedule
    return home_url('/shop/'.$post->ID);
  } else {
    return $link;
  }
}
function addRewriteRules($rules){
  // 上のパーマリンクに0-9を足す
  $new_rule = array(
    'shop/([0-9]+)/?$' => 'index.php?post_type=shop&p=$matches[1]'
  );
  // ルール配列に結合
  return $new_rule + $rules;
}



//自動挿入されるGutenberg用CSSを削除する方法
//https://on-ze.com/archives/7630
add_action( 'wp_enqueue_scripts', 'remove_block_library_style' );
function remove_block_library_style() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
}



// generatorを非表示にする
//https://design-studio-f.com/blog/wordpress-html-head-organize/
remove_action('wp_head', 'wp_generator');
// feed内のgeneratorを非表示にする
foreach ( array( 'rss2_head', 'commentsrss2_head', 'rss_head', 'rdf_header', 'atom_head', 'comments_atom_head', 'opml_head', 'app_head' ) as $action ) {
  remove_action( $action, 'the_generator' );
}
// wlwmanifestを非表示にする
remove_action('wp_head', 'wlwmanifest_link');
// EditURIを非表示にする
remove_action('wp_head', 'rsd_link');
// 絵文字表示スタイルを非表示にする
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles', 10 );


//DNS プリフェッチ
//https://wpqw.jp/wordpress/themes/head-clean/
function remove_dns_prefetch( $hints, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
		return array_diff( wp_dependencies_unique_hosts(), $hints );
	}
	return $hints;
}
add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );
//feed
remove_action( 'wp_head', 'feed_links_extra', 3 );

//短縮URL
//https://www.cloud9works.net/web/how-to-remove-meta-generator-from-wordpress/
remove_action('wp_head', 'wp_shortlink_wp_head');

//classic-theme.min.css」を削除する方法
//https://on-ze.com/archives/10305
add_action( 'wp_enqueue_scripts', 'remove_classic_theme_style' );
function remove_classic_theme_style() {
	wp_dequeue_style( 'classic-theme-styles' );
}

//WordPressでglobal-styles-inline-cssを無効化する
//https://webgaku.net/jp/wordpress/global-styles-inline-css/
add_action( 'wp_enqueue_scripts', 'remove_global_styles' );
function remove_global_styles(){
    wp_dequeue_style( 'global-styles' );
}




//検索

//https://techmemo.biz/wordpress/post-type-search-template/
//WordPressで投稿タイプ別に異なる検索結果用のテンプレート(search.php)を使えるようにする方法
function custom_search_template($template){
  if ( is_search() ){
    $post_types = get_query_var('post_type');
    foreach ( (array) $post_types as $post_type )
    $templates[] = "search-{$post_type}.php";
    $templates[] = 'search.php';
    $template = get_query_template('search',$templates);
  }
  return $template;
  }
  add_filter('template_include','custom_search_template');



//検索結果日付順
//https://cms-hikaku-navi.com/column/5580/
function my_pre_get_posts($query) {
  if ( !is_admin() && $query->is_main_query() && $query->is_search() ) {
  $query->set( 'orderby', 'date' ); // 日付順
  $query->set('order', 'DESC');
  }
  }
  add_action( 'pre_get_posts','my_pre_get_posts' );



//https://tatuking.com/wp-search-space/
// 検索の全角スペース対応 
function search_space($query){
  if ( is_admin() || ! $query->is_main_query() ){
    return;
  }
  if( $query->is_search ) {
    $formtxt = $query->get( 's' );
    $formtxt = str_replace('　',' ',$formtxt);
    $query->set('s',$formtxt);
  }
}
add_action('pre_get_posts','search_space');


/*
function change_posts_per_page($query) {
  if ( is_admin() || ! $query->is_main_query() )
      return;
  if ( $query->is_post_type_archive('shop') ) { //カスタム投稿タイプを指定
      $query->set( 'posts_per_page', '10' ); //表示件数を指定
  }
}
add_action( 'pre_get_posts', 'change_posts_per_page' );
*/

/*===================================================================
*テンプレート、カスタム投稿タイプ・カスタムタクソノミーごとの表示件数を設定
===================================================================*/
add_action('pre_get_posts','display_numbers');
function display_numbers( $query ) {

// if(is_admin() || ! $query -> is_main_query()) return;
// if($query -> is_front_page()) { //フロントページ
// $query -> set('posts_per_page',10); //10件
// }

// if($query->is_home()){ // トップページ
// $query->set( 'posts_per_page',20); //20件
// }

// if($query->is_month()){ // 月別アーカイブ
// $query->set('posts_per_page',-1); //　-1ですべて表示
// }

// if($query->is_year()){ //年別アーカイブ
// $query->set('posts_per_page',10); //10件
// }

// if($query->is_author()){ // 作成者アーカイブ
// $query->set('posts_per_page',10); //　10件
// }

 //if($query->is_category()){ // カテゴリーアーカイブ
 //$query->set('posts_per_page',10); // 10件
 //}


//shoplistというカスタム投稿タイプのアーカイブページ
//if($query -> is_post_type_archive('shop')){
 //$query -> set('posts_per_page',10); //200件
 //$query -> set('order','DESC'); //昇順
 //$query -> set('orderby', 'date'); //日
 //}
 //検索結果ページ
 if($query -> is_search()){
  $query -> set('posts_per_page',10); //200件
  $query -> set('order','DESC'); //昇順
  $query -> set('orderby', 'date'); //日
  }

//newscatというタクソノミーの一覧ページ
// if ($query -> is_tax('newscat')) {
// $query -> set('posts_per_page', 10); //10件
// $query -> set('order', 'DESC'); //降順
// $query -> set('orderby', 'date'); //日
// }
}



//https://web-taiyo.com/works/200715.html
// /親タームにチェック
add_action('save_post', 'assign_parent_terms', 10, 2);
function assign_parent_terms($post_id, $post){
  if($post->post_type != 'shop')
      return $post_id;
  $terms = wp_get_post_terms($post_id, 'shop_area' );
  foreach($terms as $term){
      while($term->parent != 0 && !has_term( $term->parent, 'shop_area', $post )){
          wp_set_post_terms($post_id, array($term->parent), 'shop_area', true);
          $term = get_term($term->parent, 'shop_area');
      }
  }
}




//googlemap
// Method 1: Filter.
// Method 2: Setting.
function my_acf_init() {
  acf_update_setting('google_api_key', 'AIzaSyB7vC815ICcz1tboW318Q91OyoUK2wahow');
}
add_action('acf/init', 'my_acf_init');






//WordPress管理サイト（管理画面）の一覧ページに表示する項目を変更する【カスタムターム編】
//https://100webdesign.jp/services/wordpress/wp_result/wp_result-151/
/* 管理画面での表示項目追加 */
function add_custom_column( $defaults ) {
  $defaults['shop_area'] = '地域'; //'blog_cat'はタクソノミー名
  $defaults['shop_genre'] = 'ジャンル'; //タクソノミーは複数可
  return $defaults;
}
add_filter('manage_shop_posts_columns', 'add_custom_column'); //ここでの’blog’はカスタム投稿タイプ
 
function add_custom_column_id($column_name, $id) {
  $terms = get_the_terms($id, $column_name);
  if ( $terms && ! is_wp_error( $terms ) ){
    $blog_cat_links = array();
    foreach ( $terms as $term ) {
      $blog_cat_links[] = $term->name;
    }
    echo join( ", ", $blog_cat_links );
  }
}
add_action('manage_shop_posts_custom_column', 'add_custom_column_id', 10, 2); //ここでの’blog’はカスタム投稿タイプ




//https://100webdesign.jp/services/wordpress/wp_result/wp_result-21468/
//WordPress管理サイト（管理画面）の一覧ページに表示する項目を変更する【カスタムフィールド編】
/* 管理画面での表示項目追加 */
function add_custom_column2( $defaults ) {
  $defaults['shopname'] = '店名'; //項目名
  $defaults['photo_main'] = 'メイン画像'; //項目名
  return $defaults;
}
add_filter('manage_shop_posts_columns', 'add_custom_column2'); //ここでの’blog’はカスタム投稿タイプ
 
function add_custom_column_id2($column_name, $id) {
  if ($column_name == 'shopname') {
  $cf_column = get_field('shopname', $id);
  echo $cf_column;
  }elseif ($column_name == 'photo_main') {
  $cf_column = get_field('photo_main', $id);
  echo '<img style="height:4em;width:auto;display:inline-block;" src="'.$cf_column.'" />';
  }
}
add_action('manage_shop_posts_custom_column', 'add_custom_column_id2', 10, 2); //ここでの’blog’はカスタム投稿タイプ




//https://100webdesign.jp/services/wordpress/wp_result/wp_result-1024/
//WP REST API から記事やユーザー情報を取得できないようにする
function kaiza_filter_rest_endpoints( $endpoints ) {
  /* REST APIでユーザー情報取得を無効にする */
  if ( isset( $endpoints['/wp/v2/users'] ) ) {
      unset( $endpoints['/wp/v2/users'] );
  }
  if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
      unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
  }
  return $endpoints;
}
add_filter( 'rest_endpoints', 'kaiza_filter_rest_endpoints', 10, 1 );






/* @ サイトのURL/?author=1でのユーザー名の漏洩を防止
----------------------------------------------------------------------------- */

function disable_author_archive() {
  if( $_GET['author'] || preg_match('#/author/.+#', $_SERVER['REQUEST_URI']) ){
    wp_redirect( home_url('/404.php') );
    exit;
  }
}
add_action('init', 'disable_author_archive');




//バックグラウンド更新が想定通りに動作していません
//バックグラウンド更新は使用中の WordPress のバージョンにセキュリティ更新がリリースされた際、自動更新できることを保証します。
//OK バージョン管理システムは検出されませんでした。
//エラー この WordPress サイトでは更新の実行の際に FTP 認証情報が必要となります。 (このサイトではファイルの所有権の問題のため、更新が FTP 経由で行われます。詳細はホスティング会社にお尋ねください。)
//https://www.sandalot.com/wordpress%E6%9B%B4%E6%96%B0%E3%81%A7ftp%E5%85%A5%E5%8A%9B%E7%94%BB%E9%9D%A2%E3%81%8C%E8%A1%A8%E7%A4%BA%E3%81%95%E3%82%8C%E3%82%8B%E5%A0%B4%E5%90%88%E3%81%AE%E5%AF%BE%E5%87%A6%E6%B3%95/
/*
function set_fs_method($args) {
	return 'direct';
}
add_filter('filesystem_method','set_fs_method');
*/







//【WordPress使い方】投稿一覧を最終更新日順に並び替える【記事更新】
//https://wp-makingnote.com/wordpress/modified/

/*投稿時間表示*/
function add_scheduled_posts_date_column_time( $h_time, $post ) {
  if ( $post->post_status == 'future' ) {
  $h_time .= '
  ' . get_post_time( 'H:i', false, $post );
  }
  return $h_time;
  }
  add_filter ( 'post_date_column_time', 'add_scheduled_posts_date_column_time', 10, 2 );
  
  // 最終更新日
  function last_modified_admin_column( $columns ) {
  $columns['modified-last'] =__( '最終更新日', 'aco' );
  return $columns;
  }
  add_filter( 'manage_edit-post_columns', 'last_modified_admin_column' );
  add_filter( 'manage_edit-shop_columns', 'last_modified_admin_column' );
  add_filter( 'manage_edit-topics_columns', 'last_modified_admin_column' );
  
  function sortable_last_modified_column( $columns ) {
  $columns['modified-last'] = 'modified';
  return $columns;
  }
  add_filter( 'manage_edit-post_sortable_columns', 'sortable_last_modified_column' );
  add_filter( 'manage_edit-shop_sortable_columns', 'sortable_last_modified_column' );
  add_filter( 'manage_edit-topics_sortable_columns', 'sortable_last_modified_column' );
  
  function last_modified_admin_column_content( $column_name, $post_id ) {
  if ( 'modified-last' != $column_name )
  return;
  
  $modified_date = the_modified_date( 'Y年Md日Ag時i分' );
  echo $modified_date;
  }
  add_action( 'manage_posts_custom_column', 'last_modified_admin_column_content', 10, 2 );