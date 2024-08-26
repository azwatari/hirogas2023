<?php
  //「各種設定」ページのid取得
  $settings = get_page_by_path('settings');
  $settingsId = get_post( $settings );
  //echo $settingsId->ID;     //IDを表示
  $taxHrgsNv = get_field('setting_hirogas_nav',$settingsId->ID);
  $taxHrgsNv_h1 = $taxHrgsNv['setting_hirogas_header1'];
  $taxHrgsNv_ht1 = $taxHrgsNv_h1['setting_hirogas_header1_txt'];
  $taxHrgsNv_hu1 = $taxHrgsNv_h1['setting_hirogas_header1_url'];
  $taxHrgsNv_h2 = $taxHrgsNv['setting_hirogas_header2'];
  $taxHrgsNv_ht2 = $taxHrgsNv_h2['setting_hirogas_header2_txt'];
  $taxHrgsNv_hu2 = $taxHrgsNv_h2['setting_hirogas_header2_url'];
  $taxHrgsNv_h3 = $taxHrgsNv['setting_hirogas_header3'];
  $taxHrgsNv_ht3 = $taxHrgsNv_h3['setting_hirogas_header3_txt'];
  $taxHrgsNv_hu3 = $taxHrgsNv_h3['setting_hirogas_header3_url'];
  $taxHrgsNv_h4 = $taxHrgsNv['setting_hirogas_header4'];
  $taxHrgsNv_ht4 = $taxHrgsNv_h4['setting_hirogas_header4_txt'];
  $taxHrgsNv_hu4 = $taxHrgsNv_h4['setting_hirogas_header4_url'];
  $taxHrgsNv_h5 = $taxHrgsNv['setting_hirogas_header5'];
  $taxHrgsNv_ht5 = $taxHrgsNv_h5['setting_hirogas_header5_txt'];
  $taxHrgsNv_hu5 = $taxHrgsNv_h5['setting_hirogas_header5_url'];
  $taxLstLnk = get_field('list_link',$settingsId->ID);
?>

<header class="header_global">
  <div class="wrapper_global">
    <nav class="nav_header">
      <a class="title_header_gas" href="http://www.hiroshima-gas.co.jp/" target="_blank">広島ガス</a>
      <ul class="list_header_gas">
          <?php
            if($taxHrgsNv_hu1 && $taxHrgsNv_ht1){
              echo '<li>';
              echo '<a href="'.$taxHrgsNv_hu1.'" target="_blank">'.$taxHrgsNv_ht1.'</a>';
              echo '</li>';
            }
            if($taxHrgsNv_hu2 && $taxHrgsNv_ht2){
              echo '<li>';
              echo '<a href="'.$taxHrgsNv_hu2.'" target="_blank">'.$taxHrgsNv_ht2.'</a>';
              echo '</li>';
            }
            if($taxHrgsNv_hu3 && $taxHrgsNv_ht3){
              echo '<li>';
              echo '<a href="'.$taxHrgsNv_hu3.'" target="_blank">'.$taxHrgsNv_ht3.'</a>';
              echo '</li>';
            }
            if($taxHrgsNv_hu4 && $taxHrgsNv_ht4){
              echo '<li>';
              echo '<a href="'.$taxHrgsNv_hu4.'" target="_blank">'.$taxHrgsNv_ht4.'</a>';
              echo '</li>';
            }
            if($taxHrgsNv_hu5 && $taxHrgsNv_ht5){
              echo '<li>';
              echo '<a href="'.$taxHrgsNv_hu5.'" target="_blank">'.$taxHrgsNv_ht5.'</a>';
              echo '</li>';
            }
          ?>
      </ul>
    </nav>
  </div>
</header>

<section class="section_hero">
  <div class="wrapper_global">
    <header class="header_hero">
    <div class="title_global">
      <a class="link_global" title="Topページ" href="<?php echo home_url( '/' ); ?>">
        <h1>広ガスクーポン取扱い加盟店サイト</h1>
        <p>広ガスクーポン取扱い加盟店サイトトップページへ</p>
      </a>
    </div>
    <div class="number_stores">
      <p>現在参加中の広ガスクーポン取扱い加盟店</p>
      <p>
        <span><?php	//加盟店数
          //記事登録数
          $count_pages = wp_count_posts('shop');
          $pages = $count_pages->publish;
          //実店舗数追加数
          //「各種設定」ページのid取得
          $settings = get_page_by_path('settings');
          $settingsId = get_post( $settings );
          //echo $settingsId->ID;     //IDを表示
          $taxTotl = get_field( 'total_number', $settingsId->ID ); 
          $taxTotl_slct = $taxTotl['total_number_select'];
          $taxTotl_vle = $taxTotl['total_number_value'];
          if($taxTotl_slct=='sum' && $taxTotl_vle){
            //echo '総合計';
              echo $taxTotl_vle;
          }elseif($taxTotl_slct=='diff' && $taxTotl_vle){
            //echo '加算';
              echo $pages + $taxTotl_vle;
          }else{
            //echo 'プラス無し';
            echo $pages;
          }

        ?></span>店舗
      </p>
    </div>
    <div class="induction">
      <a href="/about/">広ガスクーポンとは</a>
      <?php 
        if($taxLstLnk){
          echo '<a href="'.$taxLstLnk.'" target="_blank">取扱い加盟店一覧</a>';
        }
      ?>
      
    </div>
    </header>
  </div>
</section>

<section class="section_nav">
  <div class="wrapper_global">
    <nav class="nav_hero">
      <?php
        //ジャンル一覧
        $args = array(
          'post_type' => 'shop',
          'taxonomy' => 'shop_genre', //タクソノミーを指定したい場合はcategoryをスラッグに書き換える
          'orderby'=>'description',
          'hide_empty' => false,//投稿がない場合も隠さずにだす
        );

        $output = 'names'; // names or objects, note names is the default
        $operator = 'and'; // 'and' or 'or'
        $post_types = get_categories( $args, $output, $operator ); 

        foreach ( $post_types  as $post_type ) {
          $linklabel = $post_type->slug;
          $linkname = $post_type->name;
          $linkeng = $post_type->description;
          $linkurl = get_category_link($post_type);

          //先頭の数字2文字を削除
          $str = $linkeng;//文字列
          $cut = 2;//カットしたい文字数
          $replace = substr( $str , $cut , strlen($str)-$cut );

          echo '<a  class="link_nav_hero link_nav_hero_'.$linklabel.'" href="' . esc_url( $linkurl ) . '">' . $linkname . '<span>'.$replace.'</span></a>';
        }
      ?>
    </nav>
  </div>
</section>

<?php
if(!is_home()){
  ?>
<section class="listnav">
  <div class="wrapper_global">
  <?php get_template_part('parts/nav_list', get_post_format()); ?>
  </div>
</section>
<?php
}
?>