
<div class="box_map_areamap">
  <h3>エリアで探す</h3>
  <?php
    //https://akonomunon.hatenablog.com/entry/2015/08/19/144936
    //【Wordpress】カスタムタクソノミーを階層表示させるには
    //↑のサイトを参考
    $select_tax = 'shop_area';
    $terms = get_terms($select_tax,['parent' => 0, 'hide_empty' => false]);
    foreach ( $terms as $term ) {
      echo '<a class="link_map_areamap link_map_areamap_'.$term->slug.'" href="'.get_term_link($term).'">'.esc_html($term->name).'</a>';
      wp_reset_postdata();
    }
  ?>
</div>

<div class="box_list_areamap">
  <?php
    //https://akonomunon.hatenablog.com/entry/2015/08/19/144936
    //【Wordpress】カスタムタクソノミーを階層表示させるには
    //↑のサイトを参考
    $select_tax = 'shop_area';
    $terms = get_terms($select_tax,['parent' => 0,'hide_empty' => false,'orderby' => 'description']);
    foreach ( $terms as $term ) {
      echo '<dl class="list_area_areamap">';
      echo '<dt>'.esc_html($term->name).'</dt>';

      $children = get_terms('shop_area','hide_empty=0&hierarchical=0&parent='.$term->term_id);
      if($children){//子があるなら
        $parentId = $term->term_id;
        $childargs = array(
          'parent' => $parentId,
          'hide_empty' => false,//投稿がない場合も隠さずにだす
          'orderby'=>'description',
        );
        $childterms = get_terms($select_tax,$childargs);
          foreach ($childterms as $childterm) {
            $targetSlug = $childterm->slug;
            $str = $childterm->description;//文字列
            $cut = 2;//カットしたい文字数
            $replace = substr( $str , $cut , strlen($str)-$cut );
            echo '<dd><a href="'.get_term_link($childterm).'">'.$replace.'</a></dd>';
        }
      }
      wp_reset_postdata();
      echo '</dl>';
    }
  ?>
</div>