<?php

/**
 * Theme translations.
 */
function wp_helloworld_load_theme_textdomain()
{
    load_theme_textdomain('wp-helloworld-theme');
}

add_action('after_setup_theme', 'wp_helloworld_load_theme_textdomain');

/**
 * Theme settings menu.
 */
function wp_helloworld_theme_settings_menu()
{
    add_options_page('Hello World Theme', 'Hello World Theme', 'read', 'wp-helloworld-theme', 'wp_helloworld_theme_settings');
}

// We'll add an Settings -> Hello World Theme config page to get the user's download key.
add_action('admin_menu', 'wp_helloworld_theme_settings_menu');

/**
 * Theme settings.
 */
function wp_helloworld_theme_settings()
{
    $saved = false;

    if (isset($_POST['save']) && check_admin_referer('wp_helloworld_theme_settings', 'wp_helloworld_theme_settings_nonce')) {
        $downloadKey = isset($_POST['wp_helloworld_theme_downloadkey'])
            ? sanitize_text_field(wp_unslash(wp_strip_all_tags($_POST['wp_helloworld_theme_downloadkey'])))
            : '';

        // Here you can validate or activate the provided download key, before saving it to database.
        // Please see the download key validation and/or activation tutorials.

        // Once done validating/activating the download key, update the option
        update_option('wp_helloworld_theme_downloadkey', $downloadKey);

        $saved = true;
    }

    $downloadKey = get_option('wp_helloworld_theme_downloadkey', ''); ?>

    <div class="wrap">
        <h1><?php echo __('Hello World Theme', 'wp-helloworld-theme'); ?></h1>
        <?php if ($saved) : ?>
            <div id="message" class="updated fade">
                <p><strong><?php echo __('Settings saved.', 'wp-helloworld-theme'); ?></strong></p>
            </div>
        <?php endif ?>
        <h2>
            <?php echo __('Please enter your download key.', 'wp-helloworld-theme'); ?>
        </h2>
        <form method="post" action="">
            <div>
                <?php wp_nonce_field('wp_helloworld_theme_settings', 'wp_helloworld_theme_settings_nonce'); ?>
                <p>
                    <label for="wp_helloworld_theme_downloadkey"><?php echo __('Download key', 'wp-helloworld-theme'); ?></label>
                </p>
                <input type="text" name="wp_helloworld_theme_downloadkey" id="wp_helloworld_theme_downloadkey" value="<?php echo esc_attr($downloadKey); ?>" />
            </div>
            <p class="submit">
                <input class="button-primary" name="save" type="submit" value="<?php echo __('Save download key', 'wp-helloworld-theme'); ?>" />
            </p>
        </form>
    </div>
<?php
}
