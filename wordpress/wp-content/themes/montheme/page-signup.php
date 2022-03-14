<?php get_header(); ?>

<section class="form-page">
	<div class="form-image"></div>
	<div class="form-container">
		<div class="form-line"></div>
		<div class="form-title">
			<span class="subtitle">nice to meet you!</span>
			<h1 class="title">New user</h1>
		</div>
		<form class="form" action="<?= admin_url('admin-post.php'); ?>" method="POST" name="wpaldibnb_form">
			<div class="form-row">
				<div class="input-container">
					<label for="first_name">First name</label>
					<input class="form-input" type="text" id="first_name" name="first_name">
				</div>
				<div class="input-container">
					<label for="last_name">Last name</label>
					<input class="form-input" type="text" id="last_name" name="last_name">
				</div>
			</div>
			<div class="form-row">
				<div class="input-container large">
					<label for="description">Description</label>
					<textarea class="tall" id="description" name="description"></textarea>
				</div>
			</div>
			<div class="form-row">
				<div class="input-container">
					<label for="user_login">Username</label>
					<input class="form-input" type="text" id="user_login" name="user_login">
				</div>
				<div class="input-container">
					<label for="user_email">Email</label>
					<input class="form-input" type="mail" id="user_email" name="user_email">
				</div>
			</div>
			<div class="form-row">
				<div class="input-container">
					<label for="user_pass">Password</label>
					<input class="form-input" type="password" id="user_pass" name="user_pass">
				</div>
				<div class="input-container">
					<label for="user_pass_conf">Confirm password</label>
					<input class="form-input" type="password" id="user_pass_conf" name="user_pass_conf">
				</div>
			</div>
			<input class="form-input" type="hidden" name="action" value="wpaldibnb_form">
			<?php wp_referer_field(); ?>
			<div class="form-line"></div>
			<div class="buttons-container">
				<a href="<?= get_home_url(); ?>" class="form-button">Back</a>
				<button class="form-button primary" type="submit" name="pagination" value="2">Submit</button>
			</div>
		</form>
	</div>
</section>

<?php get_footer(); ?>