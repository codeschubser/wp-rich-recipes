<?php
/**
Plugin Name: WP Rich Recipes
Description: SEO friendly rich snippet recipes.
Author: Codeschubser.de
Author URI: https://codeschubser.de
Plugin URI: https://codeschubser.de/wprichrecipes
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
Version: 1.4
Text Domain: wprichrecipes
Domain Path: /languages
GitHub Plugin URI: codeschubser/wp-rich-recipes
*/

/* Sicherheitsabfrage */
if (!class_exists('WP')) {
    die();
}

/**
 * Make theme available for translation.
 * Translations can be filed in the /languages/ directory.
 * If you're building a plugin based on wprichrecipes, use a find and replace
 * to change 'wprichrecipes' to the name of your theme in all the template files.
 *
 * @since WP Rich Recipes 1.4
 */
function wprr_load_textdomain()
{
    load_plugin_textdomain('wprichrecipes', false, dirname
            (plugin_basename(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'wprr_load_textdomain');

/**
 * Register a custom post type for recipes.
 *
 * @since WP Rich Recipes 1.4
 */
function wprr_register_recipe_post_type()
{
    $labels = array(
        'name' => _x('Recipes', 'Post Type General Name', 'wprichrecipes'),
        'singular_name' => _x('Recipe', 'Post Type Singular Name', 'wprichrecipes'),
        'menu_name' => __('Recipes', 'wprichrecipes'),
        'parent_item_colon' => __('Parent recipe:', 'wprichrecipes'),
        'all_items' => __('All recipes', 'wprichrecipes'),
        'view_item' => __('View recipe', 'wprichrecipes'),
        'add_new_item' => __('Add new recipe', 'wprichrecipes'),
        'add_new' => __('Add new', 'wprichrecipes'),
        'edit_item' => __('Edit recipe', 'wprichrecipes'),
        'update_item' => __('Update recipe', 'wprichrecipes'),
        'search_items' => __('Search recipe', 'wprichrecipes'),
        'not_found' => __('Not found', 'wprichrecipes'),
        'not_found_in_trash' => __('Not found in trash', 'wprichrecipes'),
    );
    $rewrite = array(
        'slug' => __('recipe', 'wprichrecipes'),
        'with_front' => true,
        'pages' => true,
        'feeds' => true,
    );
    $args = array(
        'label' => __('recipes', 'wprichrecipes'),
        'description' => __('A recipe custom post type', 'wprichrecipes'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'comments',),
        'taxonomies' => array('ingredient', 'cuisine', 'category', 'post_tag'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-store',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'rewrite' => $rewrite,
        'capability_type' => 'post',
    );
    register_post_type('rich-recipe', $args);
}
add_action('init', 'wprr_register_recipe_post_type');

/**
 * Register a custom taxonomy for recipe ingredients.
 *
 * @since WP Rich Recipes 1.4
 */
function wprr_register_taxonomy_ingredients()
{
    $labels = array(
        'name' => _x('Ingredients', 'Taxonomy General Name', 'wprichrecipes'),
        'singular_name' => _x('Ingredient', 'Taxonomy Singular Name', 'wprichrecipes'),
        'menu_name' => __('Ingredients', 'wprichrecipes'),
        'all_items' => __('All ingredients', 'wprichrecipes'),
        'parent_item' => __('Parent ingredient', 'wprichrecipes'),
        'parent_item_colon' => __('Parent ingredient:', 'wprichrecipes'),
        'new_item_name' => __('New ingredient name', 'wprichrecipes'),
        'add_new_item' => __('Add new ingredient', 'wprichrecipes'),
        'edit_item' => __('Edit ingredient', 'wprichrecipes'),
        'update_item' => __('Update ingredient', 'wprichrecipes'),
        'separate_items_with_commas' => __('Separate ingredients with commas', 'wprichrecipes'),
        'search_items' => __('Search ingredients', 'wprichrecipes'),
        'add_or_remove_items' => __('Add or remove ingredients', 'wprichrecipes'),
        'choose_from_most_used' => __('Choose from the most used ingredients', 'wprichrecipes'),
        'not_found' => __('Not Found', 'wprichrecipes'),
    );
    $rewrite = array(
        'slug' => __('ingredient', 'wprichrecipes'),
        'with_front' => true,
        'hierarchical' => false,
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'rewrite' => $rewrite,
    );
    register_taxonomy('ingredient', array('rich-recipe'), $args);
}
add_action('init', 'wprr_register_taxonomy_ingredients');

/**
 * Register a custom taxonomy for recipe cuisine.
 *
 * @since WP Rich Recipes 1.4
 */
function wprr_register_taxonomy_cuisine()
{
    $labels = array(
        'name' => _x('Cuisine', 'Taxonomy General Name', 'wprichrecipes'),
        'singular_name' => _x('Cuisine', 'Taxonomy Singular Name', 'wprichrecipes'),
        'menu_name' => __('Cuisine', 'wprichrecipes'),
        'all_items' => __('All cuisine', 'wprichrecipes'),
        'parent_item' => __('Parent cuisine', 'wprichrecipes'),
        'parent_item_colon' => __('Parent cuisine:', 'wprichrecipes'),
        'new_item_name' => __('New cuisine name', 'wprichrecipes'),
        'add_new_item' => __('Add new cuisine', 'wprichrecipes'),
        'edit_item' => __('Edit cuisine', 'wprichrecipes'),
        'update_item' => __('Update cuisine', 'wprichrecipes'),
        'separate_items_with_commas' => __('Separate cuisine with commas', 'wprichrecipes'),
        'search_items' => __('Search cuisine', 'wprichrecipes'),
        'add_or_remove_items' => __('Add or remove cuisine', 'wprichrecipes'),
        'choose_from_most_used' => __('Choose from the most used cuisine', 'wprichrecipes'),
        'not_found' => __('Not Found', 'wprichrecipes'),
    );
    $rewrite = array(
        'slug' => __('cuisine', 'wprichrecipes'),
        'with_front' => true,
        'hierarchical' => false,
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'rewrite' => $rewrite,
    );
    register_taxonomy('cuisine', array('rich-recipe'), $args);
}
add_action('init', 'wprr_register_taxonomy_cuisine');

/**
 * Add the custom post type to WordPress loop.
 *
 * @since WP Rich Recipes 1.4
 *
 * @see http://bueltge.de/wordpress-custom-post-types-in-den-loop-holen/1277/
 *
 * @param object $query
 * @return object
 */
function wprr_add_post_type_to_query($query)
{
    if (is_admin() || is_preview()) {
        return;
    }

    if (!isset($query->query_vars['suppress_filters'])) {
        $query->query_vars['suppress_filters'] = false;
    }

    if (false == $query->query_vars['suppress_filters']) {
        // Add Query only if not is a page
        if (!is_page()) {
            $query->set('post_type', array('post', 'rich-recipe'));
        }
    }

    return $query;
}
add_filter('pre_get_posts', 'wprr_add_post_type_to_query');

/**
 * Add a custom meta box.
 *
 * @since WP Rich Recipes 1.4
 *
 * @param string $post_type
 */
function wprr_add_recipe_metabox($post_type)
{
    $post_types = array('rich-recipe');
    if (in_array($post_type, $post_types)) {
        add_meta_box(
            'wprr_meta_box', __('Recipe properties', 'wprichrecipes'),
            'wprr_render_meta_box_content', $post_type, 'normal', 'high'
        );
    }
}
add_action('add_meta_boxes', 'wprr_add_recipe_metabox');

/**
 * Render the meta box content.
 *
 * @since WP Rich Recipes 1.4
 *
 * @param type $post
 * @return string
 */
function wprr_render_meta_box_content($post)
{
    // get all meta for this post
    $meta = get_post_meta($post->ID);

    $prep_time = !isset($meta['wprr_prep_time'][0]) ? null : $meta['wprr_prep_time'][0];
    $cook_time = !isset($meta['wprr_cook_time'][0]) ? null : $meta['wprr_cook_time'][0];
    $total_time = !isset($meta['wprr_total_time'][0]) ? null : $meta['wprr_total_time'][0];
    $yield = !isset($meta['wprr_yield'][0]) ? null : $meta['wprr_yield'][0];

    wp_nonce_field(basename(__FILE__), 'wprr_meta_box')
?>
    <table>
        <tr>
            <td><?php _e('Prep time:', 'wprichrecipes'); ?></td>
            <td>
                <input id="wprr_prep_time" type="text" name="wprr_prep_time" value="<?php echo $prep_time; ?>">
                <span class="description">
                    <?php _e('e.g. 15 Minutes, 1 Hour, 3 Hours and 20 Minutes',
                            'wprichrecipes'); ?>
                </span>
            </td>
        </tr>
        <tr>
            <td><?php _e('Cook time:', 'wprichrecipes'); ?></td>
            <td>
                <input id="wprr_cook_time" type="text" name="wprr_cook_time" value="<?php echo $cook_time; ?>">
                <span class="description">
                    <?php _e('e.g. 15 Minutes, 1 Hour, 3 Hours and 20 Minutes',
                            'wprichrecipes'); ?>
                </span>
            </td>
        </tr>
        <tr>
            <td><?php _e('Total time:', 'wprichrecipes'); ?></td>
            <td>
                <input id="wprr_total_time" type="text" name="wprr_total_time" value="<?php echo $total_time; ?>">
                <span class="description">
                    <?php _e('e.g. 15 Minutes, 1 Hour, 3 Hours and 20 Minutes',
                            'wprichrecipes'); ?>
                </span>
            </td>
        </tr>
        <tr>
            <td><?php _e('Yield:', 'wprichrecipes'); ?></td>
                <td>
                <input id="wprr_yield" type="text" name="wprr_yield" value="<?php echo $yield; ?>">
                <span class="description">
                    <?php _e('e.g. 1 Person, 4 servings', 'wprichrecipes'); ?>
                </span>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Save the custom fields from meta box.
 *
 * @since WP Rich Recipes 1.4
 *
 * @global object $post
 * @param integer $post_id
 * @return integer
 */
function wprr_save_meta_box($post_id)
{
    global $post;
    // Verify nonce
    if (!isset($_POST['wprr_meta_box']) || !wp_verify_nonce($_POST['wprr_meta_box'],
            basename(__FILE__))) {
        return $post_id;
    }
    // Check Autosave
    if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || ( defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit'])) {
        return $post_id;
    }
    // Don't save if only a revision
    if (isset($post->post_type) && $post->post_type == 'revision') {
        return $post_id;
    }
    // Check permissions
    if (!current_user_can('edit_post', $post->ID)) {
        return $post_id;
    }
    $meta['wprr_prep_time'] = ( isset($_POST['wprr_prep_time']) ? esc_attr($_POST['wprr_prep_time']) : '' );
    $meta['wprr_cook_time'] = ( isset($_POST['wprr_cook_time']) ? esc_attr($_POST['wprr_cook_time']) : '' );
    $meta['wprr_total_time'] = ( isset($_POST['wprr_total_time']) ? esc_attr($_POST['wprr_total_time']) : '' );
    $meta['wprr_yield'] = ( isset($_POST['wprr_yield']) ? esc_attr($_POST['wprr_yield']) : '' );
    foreach ($meta as $key => $value) {
        update_post_meta($post->ID, $key, $value);
    }
}
add_action('save_post', 'wprr_save_meta_box');

/**
 * Flush rewrite rules if the previously added flag exists,
 * and then remove the flag.
 *
 * @since WP Rich Recipes 1.4
 */
function wprr_flush_rewrite_rules_maybe()
{
    if (get_option('wprr_flush_rewrite_rules_flag')) {
        flush_rewrite_rules();
        delete_option('wprr_flush_rewrite_rules_flag');
    }
}
add_action('init', 'wprr_flush_rewrite_rules_maybe', 20);

/**
 * Custom update messages.
 *
 * @since WP Rich Recipes 1.4
 *
 * @global object $post
 * @global integer $post_ID
 * @param array $messages
 * @return array
 */
function wprr_recipe_updated_messages($messages)
{
    global $post, $post_ID;
    $messages['rich-recipe'] = array(
        0 => '',
        1 => sprintf(__('Recipe updated. <a href="%s">View recipe</a>', 'wprichrecipes'),
            esc_url(get_permalink($post_ID))),
        2 => __('Custom field updated.', 'wprichrecipes'),
        3 => __('Custom field deleted.', 'wprichrecipes'),
        4 => __('Recipe updated.', 'wprichrecipes'),
        5 => isset($_GET['revision']) ? sprintf(__('Recipe restored to revision from %s',
                    'wprichrecipes'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
        6 => sprintf(__('Recipe published. <a href="%s">View recipe</a>', 'wprichrecipes'),
            esc_url(get_permalink($post_ID))),
        7 => __('Recipe saved.', 'wprichrecipes'),
        8 => sprintf(__('Recipe submitted. <a target="_blank" href="%s">Preview recipe</a>',
                'wprichrecipes'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
        9 => sprintf(__('Recipe scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview recipe</a>',
                'wprichrecipes'),
            date_i18n(__('M j, Y @ G:i', 'wprichrecipes'), strtotime($post->post_date)),
            esc_url(get_permalink($post_ID))),
        10 => sprintf(__('Recipe draft updated. <a target="_blank" href="%s">Preview recipe</a>',
                'wprichrecipes'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
    );
    return $messages;
}
add_filter('post_updated_messages', 'wprr_recipe_updated_messages');

/**
 * Custom contextual help strings.
 *
 * @since WP Rich Recipes 1.4
 *
 * @param string $contextual_help
 * @param integer $screen_id
 * @param object $screen
 * @return string
 */
function wprr_recipe_contextual_help($contextual_help, $screen_id, $screen)
{
    if ('rich-recipe' == $screen->id) {
        $contextual_help = '<h2>Recipes</h2><p>Recipes show the details of the items that we sell on the website. You can see a list of them on this page in reverse chronological order - the latest one we added is first.</p><p>You can view/edit the details of each recipe by clicking on its name, or you can perform bulk actions using the dropdown menu and selecting multiple items.</p>';
    } elseif ('edit-recipe' == $screen->id) {
        $contextual_help = '<h2>Editing recipes</h2><p>This page allows you to view/modify recipe details. Please make sure to fill out the available boxes with the appropriate details and <strong>not</strong> add these details to the recipe description.</p>';
    }
    return $contextual_help;
}
add_filter('contextual_help', 'wprr_recipe_contextual_help', 10, 3);

/**
 * Add custom post type to dashboard at a glance.
 *
 * @since WP Rich Recipes 1.4
 */
function wprr_add_recipe_count_to_dashboard()
{
    /* Add list item icon */
    echo '<style>#dashboard_right_now .wprr-recipe-count a:before {content: "\f513"}</style>';

    /* Count */
    $num_posts = wp_count_posts('rich-recipe');

    /* Response */
    if ($num_posts) {
        echo sprintf(
            '<li class="wprr-recipe-count"><a href="%s">%s %s</a></li>',
            add_query_arg(array('post_type' => 'rich-recipe'), admin_url('edit.php')),
            esc_html(intval($num_posts->publish)), esc_html__('Recipes', 'wprichrecipes'));
    }
}
add_action('dashboard_glance_items', 'wprr_add_recipe_count_to_dashboard');

/**
 * Convert times to an iso duration format.
 *
 * @since WP Rich Recipes 1.0
 *
 * @param string $time
 * @return string
 */
function wprr_convert_times($time)
{
    $time = explode(' ', $time);
    if (!empty($time)) {
        // e.g. 15 minutes
        if (count($time) == 2) {
            $unit = $time[1];
            switch (strtolower(substr($unit, 0, 1))) {
                case 'm':
                    $unit = 'M';
                    break;
                case 's':
                case 'h':
                    $unit = 'H';
                    break;
                default:
                    break;
            }
            $time = 'PT' . $time[0] . $unit;
            // e.g. 1 hour 30 minutes
        } else if (count($time) == 4) {
            $unit[0] = $time[1];
            $unit[1] = $time[3];
            switch (strtolower(substr($unit[0], 0, 1))) {
                case 'm':
                    $unit[0] = 'M';
                    break;
                case 's':
                case 'h':
                    $unit[0] = 'H';
                    break;
                default:
                    break;
            }
            switch (strtolower(substr($unit[1], 0, 1))) {
                case 'm':
                    $unit[1] = 'M';
                    break;
                case 's':
                case 'h':
                    $unit[1] = 'H';
                    break;
                default:
                    break;
            }
            $time = 'PT' . $time[0] . $unit[0] . $time[2] . $unit[1];
        }
    }

    return $time;
}

/**
 * Fired when activate the plugin.
 *
 * @since WP Rich Recipes 1.4
 */
function wprr_activate_plugin()
{
    if (!get_option('wprr_flush_rewrite_rules_flag')) {
        add_option('wprr_flush_rewrite_rules_flag', true, '', 'no');
    }
}

register_activation_hook(__FILE__, 'wprr_activate_plugin');

/**
 * Fired when deactivate the plugin.
 *
 * @since WP Rich Recipes 1.4
 */
function wprr_deactivate_plugin()
{
    if (!get_option('wprr_flush_rewrite_rules_flag')) {
        add_option('wprr_flush_rewrite_rules_flag', true, '', 'no');
    }
}

register_deactivation_hook(__FILE__, 'wprr_deactivate_plugin');

/**
 * Fired when uninstall the plugin.
 *
 * Delete options and optimize the database.
 *
 * @since WP Rich Recipes 1.4
 *
 * @global object $wpdb
 */
function wprr_uninstall_plugin()
{
    /* Global */
    global $wpdb;

    /* Remove settings */
    delete_option('wprr_flush_rewrite_rules_flag');
}

register_uninstall_hook(__FILE__, 'wprr_uninstall_plugin');
