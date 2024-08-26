<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage hirogas_2023
 * @since watari 1.0
 */
?>

<footer class="footer_global">
  <button class="btn_to_top"><span>Topへ</span></button>
  <nav class="nav_footer_static">
    <div class="wrapper_global">
      <ul class="list_footer_static">
        <li><a class="link_footer_static" href="<?php bloginfo('url')?>">Topページ</a></li>
        <?php
          $args = array(
            'public'   => true, // 真偽値。true のとき、公開された（public な）投稿タイプのみが返されます。
          );
          $output = 'names'; // （文字列） （オプション） 戻り値の型を指定します。'names'（名前）または 'objects'（オブジェクト）。
          $operator = 'and'; //（文字列） （オプション） $args で複数の条件を指定する場合の演算子（'and' または 'or'）。
          $post_types = get_post_types( $args, $output, $operator ); 
          arsort( $post_types );

          //「各種設定」ページのid取得
          $settings = get_page_by_path('settings');
          $settingsId = get_post( $settings );
          //echo $settingsId->ID;     //IDを表示
          foreach ( $post_types  as $post_type ) {
            $object = get_post_type_object( $post_type );
            $object_name = $object->name;
            $object_url=$object->rewrite['slug'];
            if( ($object_name != 'page') and ($object_name != 'attachment') and ($object_name != 'revision') and ($object_name != 'nav_menu_item')){
              echo '<li><a class="link_footer_static" href="/'.$object_url.'">'.$object->label.'</a></li>';
            }elseif($object_name=='page'){
                $page_list = get_posts( 'numberposts=-1&order=ASC&orderby=date&post_type=page&exclude='.$settingsId->ID.'' ); // ページ情報の取得
              foreach ( $page_list as $page_item ) {
                echo '<li><a class="link_footer_static" href="'. get_page_link($page_item->ID).'">'.get_the_title($page_item->ID).'</a></li>'; // ページの情報を表示
              }
            }
          }
          
          /*
          //カスタム投稿、post、固定ページ、各別出力
          $args = array(
            'public'   => true,
            '_builtin' => false,
          );
          $cp_types = get_post_types( $args, 'names', 'and' );

          if ( ! empty( $cp_types ) ) {
            foreach ( $cp_types as $cp_name ) {
            $cp_data = get_post_type_object( $cp_name );
              if ( $cp_data->has_archive == 1 ) {
                $cp_url = get_post_type_archive_link( $cp_name );
                echo "  <li class=\"sm-list__item\">\n";
                echo '    <a class="link_footer_static" href="' . esc_url( $cp_url ) . '">' . esc_html( $cp_data->label ) . "</a>\n";
                echo "  </li>\n";
              }
            }
          }
          ?>
          <li><a class="link_footer_static" href="/news/">ニュース・キャンペーン情報</a></li>
          <?php // 固定ページ一覧を表示する
            $page_list = get_posts( 'numberposts=-1&order=ASC&orderby=date&post_type=page&exclude=170,178' ); // ページ情報の取得
            foreach ( $page_list as $page_item ) {
              echo '<li><a class="link_footer_static" href="'. get_page_link($page_item->ID).'">'.get_the_title($page_item->ID).'</a></li>'; // ページの情報を表示
            }
          */
        ?>
      </ul>
    </div>
  </nav>

  <?php
    //「各種設定」ページのid取得
    $settings = get_page_by_path('settings');
    $settingsId = get_post( $settings );
    //echo $settingsId->ID;     //IDを表示
    $taxHrgsNv = get_field('setting_hirogas_nav',$settingsId->ID);
    $taxHrgsNv_f1 = $taxHrgsNv['setting_hirogas_footer1'];
    $taxHrgsNv_ft1 = $taxHrgsNv_f1['setting_hirogas_footer1_txt'];
    $taxHrgsNv_fu1 = $taxHrgsNv_f1['setting_hirogas_footer1_url'];
    $taxHrgsNv_f2 = $taxHrgsNv['setting_hirogas_footer2'];
    $taxHrgsNv_ft2 = $taxHrgsNv_f2['setting_hirogas_footer2_txt'];
    $taxHrgsNv_fu2 = $taxHrgsNv_f2['setting_hirogas_footer2_url'];
    $taxHrgsNv_f3 = $taxHrgsNv['setting_hirogas_footer3'];
    $taxHrgsNv_ft3 = $taxHrgsNv_f3['setting_hirogas_footer3_txt'];
    $taxHrgsNv_fu3 = $taxHrgsNv_f3['setting_hirogas_footer3_url'];
    $taxHrgsNv_f4 = $taxHrgsNv['setting_hirogas_footer4'];
    $taxHrgsNv_ft4 = $taxHrgsNv_f4['setting_hirogas_footer4_txt'];
    $taxHrgsNv_fu4 = $taxHrgsNv_f4['setting_hirogas_footer4_url'];
    $taxHrgsNv_f5 = $taxHrgsNv['setting_hirogas_footer5'];
    $taxHrgsNv_ft5 = $taxHrgsNv_f5['setting_hirogas_footer5_txt'];
    $taxHrgsNv_fu5 = $taxHrgsNv_f5['setting_hirogas_footer5_url'];
  ?>
  <nav class="nav_footer_gas">
    <div class="wrapper_global">
      <a class="title_footer_gas" href="http://www.hiroshima-gas.co.jp/" target="_blank">広島ガス</a>
      <ul class="list_footer_gas">
        <?php
          if($taxHrgsNv_fu1 && $taxHrgsNv_ft1){
            echo '<li>';
            echo '<a class="link_footer_gas" href="'.$taxHrgsNv_fu1.'" target="_blank">'.$taxHrgsNv_ft1.'</a>';
            echo '</li>';
          }
          if($taxHrgsNv_fu2 && $taxHrgsNv_ft2){
            echo '<li>';
            echo '<a class="link_footer_gas" href="'.$taxHrgsNv_fu2.'" target="_blank">'.$taxHrgsNv_ft2.'</a>';
            echo '</li>';
          }
          if($taxHrgsNv_fu3 && $taxHrgsNv_ft3){
            echo '<li>';
            echo '<a class="link_footer_gas" href="'.$taxHrgsNv_fu3.'" target="_blank">'.$taxHrgsNv_ft3.'</a>';
            echo '</li>';
          }
          if($taxHrgsNv_fu4 && $taxHrgsNv_ft4){
            echo '<li>';
            echo '<a class="link_footer_gas" href="'.$taxHrgsNv_fu4.'" target="_blank">'.$taxHrgsNv_ft4.'</a>';
            echo '</li>';
          }
          if($taxHrgsNv_fu5 && $taxHrgsNv_ft5){
            echo '<li>';
            echo '<a class="link_footer_gas" href="'.$taxHrgsNv_fu5.'" target="_blank">'.$taxHrgsNv_ft5.'</a>';
            echo '</li>';
          }
        ?>
      </ul>
    </div>
  </nav>
  <?php date_default_timezone_set('Asia/Tokyo'); ?>
  <p class="copyright">Copyright <?php echo date( 'Y' ); ?>.HIROSHIMA GAS Co.,Ltd. All Rights Reserved.</p>
</footer>

<?php wp_footer(); ?>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Z9QXMG9BM1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-Z9QXMG9BM1');
</script>
</body>
</html>