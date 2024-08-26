<?php
$taxSpNm = get_field('shopname');
$taxPhtMin = get_field('photo_main');
$taxPhtSb1 = get_field('photo_sub1');
$taxPhtSb2 = get_field('photo_sub2');
$taxGnrs = get_the_terms(get_the_ID(), 'shop_genre');
$taxGnr = $taxGnrs[0];
$taxAras = get_the_terms(get_the_ID(), 'shop_area');
$taxAra = $taxAras[0];
$taxInd = get_field('industry');
$taxAdr = nl2br(get_field('address'));
$taxTl = nl2br(get_field('tel'));
$taxHur = nl2br(get_field('hours'));
$taxHld = nl2br(get_field('holiday'));
$taxUrl = get_field('url');
$taxBnft = nl2br(get_field('benefit'));
$taxMap = get_field('map');
$taxFb = get_field('facebook');
$taxFb_hddn = mb_substr($taxFb, 0, 2);
$taxTw = get_field('twitter');
$taxAddPht = get_field('additional_photo');
//「各種設定」ページのid取得
$settings = get_page_by_path('settings');
$settingsId = get_post( $settings );
//echo $settingsId->ID;     //IDを表示
$taxLstPdf = get_field('list_pdf',$settingsId->ID);
$taxNoPht = get_field('nophoto',$settingsId->ID);

//URLエンコード//しなくても日本語urlで表示される
//https://stackoverflow.com/questions/4929584/encodeuri-in-php/6059053
function encodeURI($url) {
  // http://php.net/manual/en/function.rawurlencode.php
  // https://developer.mozilla.org/en/JavaScript/Reference/Global_Objects/encodeURI
  $unescaped = array(
      '%2D'=>'-','%5F'=>'_','%2E'=>'.','%21'=>'!', '%7E'=>'~',
      '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')'
  );
  $reserved = array(
      '%3B'=>';','%2C'=>',','%2F'=>'/','%3F'=>'?','%3A'=>':',
      '%40'=>'@','%26'=>'&','%3D'=>'=','%2B'=>'+','%24'=>'$'
  );
  $score = array(
      '%23'=>'#'
  );
  return strtr(rawurlencode($url), array_merge($reserved,$unescaped,$score));
}
function fixedEncodeURI($url) {
  return strtr(encodeURI($url),array('%5B'=>'[', '%5D'=>']'));
}
$taxFb=get_field('facebook');
$linkFb=fixedEncodeURI($taxFb);
?>

<header class="header_section header_section_detail header_section_shopdetail">
  <h2 class="title_header_section title_header_section_shopdetail"><?php if(get_the_title()){echo get_the_title();}else{echo '&nbsp;';}; ?></h2>
</header>
<div class="content_section content_section_shopdetail content_section_detail">
  <article class="article_shop_shopdetail article_detail with_photo">
    <?php 
      echo '<div class="genres_shop genres_detail">';
      if($taxGnr){
        foreach ( $taxGnrs as $taxGnr ){
          //echo '<a href="'.get_term_link($taxGnr).'">';
          echo '<em class="genre_shop genre_shop_'.$taxGnr->slug.' genre_shop_shopdetail">'.esc_html($taxGnr->name).'</em>';
          //echo '</a>';
        };
      }
      echo '</div>';
    ?>
    <div class="inner inner_shopdetail inner_shopdetail_photo inner_detail_photo">
      <?php
        if($taxPhtMin || $taxPhtSb1 || $taxPhtSb2){
          if($taxPhtMin){
            echo '<span class="box_detail_img">';
            echo '<img src="'.$taxPhtMin.'" alt="" />';
            echo '</span>';
          };
          if($taxPhtSb1){
            echo '<span class="box_detail_img">';
            echo '<img src="'.$taxPhtSb1.'" alt="" />';
            echo '</span>';
          };
          if($taxPhtSb2){
            echo '<span class="box_detail_img">';
            echo '<img src="'.$taxPhtSb2.'" alt="" />';
            echo '</span>';
          };
        }else{
            echo '<span class="box_detail_img">';
            echo '<img src="'.$taxNoPht.'" alt="" />';
            echo '</span>';
        }
      ?>
    </div>
    <div class="inner inner_shopdetail inner_shopdetail_content inner_detail">
      <div class="body_shop body_shop_single body_single"><?php echo  get_the_content(); ?></div>
      <?php
        if($taxInd || $taxAdr || $taxTl || $taxHur || $taxUrl || $taxBnft){
          echo '<h3>店舗・施設詳細</h3>';
          echo '<dl class="list_shop_detail">';
        
          if($taxInd){
            echo '<dt>業種</dt><dd>'.$taxInd.'</dd>';
          }
          if($taxAdr){
            echo '<dt>住所</dt><dd>'.$taxAdr.'</dd>';
          }
          if($taxTl){
            echo '<dt>電話番号</dt><dd>'.$taxTl.'</dd>';
          }
          if($taxHur){
            echo '<dt>営業時間</dt><dd>'.$taxHur.'</dd>';
          }
          if($taxHld){
            echo '<dt>定休日</dt><dd>'.$taxHld.'</dd>';
          }
          if($taxUrl){
            echo '<dt>URL</dt><dd><a class="link_external link_external_shop" href="'.$taxUrl.'" target="_blank">'.$taxUrl.'</a></dd>';
          }
          if($taxBnft){
            echo '<dt>利用特典</dt><dd>'.$taxBnft.'</dd>';
          }
          echo '</dl>';
          echo '</div>';
        }
      ?>

    <?php
      if($taxAddPht){
        echo '<div  class="inner inner_shopdetail inner_shopdetail_map inner_detail inner_shopdetail_additionalphoto">';
        echo '<h3>広ガスクーポン取扱い支店一覧</h3>';
        echo '<div class="box_additional_photo">';
        echo '<img src="'.$taxAddPht.'" alt="" />';
        if($taxLstPdf){
          echo '<a class="link_show_detail link_shop_show_detail" href="'.$taxLstPdf.'" target="_blanlk">広ガスクーポン取扱い支店一覧（PDF）</a>';
        }
        echo '</div>';
        echo '</div>';
      }
    ?>

    <?php
     if($taxMap){
        echo '<div  class="inner inner_shopdetail inner_shopdetail_map inner_detail inner_shopdetail_map_manualiframe">';
        echo '<h3>MAP</h3>';
        echo $taxMap;
        echo '</div>';
      }
    ?>

    <?php
      //https://theshare.info/adwords/web%E5%88%B6%E4%BD%9C/safari%E3%81%A7facebook%E3%81%AE%E5%9F%8B%E3%82%81%E8%BE%BC%E3%81%BF%E3%81%8C%E8%A1%A8%E7%A4%BA%E3%81%95%E3%82%8C%E3%81%AA%E3%81%84_i1040
      //SafariでFacebookの埋め込みが表示されない
      if($taxFb && $taxFb_hddn!='xx'){
        echo '<div class="inner inner_shopdetail inner_shopdetail_fb inner_detail">';
        echo '<h3>Facebook</h3>';
        echo '<div class="fb-page" data-href="https://www.facebook.com/'.$linkFb.'/" data-show-posts="true" data-width="500" data-height="500" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/'.$linkFb.'/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/'.$linkFb.'/">'.get_the_title().'</a></blockquote></div>';
        echo '<div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v16.0" nonce="E1Vb03Uc"></script>';
        echo   '</div>';
      };
      if($taxTw){
        echo '<div class="inner inner_shopdetail inner_shopdetail_tw inner_detail">';
        echo '<h3>Twitter</h3>';
        echo '<a class="twitter-timeline" data-height="450" href="https://twitter.com/'.$taxTw.'?ref_src=twsrc%5Etfw">Tweets by '.$taxTw.'</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>';
        echo '</div>';
      };
    ?>
    
  </article>
</div>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7vC815ICcz1tboW318Q91OyoUK2wahow&callback=Function.prototype"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/googlemap.js"></script>