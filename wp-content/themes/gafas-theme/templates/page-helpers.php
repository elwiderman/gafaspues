<?php
/* 
    Template name: Page Helpers
*/
get_header();
?>
<div class="single-page single-helpers">
    <section class="section-block section-content">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12 col-xl-4">
                    <h1 class="page-title"><?php the_title();?></h1>
                </div>
                <div class="col-12 col-xl-7">
                    <div class="content-wrap"><?php the_content();?></div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
get_footer();