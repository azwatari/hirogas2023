<!DOCTYPE html>
<html lang="ja">


<link rel="manifest" href="/manifest.webmanifest">
		<script src="/app.js"></script>
		<link rel="icon" href="/favicon.ico" sizes="any"><!-- 32×32 -->
		<link rel="icon" href="/icon.svg" type="image/svg+xml">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png"><!-- 180×180 -->
		<meta name="apple-mobile-web-app-status-bar" content="#36B3F2">
		<meta name="theme-color" content="#00a540">

	<?php
		$post_type = get_post_type(); //投稿タイプ名(スラッグ)の取得
		$post_type_object = get_post_type_object($post_type); //投稿タイプの情報を取得
	?>
	
	<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/<?php
		if(is_home()){
			echo 'website';
		}else{
			echo 'article';
		}
		?>#">

		<meta charset="<?php bloginfo( 'charset' ); ?>" />

		<?php
			$taxTtl = get_the_title();
			$taxSitNam = get_bloginfo('name');
			$taxShpNam = get_field('shopname');
		?>

		<title><?php
			if(is_home()){
				bloginfo('name');
			}elseif(is_single() || is_page()){
				if($taxShpNam){
					echo $taxShpNam.'｜'.$taxSitNam;
				}else{
					echo $taxTtl.'｜'.$taxSitNam;
				}
			}else{
				echo $post_type_object->label.'｜'.$taxSitNam;
			}
		?></title>

		<!--keyword-->
		<?php
			$taxKyw = get_field('keyword');
			$change = ["　"," "];
			$changedKyw = str_replace($change, ',', $taxKyw);
			$taxNwsKyw = get_field('news_keyword');
			$changedNwsKyw = str_replace($change, ',', $taxNwsKyw);
			//「各種設定」ページのid取得
			$settings = get_page_by_path('settings');
			$settingsId = get_post( $settings );
			//echo $settingsId->ID;     //IDを表示
			$taxCmnKyw = get_field('meta_keywords',$settingsId->ID);
		?>

		<?php
			if(is_single()){
				if($taxKyw){
					echo '<meta name="keywords" http-equiv="keywords" content="'.$changedKyw.','.$taxCmnKyw.'">';
				}elseif($taxNwsKyw){
					echo '<meta name="keywords" http-equiv="keywords" content="'.$changedNwsKyw.','.$taxCmnKyw.'">';
				}elseif($taxTtl){
					echo '<meta name="keywords" http-equiv="keywords" content="'.$taxTtl.','.$taxCmnKyw.'">';
				}
			}else{
				echo '<meta name="keywords" http-equiv="keywords" content="'.$taxCmnKyw.'">';
			}
		?>

		<!--description-->
		<?php
			$taxDct = get_field('description');
			$taxNwsDct = get_field('news_description');
			$taxDct_news = get_field('setting_description_news',$settingsId->ID);
			$taxDct_shop = get_field('setting_description_shop',$settingsId->ID);
			$taxDct_about = get_field('setting_description_about',$settingsId->ID);
			$taxDct_guide = get_field('setting_description_guide',$settingsId->ID);
			$taxDct_sitemap = get_field('setting_description_sitemap',$settingsId->ID);
			$taxDct_contact = get_field('setting_description_contact',$settingsId->ID);
		?>

		<?php
			if(is_home()){
				echo '<meta name="description" http-equiv="description" content="'.get_bloginfo('description').'">';
			}elseif(is_single()){
				if($taxDct){
					echo '<meta name="description" http-equiv="description" content="'.$taxDct.'｜'.get_bloginfo('description').'">';
				}elseif($taxNwsDct){
					echo '<meta name="description" http-equiv="description" content="'.$taxNwsDct.'｜'.get_bloginfo('description').'">';
				}else{
					echo '<meta name="description" http-equiv="description" content="'.get_bloginfo('description').'">';
				}
			}elseif($post_type_object->rewrite['slug'] == 'news' || is_tax('news_genre')){
				echo '<meta name="description" http-equiv="description" content="'.$taxDct_news.'｜'.get_bloginfo('description').'">';
			}elseif($post_type_object->rewrite['slug'] == 'shop' || is_tax('shop_area') || is_tax('shop_genre')){
				echo '<meta name="description" http-equiv="description" content="'.$taxDct_shop.'｜'.get_bloginfo('description').'">';
			}elseif(is_page('about')){
				echo '<meta name="description" http-equiv="description" content="'.$taxDct_about.'｜'.get_bloginfo('description').'">';
			}elseif(is_page('guide')){
				echo '<meta name="description" http-equiv="description" content="'.$taxDct_guide.'｜'.get_bloginfo('description').'">';
			}elseif(is_page('contact')){
				echo '<meta name="description" http-equiv="description" content="'.$taxDct_contact.'｜'.get_bloginfo('description').'">';
			}elseif(is_page('sitemap')){
				echo '<meta name="description" http-equiv="description" content="'.$taxDct_sitemap.'｜'.get_bloginfo('description').'">';
			}else{
				echo '<meta name="description" http-equiv="description" content="'.get_bloginfo('description').'">';
			}
		?>

		<?php
			//https://www.web-myoko.net/blog/wordpress/php-warning-in-array-expects-parameter-2-to-be-array-string-given-in-error-message/
			//PHPで［Warning: in_array() expects parameter 2 to be array, string given in…］のエラーメッセージが出た時の対処法
			if($post_type_object->rewrite['slug'] == 'news' && is_single()){
				$taxEngn = get_field('news_searchengine');
			}elseif($post_type_object->rewrite['slug'] == 'shop' && is_single()){
				$taxEngn = get_field('searchengine');
			}
			if(in_array('noindex', (array)$taxEngn)){
				echo '<meta name="robots" content="noindex, nofollow">';
			}
		?>

		<!--ogp-->
		<?php
			//title
			echo '<meta property="og:title" content="';
			if(is_home()){
				bloginfo('name');
			}elseif(is_single() || is_page()){
				if($taxShpNam){
					echo $taxShpNam.'｜'.$taxSitNam;
				}else{
					echo $taxTtl.'｜'.$taxSitNam;
				}
			}else{
				echo $post_type_object->label.'｜'.$taxSitNam;
			}
			echo '">';
		?>

		<?php
			//type
			echo '<meta property="og:type" content="';
			if(is_single() || is_page()){
				echo 'article';
			}else{
				echo 'website';
			}
			echo '">';
		?>
	
		<?php
		//description
			if(is_home()){
				echo '<meta property="og:description" content="'.get_bloginfo('description').'">';
			}elseif(is_single()){
				if($taxDct){
					echo '<meta property="og:description" content="'.$taxDct.'｜'.get_bloginfo('description').'">';
				}elseif($taxNwsDct){
					echo '<meta property="og:description" content="'.$taxNwsDct.'｜'.get_bloginfo('description').'">';
				}else{
					echo '<meta property="og:description" content="'.get_bloginfo('description').'">';
				}
			}elseif($post_type_object->rewrite['slug'] == 'news' || is_tax('news_genre')){
				echo '<meta property="og:description" content="'.$taxDct_news.'｜'.get_bloginfo('description').'">';
			}elseif($post_type_object->rewrite['slug'] == 'shop' || is_tax('shop_area') || is_tax('shop_genre')){
				echo '<meta property="og:description" content="'.$taxDct_shop.'｜'.get_bloginfo('description').'">';
			}elseif(is_page('about')){
				echo '<meta property="og:description" content="'.$taxDct_about.'｜'.get_bloginfo('description').'">';
			}elseif(is_page('guide')){
				echo '<meta property="og:description" content="'.$taxDct_guide.'｜'.get_bloginfo('description').'">';
			}elseif(is_page('contact')){
				echo '<meta property="og:description" content="'.$taxDct_contact.'｜'.get_bloginfo('description').'">';
			}elseif(is_page('sitemap')){
				echo '<meta property="og:description" content="'.$taxDct_sitemap.'｜'.get_bloginfo('description').'">';
			}else{
				echo '<meta property="og:description" content="'.get_bloginfo('description').'">';
			}
		?>

		<?php
			//url
			if(is_home()){
				echo '<meta property="og:url" content="'.home_url().'">';
			}elseif(is_single() || is_page()){
				echo '<meta property="og:url" content="'.get_the_permalink().'">';
			}elseif(is_archive()){
				echo '<meta property="og:url" content="'.home_url().'/'.$post_type_object->rewrite['slug'].'">';
			}else{
				echo '<meta property="og:url" content="'.home_url().'">';
			}
		?>

		<?php 
			//site_name
			echo '<meta property="og:site_name" content="'.get_bloginfo('name').'">';
		?>

		<?php
			//image
			if($post_type_object->rewrite['slug'] == 'news' && is_single()){
				$taxTmb = get_field('news_thumbnail');
			}elseif($post_type_object->rewrite['slug'] == 'shop' && is_single()){
				$taxTmb = get_field('photo_main');
			}else{
				$taxTmb = get_field('site_catchimage',$settingsId->ID);
			}

			/*----------------------------------------*/
			/* URLから wp-content より後の部分を取得
			/*----------------------------------------*/
			$path_url = $taxTmb;
			$pattern = '/.*wp-content(.*)/';
			preg_match($pattern, $path_url, $matches_url);
			$path_rear = $matches_url[1];

			/*----------------------------------------*/
			/* サーバーパスを取得して wp-content 以前の部分を取得
			/*----------------------------------------*/
			$pattern = '/(.*wp-content)/';
			$path_sv = __FILE__;
			preg_match($pattern, $path_sv, $matches_sv);
			$path_front = $matches_sv[1];

			/*----------------------------------------*/
			/* 画像のサーバーパスを生成
			/*----------------------------------------*/
			$path_new = $path_front.$path_rear;

			$image_size = getimagesize($path_new);

			if($taxTmb){
				echo '<meta property="og:image" content="'.$taxTmb.'">';
				echo '<meta property="og:image:width" content="'.$image_size[0].'">';
				echo '<meta property="og:image:height" content="'.$image_size[1].'">';
			}
		?>

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,viewport-fit=cover">

		<link rel="alternate" type="application/atom+xml" href="<?php bloginfo('atom_url'); ?>" title="Atom" />
		<script src="https://kit.fontawesome.com/ed3fc342b7.js" crossorigin="anonymous"></script>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Murecho:wght@700&family=Noto+Sans+JP:wght@400;700&family=Roboto+Condensed:wght@400;700&family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">

		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css" type="text/css" />
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/totop.js"></script>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/corner.js"></script>
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>