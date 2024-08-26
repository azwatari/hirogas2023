<?php
/**
 * The main template file
 * @link http://codex.wordpress.org/Template_Hierarchy
 * @package WordPress
 * @subpackage hirogas_2023
 * @since watari 1.0
 */
get_header(); ?>

<?php get_template_part('parts/header_global', get_post_format()); ?>


<section class="section_main section_main_separate">
  <div class="wrapper_global">
    <div class="section_contents_main">
      
      <section class="section_guide section_detail">
        <header class="header_section header_section_guide header_section_detail">
          <h2>ご利用ガイド</h2>
        </header>
        <div class="content_section content_section_guide">
          <article class="article_guide article_detail">

            <?php
              $taxGrp1 = get_field('guide_group1');
              $taxGrp1_ttl=$taxGrp1['guide_title1'];
              $taxGrp1_bdy=$taxGrp1['guide_body1'];
              $taxGrp1_lnk=$taxGrp1['guide_link_text1'];
              $taxGrp1_url=$taxGrp1['guide_link_url1'];
              $taxGrp1_url_in=mb_substr($taxGrp1_url, 0, 4);
              $taxGrp2 = get_field('guide_group2');
              $taxGrp2_ttl=$taxGrp2['guide_title2'];
              $taxGrp2_bdy=$taxGrp2['guide_body2'];
              $taxGrp2_lnk=$taxGrp2['guide_link_text2'];
              $taxGrp2_url=$taxGrp2['guide_link_url2'];
              $taxGrp2_url_in=mb_substr($taxGrp2_url, 0, 4);
              $taxGrp3 = get_field('guide_group3');
              $taxGrp3_ttl=$taxGrp3['guide_title3'];
              $taxGrp3_bdy=$taxGrp3['guide_body3'];
              $taxGrp3_lnk=$taxGrp3['guide_link_text3'];
              $taxGrp3_url=$taxGrp3['guide_link_url3'];
              $taxGrp3_url_in=mb_substr($taxGrp3_url, 0, 4);
              $taxGrp4 = get_field('guide_group4');
              $taxGrp4_ttl=$taxGrp4['guide_title4'];
              $taxGrp4_bdy=$taxGrp4['guide_body4'];
              $taxGrp4_lnk=$taxGrp4['guide_link_text4'];
              $taxGrp4_url=$taxGrp4['guide_link_url4'];
              $taxGrp4_url_in=mb_substr($taxGrp4_url, 0, 4);
            ?>
            
            <?php 
              if($taxGrp1_ttl){
                echo '<div class="inner inner_guide inner_guide_administration inner_detail">';
                echo '<h3>';
                echo $taxGrp1_ttl;
                echo '</h3>';
              }
            ?>
            <p>
              <?php 
                if($taxGrp1_bdy){
                  echo $taxGrp1_bdy;
                }
              ?>
            </p>
            <?php
              if($taxGrp1_lnk){
                echo '<div class="inner inner_content_footer inner_content_guide_footer">';
                if($taxGrp1_url_in=='http'){
                  echo '<a class="link_external link_guide_external link_show_detail link_external_gas" href="'.$taxGrp1_url.'" target="_blank">'.$taxGrp1_lnk.'</a>';
                }else{
                  echo '<a class="link_show_detail" href="'.$taxGrp1_url.'">'.$taxGrp1_lnk.'</a>';
                }
                echo '</div>';
              }
              if($taxGrp1_ttl){
                echo '</div>';
              }
            ?>
              
            <?php 
              if($taxGrp2_ttl){
                echo '<div class="inner inner_guide inner_guide_administration inner_detail">';
                echo '<h3>';
                echo $taxGrp2_ttl;
                echo '</h3>';
              }
            ?>
            <p>
              <?php 
                if($taxGrp2_bdy){
                  echo $taxGrp2_bdy;
                }
              ?>
            </p>
            <?php
              if($taxGrp2_url){
                echo '<div class="inner inner_content_footer inner_content_guide_footer">';
                if($taxGrp2_url_in=='http'){
                  echo '<a class="link_external link_guide_external link_show_detail link_external_gas" href="'.$taxGrp2_url.'" target="_blank">'.$taxGrp2_lnk.'</a>';
                }else{
                  echo '<a class="link_show_detail" href="'.$taxGrp2_url.'">'.$taxGrp2_lnk.'</a>';
                }
                echo '</div>';
              }
              if($taxGrp2_ttl){
                echo '</div>';
              }
            ?>
              
            <?php 
                if($taxGrp3_ttl){
                  echo '<div class="inner inner_guide inner_guide_administration inner_detail">';
                  echo '<h3>';
                  echo $taxGrp3_ttl;
                  echo '</h3>';
                }
              ?>
            <p>
              <?php 
                if($taxGrp3_bdy){
                  echo $taxGrp3_bdy;
                }
              ?>
            </p>
            <?php
              if($taxGrp3_url){
                echo '<div class="inner inner_content_footer inner_content_guide_footer">';
                if($taxGrp3_url_in=='http'){
                  echo '<a class="link_external link_guide_external link_show_detail link_external_gas" href="'.$taxGrp3_url.'" target="_blank">'.$taxGrp3_lnk.'</a>';
                }else{
                  echo '<a class="link_show_detail" href="'.$taxGrp3_url.'">'.$taxGrp3_lnk.'</a>';
                }
                echo '</div>';
              }
              if($taxGrp3_ttl){
                echo '</div>';
              }
            ?>
              
            <?php 
              if($taxGrp4_ttl){
                echo '<div class="inner inner_guide inner_guide_administration inner_detail">';
                echo '<h3>';
                echo $taxGrp4_ttl;
                echo '</h3>';
              }
            ?>
            <p>
              <?php 
                if($taxGrp4_bdy){
                  echo $taxGrp4_bdy;
                }
              ?>
            </p>
            <?php
            if($taxGrp4_url){
              echo '<div class="inner inner_content_footer inner_content_guide_footer">';
              if($taxGrp4_url_in=='http'){
                echo '<a class="link_external link_guide_external link_show_detail link_external_gas" href="'.$taxGrp4_url.'" target="_blank">'.$taxGrp4_lnk.'</a>';
              }else{
                echo '<a class="link_show_detail" href="'.$taxGrp4_url.'">'.$taxGrp4_lnk.'</a>';
              }
              echo '</div>';
            }
            if($taxGrp4_ttl){
              echo '</div>';
            }
            ?>
            
          </article>
        </div>
      </section>
    </div>

    <aside>
      <?php get_template_part('parts/aside', get_post_format()); ?>
    </aside>

  </div>
</section>

<?php get_footer(); ?>