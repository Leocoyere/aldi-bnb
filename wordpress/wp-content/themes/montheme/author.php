<?php get_header(); ?>

<?php
$role = get_userdata(get_current_user_id())->roles[0];
?>
<?php if ($role == "administrator") : ?>

    <section class="page-wrapper">

        <div class="data-container">
            <h2 class="post-subtitle">Users</h2>
            <?php foreach (get_users() as $user) : ?>
                <form action="<?= admin_url('admin-post.php'); ?>" method="POST" name="wpuser_edit">
                    <div class="user-container host">
                        <figure class="user-image">
                            <img src="" alt="">
                        </figure>
                        <div>
                            <div class="user-name">
                                <h3 class="user-fullname"><?= get_the_author_meta('first_name', $user->ID); ?> <?= get_the_author_meta('last_name', $user->ID); ?></h3>
                                <span class="user-username">@<?= get_the_author_meta('user_login', $user->ID); ?></span>
                            </div>
                            <p class="user-description"><?= get_the_author_meta('description', $user->ID); ?></p>
                        </div>
                    </div>
                    <input type="hidden" value="<?= $user->ID; ?>" name="user_id">
                    <input class="form-input" type="hidden" name="action" value="wpuser_edit">
                    <?php wp_referer_field(); ?>
                    </a>
                    <div class="edit-container">
                        <button class="form-button" type="submit" name="edit_action" value="delete">Delete</button>
                        <button class="form-button" type="submit" name="edit_action" value="administrator">upgrade to admin</button>
                    </div>
                </form>

            <?php endforeach; ?>


        </div>

        <div class="data-container">
            <h2 class="post-subtitle">Posts pending</h2>
            <section class="posts-overview-container">
                <?php
                $posts = get_posts(
                    array(
                        'post_status' => 'pending',
                    )
                );
                ?>
                <?php if ($posts) : ?>
                    <?php foreach ($posts as $post) : ?>

                        <?php the_post(); ?>

                        <form action="<?= admin_url('admin-post.php'); ?>" method="POST" name="wppost_edit">
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

                                <input type="hidden" value="<?= get_the_ID(); ?>" name="post_id">
                                <input class="form-input" type="hidden" name="action" value="wppost_edit">
                                <?php wp_referer_field(); ?>
                            </a>
                            <div class="edit-container">
                                <button class="form-button" type="submit" name="edit_action" value="trash">Delete</button>
                                <button class="form-button" type="submit" name="edit_action" value="publish">Publish</button>
                            </div>
                        </form>

                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No post found</p>
                <?php endif; ?>
            </section>
        </div>

        <div class="data-container">
            <h2 class="post-subtitle">Comments pending</h2>
            <section class="comments-container">
                <?php
                $comments = get_comments();
                ?>
                <?php if ($comments) : ?>
                    <?php foreach ($comments as $comment) : ?>
                        <?php if (get_comment_meta($comment->comment_ID, 'status')[0] == 'pending') : ?>
                            <form action="<?= admin_url('admin-post.php'); ?>" method="POST" name="comment_edit">
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
                                <input type="hidden" value="<?= ($comment->comment_ID); ?>" name="comment_ID">
                                <input class="form-input" type="hidden" name="action" value="comment_edit">
                                <?php wp_referer_field(); ?>

                                <div class="edit-container">
                                    <button class="form-button" type="submit" name="edit_action" value="delete">Delete</button>
                                    <button class="form-button" type="submit" name="edit_action" value="publish">Publish</button>
                                </div>
                            </form>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No comment found</p>
                <?php endif; ?>
            </section>
        </div>

    </section>

<?php else : ?>

    <h1 class="home-title wrapper-margin">Unauthorized</h1>
    <p class="wrapper-margin">Only administrators can access this page.</p>

<?php endif; ?>
<?php get_footer(); ?>