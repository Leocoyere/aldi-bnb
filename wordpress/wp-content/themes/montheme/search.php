<?php get_header(); ?>

<?php
$category_ID = $_GET['category'];
?>
<?php if (have_posts()) : ?>
    <section class="posts-overview-container">
        <?php while (have_posts()) : ?>

            <?php the_post(); ?>

            <?php if ($category_ID) : ?>
                <?php if (get_the_category()[0]->cat_name == get_the_category_by_ID($category_ID)) : ?>
                    <a href="<?= get_post_permalink(); ?>" class="overview-container">

                        <div class="overview-image">
                            <?= get_the_post_thumbnail(); ?>
                        </div>

                        <div class="overview-data">
                            <h1 class="overview-title"><?php the_title(); ?></h1>

                            <div class="overview-infos">
                                <div class="overview-location">
                                    <span><?= get_post_meta(get_the_ID(), 'location')[0]; ?></span>
                                </div>

                                <div class="overview-price">
                                    <span>$<?= get_post_meta(get_the_ID(), 'price')[0]; ?> / night</span>
                                </div>
                            </div>
                        </div>

                    </a>
                <?php endif; ?>
            <?php else : ?>
                <a href="<?= get_post_permalink(); ?>" class="overview-container">

                    <div class="overview-image">
                        <?= get_the_post_thumbnail(); ?>
                    </div>

                    <div class="overview-data">
                        <h1 class="overview-title"><?php the_title(); ?></h1>

                        <div class="overview-infos">
                            <div class="overview-location">
                                <span><?= get_post_meta(get_the_ID(), 'location')[0]; ?></span>
                            </div>

                            <div class="overview-price">
                                <span>$<?= get_post_meta(get_the_ID(), 'price')[0]; ?> / night</span>
                            </div>
                        </div>
                    </div>

                </a>
            <?php endif; ?>
        <?php endwhile; ?>
    </section>


<?php endif; ?>

<?php get_footer(); ?>