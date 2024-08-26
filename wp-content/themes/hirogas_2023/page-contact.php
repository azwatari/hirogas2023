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
      
      <section class="section_contact section_detail">
        <header class="header_section header_section_contact header_section_detail">
          <h2>お問い合わせ</h2>
        </header>
        <div class="content_section content_section_contact content_section_detail">
          <article class="article_contact article_detail">
            <div class="inner inner_contact inner_contact_content">

              <?php
                $taxNme = get_field('contact_name');
                $taxTel = get_field('contact_tel');
                $taxTel_name=$taxTel['contact_tel_name'];
                $taxTel_nmb=$taxTel['contact_tel_number'];
                $taxTme = get_field('contact_time');
                $taxTme_hur=$taxTme['contact_time_hour'];
                $taxTme_sup1=$taxTme['contact_time_supplement1'];
                $taxTme_sup2=$taxTme['contact_time_supplement'];
                $taxLnk1 = get_field('contact_grp1');
                $taxLnk1_ttl=$taxLnk1['contact_grp1_title'];
                $taxLnk1_url=$taxLnk1['contact_grp1_url'];
                $taxLnk2 = get_field('contact_grp2');
                $taxLnk2_ttl=$taxLnk2['contact_grp2_title'];
                $taxLnk2_url=$taxLnk2['contact_grp2_url'];

              ?>
              <?php
                if($taxNme){
                  echo '<h3>'.$taxNme.'</h3>';
                }
                if($taxTel_name || $taxTel_nmb){
                  echo '<dl class="navidial">';
                  echo '<dt>';
                  if($taxTel_name){
                    echo $taxTel_name;
                  }
                  echo '</dt>';
                  echo '<dd>';
                  if($taxTel_nmb){
                    echo $taxTel_nmb;
                  }
                  echo '</dd>';
                  echo '</dl>';
                }
                if($taxTme_hur || $taxTme_sup1 || $taxTme_sup2){
                  echo '<div class="inner inner_contact_content_hour">';
                  echo '<h4>受付時間</h4>';
                  echo '<p>';
                  if($taxTme_hur){
                    echo '<strong>';
                    echo $taxTme_hur;
                    echo '</strong>';
                  }
                  if($taxTme_sup1){
                    echo $taxTme_sup1;
                  };
                  if($taxTme_sup2){
                    echo '<span class="annotation">';
                    echo $taxTme_sup2;
                    echo '</span>';
                  }
                  echo '</p>';
                  echo '</div>';
                }
              ?>
              
              <?php
                if($taxLnk1_url || $taxLnk2_url){
                  echo '<div class="inner inner_contact_content_link">';
                  if($taxLnk1_url){
                    echo '<a class="link_external link_contact_external" href="'.$taxLnk1_url.'" target="_blank">'.$taxLnk1_ttl.'</a>';
                  }
                  if($taxLnk2_url){
                    echo '<a class="link_external link_contact_external" href="'.$taxLnk2_url.'" target="_blank">'.$taxLnk2_ttl.'</a>';
                  }
                  echo '</div>';
                }
              ?>
            </div>
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