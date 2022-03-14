<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <section class="page-wrapper post-container">
        <?php while (have_posts()) : ?>

            <?php the_post(); ?>

            <div class="infos-container">
                <div class="info">
                    <img class='info-icon' src="http://localhost:2345/wp-content/uploads/2022/03/location.svg" alt="">
                    <span><?= get_post_meta(get_the_ID(), 'location')[0]; ?></span>
                </div>
                <div class="info">
                    <img class='info-icon' src="http://localhost:2345/wp-content/uploads/2022/03/guests.svg" alt="">
                    <span><?= get_post_meta(get_the_ID(), 'guests')[0]; ?></span>
                </div>
                <div class="info">
                    <img class='info-icon' src="http://localhost:2345/wp-content/uploads/2022/03/house.svg" alt="">
                    <span><?= get_post_meta(get_the_ID(), 'type')[0]; ?></span>
                </div>
            </div>

            <h1 class="post-title"><?php the_title(); ?></h1>

            <div class="image-container">
                <?= get_the_post_thumbnail(); ?>
            </div>

            <p class="post-content"><?php the_content(); ?></p>

            <div class="data-container">
                <h2 class="post-subtitle">Pricing</h2>
                <p class="post-price">$<?= get_post_meta(get_the_ID(), 'price')[0]; ?> / nights</p>
            </div>

            <div class="data-container">
                <h2 class="post-subtitle">Hosted by...</h2>
                <div class="user-container host">
                    <figure class="user-image">
                        <img src="" alt="">
                    </figure>
                    <div>
                        <div class="user-name">
                            <h3 class="user-fullname"><?= get_the_author_meta('first_name'); ?> <?= get_the_author_meta('last_name'); ?></h3>
                            <span class="user-username">@<?= get_the_author_meta('user_login'); ?></span>
                        </div>
                        <p class="user-description"><?= get_the_author_meta('description'); ?></p>
                    </div>
                </div>
            </div>

            <div class="data-container">
                <h2 class="post-subtitle">Add new comment</h2>
                <form action="<?= admin_url('admin-post.php'); ?>" method="POST" name="comment_form">
                    <div class="form-row">
                        <div class="input-container large">
                            <label for="comment_content">Comment</label>
                            <textarea class="tall" id="comment_content" name="comment_content"></textarea>
                        </div>
                    </div>
                    <input type="hidden" value="<?= get_current_user_id(); ?>" name="user_id">
                    <input type="hidden" value="<?= get_the_ID(); ?>" name="comment_post_ID">
                    <input type="hidden" name="action" value="comment_form">
                    <?php wp_referer_field(); ?>
                    <div class="buttons-container">
                        <button class="form-button" type="submit">post</button>
                    </div>
                </form>
            </div>

            <div class="data-container">
                <h2 class="post-subtitle">Comments</h2>
                <div class="comments-container">
                    <?php
                    $comments = get_comments(
                        array(
                            'post_id' => get_the_ID()
                        )
                    );
                    ?>
                    <?php if ($comments) : ?>
                        <?php foreach ($comments as $comment) : ?>
                            <?php if (get_comment_meta($comment->comment_ID, 'status')[0] == 'publish') : ?>
                                <div class="user-container comment">
                                    <div class="user-head">
                                        <figure class="user-image">
                                            <img src="" alt="">
                                        </figure>
                                        <div class="user-name">
                                            <h3 class="user-fullname"><?= get_user_meta($comment->user_id, 'first_name')[0] ?> <?= get_user_meta($comment->user_id, 'last_name')[0] ?></h3>
                                            <span class="user-username">@<?= get_userdata($comment->user_id)->user_login ?></span>
                                        </div>
                                    </div>
                                    <p class="user-description"><?= $comment->comment_content ?></p>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>no comments found</p>
                    <?php endif; ?>
                </div>
            </div>

        <?php endwhile; ?>

    </section>

<?php endif; ?>

<?php get_footer(); ?>