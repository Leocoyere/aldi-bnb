<?php get_header(); ?>

<section class="form-page">
    <div class="form-image"></div>
    <div class="form-container">
        <div class="form-line"></div>
        <div class="form-title">
            <span class="subtitle">Post your destination!</span>
            <h1 class="title">New post</h1>
        </div>
        <form class="form" action="<?= admin_url('admin-post.php'); ?>" method="POST" name="wppost_form" enctype="multipart/form-data">
            <?php var_dump(get_categories()); ?>
            <div class="form-row">
                <div class="input-container">
                    <label for="post_title">Title</label>
                    <input class="form-input" type="text" id="post_title" name="post_title">
                </div>
                <div class="input-container">
                    <label for="location">Location</label>
                    <input class="form-input" type="text" id="location" name="location">
                </div>
            </div>
            <div class="form-row">
                <div class="input-container large">
                    <label for="description">Description</label>
                    <textarea class="tall" id="description" name="post_content"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="input-container">
                    <label for="price">Price</label>
                    <input class="form-input" type="number" id="price" name="price">
                </div>
                <div class="input-container">
                    <label for="type">Type</label>
                    <select class="form-input" name="type" id="type">
                        <option value="6">hotel</option>
                        <option value="7">apartment</option>
                        <option value="8">villa</option>
                        <option value="9">chalet</option>
                        <option value="10">cotage</option>
                        <option value="11">camping</option>
                        <option value="12">guesthouse</option>
                        <option value="13">boat</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="input-container type-file">
                    <label for="image_upload">Image</label>
                    <input class="form-input tall" type="file" id="image_upload" name="image_upload" multiple="false">
                </div>
                <input class="form-input" type="hidden" name="action" value="wppost_form">
                <?php wp_referer_field(); ?>
                <?php wp_nonce_field('image_upload', 'image_upload_nonce'); ?>
                <div class="form-column">
                    <div class="input-container">
                        <label for="guest_number">Guests</label>
                        <input class="form-input" type="number" id="guest_number" name="guest_number">
                    </div>
                </div>
            </div>
            <div class="form-line"></div>
            <div class="buttons-container">
                <a href="<?= get_home_url(); ?>" class="form-button">Back</a>
                <button class="form-button primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
</section>

<?php get_footer(); ?>