<?php /* Template Name: conf1 */ ?>

<?php
get_header();

while (have_posts()) :
    the_post();
    vertoh_include_page_header();
    ?>
    <section class="fullwidth breadcrumbs">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="<?php echo home_url(); ?>"><?php _e('Home', 'vertoh'); ?></a></li>
                <li class="active"><?php the_title() ?></li>
            </ol>
        </div>
    </section>
    <section class="content " style="margin: 0px 0 !important;">
        <div class="container ">
        	<div id="home" style="background:url(http://www.conferences360.fr/wp-content/uploads/2016/03/Cong360-ImgSlider.jpg); height:396px; width:100%; color:#fff; background-size: 100%;">
            <header class="section-header" >
                <h1 style="color:#FFF; padding-top:150px; text-align:center;">GESTION DU RISQUE AMIANTE :</h1>
                <h2 style="color:#FFF;font-size:22px; text-align:center;">LES CLES OPERATIONNELLES DE REUSSITE POUR 2017. </h2>
                  <span><hr class="short bg-gold"  style="text-align:center;"></span>
                <h3 style="color:#FFF;font-size:16px; padding-botton:150px;">1<sup>ère</sup> ÉDITION : Jeudi 3 Novembre 2016  </h3>
            </header>
            </div>
            <?php the_content(); ?>
        </div>
    </section>
    <?php
endwhile;

get_footer();
