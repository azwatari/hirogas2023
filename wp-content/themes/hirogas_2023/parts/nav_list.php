<ul class="list_listnav">
  <li>
    <a href="<?php echo home_url(); ?>">トップページ</a>
  </li>
  <?php
    if(is_single()){
      $post_type = get_post_type( );
      $obj = get_post_type_object($post_type);
      echo '<li><a href="/'.$obj->rewrite['slug'].'">'.$obj->labels->name.'</a></li>';
      //echo '<li>'.$obj->labels->name.'</li>';
    }elseif(is_page()){
      $post_type = get_post_field( 'post_title', get_the_ID() );
      $post_url = get_page_link();
      //echo '<li><a href="'.$post_url.'">'.$post_type.'</a></li>';
      echo '<li>'.$post_type.'</li>';
    }elseif(is_tax()){
      $taxonomy = get_query_var('taxonomy');
      $post_type = get_taxonomy($taxonomy)->object_type[0];
      $obj = get_post_type_object($post_type);
      //echo '<li><a href="/'.$obj->rewrite['slug'].'">'.$obj->labels->name.'</a></li>';
      echo '<li>'.$obj->labels->name.'</li>';
    }elseif(is_search()){
        $post_type = get_post_type(); 
        $obj = get_post_type_object($post_type);
        echo '<li><a href="/'.$obj->rewrite['slug'].'">'.$obj->labels->name.'</a></li>';
        //echo '<li>'.$obj->labels->name.'</li>';
      }else{
      $post_type = get_query_var('post_type'); 
      $obj = get_post_type_object($post_type);
      //echo '<li><a href="/'.$obj->rewrite['slug'].'">'.$obj->labels->name.'</a></li>';
      echo '<li>'.$obj->labels->name.'</li>';
    }
  ?>
</ul>