<?php

add_action('after_setup_theme', 'wpheticSetupTheme');
function wpheticSetupTheme()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menu('header', 'Le menu du header mec');
}


add_action('wp_enqueue_scripts', 'theme_name_scripts');
function theme_name_scripts()
{
    wp_enqueue_style('bootstrap_css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
    wp_enqueue_script("bootstrap_js", "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js", [], false, true);
    wp_enqueue_style('style', get_stylesheet_uri() . "./style.css");
}

add_action('admin_post_wpaldibnb_form', function () {
    $user = filter_input(INPUT_POST, 'user_login');
    $password = filter_input(INPUT_POST, 'user_pass');
    $password_conf = filter_input(INPUT_POST, 'user_pass_conf');
    $email = filter_input(INPUT_POST, 'user_email');
    $profile_picture = filter_input(INPUT_POST, 'profile_picture');
    $first_name = filter_input(INPUT_POST, 'first_name');
    $last_name = filter_input(INPUT_POST, 'last_name');
    $description = filter_input(INPUT_POST, 'description');
    $userdata = ['user_login' => $user, 'user_pass' => $password, 'user_email' => $email, 'first_name' => $first_name, 'last_name' => $last_name, 'description' => $description, 'profile_picture' => $profile_picture];
    $result = wp_insert_user($userdata);
    wp_redirect(get_home_url());
});

add_action('admin_post_wppost_edit', function () {
    $post_id = filter_input(INPUT_POST, 'post_id');
    $post_status = filter_input(INPUT_POST, 'edit_action');
    $post_args = array(
        'ID' => $post_id,
        'post_status' => $post_status
    );
    $result = wp_update_post($post_args, true);
    wp_redirect(get_home_url());
});

add_action('admin_post_wpuser_edit', function () {
    $user_id = filter_input(INPUT_POST, 'user_id');
    $edit_action = filter_input(INPUT_POST, 'edit_action');
    if ($edit_action == 'delete') {
        $result = wp_delete_user($user_id);
        wp_redirect(get_home_url());
        exit();
    }
    $userdata = array(
        'ID' => $user_id,
        'role' => $edit_action
    );
    $result = wp_update_user($userdata);
    wp_redirect(get_home_url());
});

add_action('admin_post_comment_form', function () {
    $comment_post_ID = filter_input(INPUT_POST, 'comment_post_ID');
    $user_id = filter_input(INPUT_POST, 'user_id');
    $comment_content = filter_input(INPUT_POST, 'comment_content');
    $commentdata = array(
        'user_id' => $user_id,
        'comment_post_ID' => $comment_post_ID,
        'comment_content' => $comment_content,
        'comment_meta' => [
            'status' => 'pending'
        ]
    );
    $comment_id = wp_insert_comment($commentdata);
    wp_redirect(get_home_url());
});

add_action('admin_post_comment_edit', function () {
    $comment_id = filter_input(INPUT_POST, 'comment_ID');
    $edit_action = filter_input(INPUT_POST, 'edit_action');
    if ($edit_action == 'delete') {
        $result = wp_delete_comment($comment_id, true);
        wp_redirect(get_home_url());
        exit();
    }
    $commentdata = array(
        'comment_ID' => $comment_id,
        'comment_meta' => [
            'status' => 'publish'
        ]
    );
    wp_update_comment($commentdata);
    wp_redirect(get_home_url());
});

add_action('admin_post_wppost_form', function () {

    $title = filter_input(INPUT_POST, 'post_title');
    $content = filter_input(INPUT_POST, 'post_content');
    $location = filter_input(INPUT_POST, 'location');
    $price = filter_input(INPUT_POST, 'price');
    $type = filter_input(INPUT_POST, 'type');
    $guests = filter_input(INPUT_POST, 'guests');
    $post_args = array(
        'post_title' => $title,
        'post_content' => $content,
        'post_status' => 'pending',
        'post_category' => [$type],
        'meta_input' => [
            'location' => $location,
            'price' => $price,
            'guests' => $guests,
        ]
    );
    $post_id = wp_insert_post($post_args, true);
    if ($_POST) {
        if (!function_exists('wp_generate_attachment_metadata')) {
            require_once(ABSPATH . "wp-admin" . '/includes/image.php');
            require_once(ABSPATH . "wp-admin" . '/includes/file.php');
            require_once(ABSPATH . "wp-admin" . '/includes/media.php');
        }
        if ($_FILES) {
            foreach ($_FILES as $file => $array) {
                if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
                    return "upload error : " . $_FILES[$file]['error'];
                }
                $attach_id = media_handle_upload($file, $post_id);
                set_post_thumbnail($post_id, $attach_id);
            }
        }
    }
    wp_redirect(get_home_url());
});

add_filter('nav_menu_css_class', function ($classes) {
    $classes[] = "nav-item";
    return $classes;
});

add_filter('nav_menu_link_attributes', function ($attr) {
    $attr['class'] = 'nav-link';
    return $attr;
});


function wpheticPaginate()
{
    $pages = paginate_links(['type' => 'array']);
    if (!$pages) {
        return null;
    }

    ob_start();
    echo '<nav aria-label="Page navigation example">';
    echo '<ul class="pagination">';

    foreach ($pages as $page) {
        $active = strpos($page, 'current');
        $liClass = $active ? 'page-item active' : 'page-item';
        $page = str_replace('page-numbers', 'page-link', $page);

        echo sprintf('<li class="%s">%s</li>', $liClass, $page);
    }
    echo '</ul></nav>';

    return ob_get_clean();
}

require 'Classes/SponsoCheckbox.php';
$checkbox = new SponsoCheckbox('wpheticSponso');


function cptui_register_my_cpts_event()
{
    $labels = [
        "name" => __("Events", "custom-post-type-ui"),
        "singular_name" => __("Event", "custom-post-type-ui"),
    ];

    $args = [
        "label" => __("Events", "custom-post-type-ui"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "show_in_rest" => true,
        "has_archive" => true,
        "delete_with_user" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => ["slug" => "event", "with_front" => true],
        "query_var" => true,
        "supports" => ["title", "thumbnail", "custom-fields"],
        "show_in_graphql" => false,
    ];

    register_post_type("event", $args);

    $labelsTaxo = [
        'name' => 'Styles',
        'singular_name' => 'Style'
    ];

    $argsTaxo = [
        'labels' => $labelsTaxo,
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_admin_column' => true
    ];

    register_taxonomy('style', ['post'], $argsTaxo);
}

add_action('init', 'cptui_register_my_cpts_event');

add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {

    global $wp_version;
    if ($wp_version !== '4.7.1') {
        return $data;
    }

    $filetype = wp_check_filetype($filename, $mimes);

    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
}, 10, 4);

function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function fix_svg()
{
    echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
               width: 100% !important;
               height: auto !important;
          }
          </style>';
}
add_action('admin_head', 'fix_svg');

function change_wp_search_size($query)
{
    if ($query->is_search)
        $query->query_vars['posts_per_page'] = -1;

    return $query; // Return our modified query variables
}
add_filter('pre_get_posts', 'change_wp_search_size');
