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
      <section class="section_newsdetail section_detail">

        <?php
          get_template_part('parts/content_news_single', get_post_format());
        ?>

      </section>

      <section class="section_back">
        <a class="link_back" href="javascript:history.back();">前のページに戻る</a>
      </section>
    </div>

    <aside>
      <?php get_template_part('parts/aside', get_post_format()); ?>
    </aside>

  </div>
</section>

<?php get_footer(); ?>