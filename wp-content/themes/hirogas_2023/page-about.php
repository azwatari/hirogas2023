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
      
      <section class="section_about section_detail">
        <header class="header_section header_section_about header_section_detail">
          <h2>広ガスクーポンとは</h2>
        </header>
        <div class="content_section content_section_about content_section_detail">
          <article class="article_about article_detail">
            <div class="inner inner_about inner_about_content inner_detail">

            <?php
              $taxAbt = get_field('about_group1');
              $taxAbt_ttl=$taxAbt['about_title1'];
              $taxAbt_cst=$taxAbt['about_cost'];
              $taxAbt_grt=$taxAbt['about_grant'];
              $taxAbt_svy=$taxAbt['about_survey'];
              $taxAbt_ern=$taxAbt['about_earn'];
              $taxAbt_ex=$taxAbt['about_exchange'];
              $taxAbt_cpn=$taxAbt['about_coupon'];
              $taxAbt_stc=$taxAbt['about_sticker'];
              $taxAbt_pht=$taxAbt['about_photo'];
              $taxAbt_phtSp=$taxAbt['about_photo_mobile'];
              $taxAbt_stc_hdr=$taxAbt['about_sticker_header'];
              $taxAbt_stc_bdy=$taxAbt['about_sticker_body'];

              the_content();
              if($taxAbt_ttl){
                echo '<h3>'.$taxAbt_ttl.'</h3>';
              }
              if($taxAbt_cst || $taxAbt_grt || $taxAbt_svy || $taxAbt_ern || $taxAbt_ex || $taxAbt_cpn || $taxAbt_stc || $taxAbt_pht || $taxAbt_phtSp || $taxAbt_stc_hdr || $taxAbt_stc_bdy):
            ?>
              <div class="inner inner_about_content_coupon">
                <?php 
                  if(!$taxAbt_pht || !$taxAbt_phtSp):
                  ?>
                <dl class="coupon_pay">
                  <dt>ガス料金のお支払額</dt>
                  <dt>警報機リースのお支払額</dt>
                  <dd><span><?php echo $taxAbt_cst; ?></span>円（税込）につき<span><?php echo $taxAbt_grt; ?></span>ポイント！</dd>
                </dl>
                <dl class="coupon_answer">
                  <dt>アンケートへの回答</dt>
                  <dd><span><?php echo $taxAbt_svy; ?></span>p／回<span class="annotation">※アンケート内容により、たまるポイント数を変更（最大50P/回</span></dd>
                </dl>
                <dl class="coupon_exchange">
                  <dt>
                    <p><span><?php echo $taxAbt_ern; ?></span>ポイント<br />貯まると</p>
                  </dt>
                  <dd class="coupon_can_exchange"><span><?php echo $taxAbt_ex; ?></span>円分のクーポン券に交換できます！</dd>
                  <dd class="coupon_dummy"><img src="<?php echo $taxAbt_cpn; ?>" /></dd>
                  <dd class="coupon_annotation"><span class="annotation">※有効期限があります。クーポン発送より、約6カ月間です。</span></dd>
                </dl>
                <?php
                  else:
                    echo '<img class="coupon_photo coupon_photo_pc" src="'.$taxAbt_pht.'" />';
                    echo '<img class="coupon_photo coupon_photo_mobile" src="'.$taxAbt_phtSp.'" />';
                  endif;
                ?>
              </div>
              <?php endif; ?>
            </div>
            <div class="inner inner_about_content_sticker">
              <?php
                if($taxAbt_stc_hdr){
                  echo '<h3>';
                  echo  nl2br($taxAbt_stc_hdr);
                  echo '</h3>';
                }
              ?>
              <dl>
                <dt><img src="<?php echo $taxAbt_stc; ?>" /></dt>
                <dd>
                  <?php
                    if($taxAbt_stc_bdy){
                      echo  nl2br($taxAbt_stc_bdy);
                    }
                  ?>
                </dd>
              </dl>
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