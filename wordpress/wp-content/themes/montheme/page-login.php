<?php get_header(); ?>

<section class="form-page">
    <div class="form-image"></div>
    <div class="form-container">
        <div class="form-line"></div>
        <div class="form-title">
            <span class="subtitle">Welcome back</span>
            <h1 class="title">Login</h1>
        </div>
        <form class="form" action="<?= home_url('wp-login.php'); ?>" method="POST" name="form_login">
            <div class="form-row">
                <div class="input-container">
                    <label for="log">Username</label>
                    <input class="form-input" type="text" id="log" name="log">
                </div>
            </div>
            <div class="form-row">
                <div class="input-container">
                    <label for="pwd">Password</label>
                    <input class="form-input" type="password" id="pwd" name="pwd">
                </div>
            </div>
            <div class="form-line"></div>
            <div class="buttons-container">
                <a href="<?= get_home_url(); ?>" class="form-button">Back</a>
                <button class="form-button primary" name="wp-submit" type="submit">Submit</button>
            </div>
        </form>
    </div>
</section>

<?php get_footer(); ?>