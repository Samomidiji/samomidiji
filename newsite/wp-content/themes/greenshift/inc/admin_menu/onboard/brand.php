<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}
if (!current_user_can('manage_options')) {
    wp_die('Unauthorized user');
}
?>
<div class="wp-block-greenshift-blocks-container gspb_container gspb_container-gsbp-efb64efe-d083" id="gspb_container-id-gsbp-efb64efe-d083">
    <h2 id="gspb_heading-id-gsbp-ca0b0ada-6561" class="gspb_heading gspb_heading-id-gsbp-ca0b0ada-6561 "><?php echo esc_html($title); ?></h2>
</div>

<?php
$global_settings = get_option('gspb_global_settings');


if (
    (isset($_POST['gspb_save_settings']) || isset($_POST['gspb_save_settings_next'])) && isset($_POST['gspb_settings_field']) &&
    wp_verify_nonce(
        sanitize_text_field(wp_unslash($_POST['gspb_settings_field'])),
        'gspb_settings_page_action'
    )
) {

    $site_title = sanitize_text_field($_POST['site_title']);
    if ($site_title) {
        update_option('blogname', $site_title);
    }
    $site_description = sanitize_text_field($_POST['site_description']);
    if ($site_description) {
        update_option('blogdescription', $site_description);
    }

    $siteLogoId = sanitize_text_field($_POST['selectedImageId']);
    if ($siteLogoId) {
        update_option('site_logo', $siteLogoId);
    }

    $siteIconId = sanitize_text_field($_POST['selectedIconId']);
    if ($siteIconId) {
        update_option('site_icon', $siteIconId);
    }

    if (isset($_POST['gspb_save_settings_next'])) {
        echo '<script>window.location.replace("'.admin_url('admin.php?page=greenshift_theme_settings&tab=home').'");</script>';
        exit;
    }
}

// Get the site logo
$site_logo_id = get_theme_mod('custom_logo');

// Get the site logo URL
$site_logo_url = wp_get_attachment_image_url($site_logo_id, 'full');

// Get the site icon
$site_icon = get_site_icon_url();

?>

<div class="greenshift_form wp-block-greenshift-blocks-container gspb_container gspb_container-gsbp-7b4f8e8f-1a69" id="gspb_container-id-gsbp-7b4f8e8f-1a69">
    <form method="POST">
        <?php wp_nonce_field('gspb_settings_page_action', 'gspb_settings_field'); ?>
        <div class="brand-element-container settings-container">
            <div class="gs-box notice_type icon_type">
                <div class="gs-box-icon"><svg class="" style="display:inline-block;vertical-align:middle" width="32" height="32" viewBox="0 0 704 1024" xmlns="http://www.w3.org/2000/svg">
                        <path style="fill:#565D66" d="M352 160c-105.88 0-192 86.12-192 192 0 17.68 14.32 32 32 32s32-14.32 32-32c0-70.6 57.44-128 128-128 17.68 0 32-14.32 32-32s-14.32-32-32-32zM192.12 918.34c0 6.3 1.86 12.44 5.36 17.68l49.020 73.68c5.94 8.92 15.94 14.28 26.64 14.28h157.7c10.72 0 20.72-5.36 26.64-14.28l49.020-73.68c3.48-5.24 5.34-11.4 5.36-17.68l0.1-86.36h-319.92l0.080 86.36zM352 0c-204.56 0-352 165.94-352 352 0 88.74 32.9 169.7 87.12 231.56 33.28 37.98 85.48 117.6 104.84 184.32v0.12h96v-0.24c-0.020-9.54-1.44-19.020-4.3-28.14-11.18-35.62-45.64-129.54-124.34-219.34-41.080-46.86-63.040-106.3-63.22-168.28-0.4-147.28 119.34-256 255.9-256 141.16 0 256 114.84 256 256 0 61.94-22.48 121.7-63.3 168.28-78.22 89.22-112.84 182.94-124.2 218.92-2.805 8.545-4.428 18.381-4.44 28.594l-0 0.006v0.2h96v-0.1c19.36-66.74 71.56-146.36 104.84-184.32 54.2-61.88 87.1-142.84 87.1-231.58 0-194.4-157.6-352-352-352z"></path>
                    </svg></div>
                <div class="gs-box-text">
                    <?php esc_html_e("You can add unlimited extra colors and configure additional global elements in", "greenshift"); ?>
                    <?php
                    $stylebook_post_id = get_option('gspb_stylebook_id');
                    if ($stylebook_post_id) {
                        $editposturl = admin_url('post.php?post=' . $stylebook_post_id . '&action=edit');
                    } else {
                        $editposturl = admin_url('admin.php?page=greenshift_stylebook');
                    }; ?>
                    <a href="<?php echo $editposturl; ?>" target="_blank">Stylebook</a>
                </div>
            </div>
        </div>

        <div class="brand-element-container settings-container" style="border-color:transparent">
            <div class="gspb-title-area">
                <h4>
                    <?php esc_html_e("Site Title", "greenshift"); ?>
                </h4>
            </div>
            <div class="gspb-field-area">
                <input placeholder="<?php esc_attr_e("Add name for site", "greenshift"); ?>" name="site_title" class="components-text-control__input" type="text" value="<?php echo get_bloginfo('name'); ?>">
            </div>
        </div>
        <div class="brand-element-container settings-container" style="border-color:transparent">
            <div class="gspb-title-area">
                <h4>
                    <?php esc_html_e("Site Description", "greenshift"); ?>
                </h4>
            </div>
            <div class="gspb-field-area">
                <input placeholder="<?php esc_attr_e("Add description for site", "greenshift"); ?>" name="site_description" class="components-text-control__input" type="text" value="<?php echo get_bloginfo('description'); ?>">
            </div>
        </div>
        <div class="brand-element-container settings-container">
            <div class="gspb-title-area">
                <h4>
                    <?php esc_html_e("Site Logo", "greenshift"); ?>
                </h4>
            </div>
            <div class="gspb-field-area">
                <input type="file" id="selectImage">
                <input type="hidden" id="selectedImageId" name="selectedImageId" value="">

                <div id="imageContainer" class="gspb-field-area" style="margin-top:20px">
                    <?php
                    // Display the selected image if available
                    if (!empty($site_logo_url)) {
                        echo '<img src="' . esc_url($site_logo_url) . '" alt="Site Logo">';
                    }
                    ?>
                </div>
            </div>
            <script>
                jQuery(document).ready(function($) {
                    $('#selectImage').on('click', function(e) {
                        e.preventDefault();

                        var frame = wp.media({
                            title: 'Select or Upload Logo Image',
                            button: {
                                text: 'Select'
                            },
                            multiple: false
                        });

                        frame.on('select', function() {
                            var attachment = frame.state().get('selection').first().toJSON();

                            $('#selectedImageId').val(attachment.id);

                            var imageUrl = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;
                            $('#imageContainer').html('<img src="' + imageUrl + '" alt="Selected Image" style="width: 100px">');
                        });

                        frame.open();
                    });
                });
            </script>
        </div>
        <div class="brand-element-container settings-container">
            <div class="gspb-title-area">
                <h4>
                    <?php esc_html_e("Site Icon", "greenshift"); ?>
                </h4>
            </div>
            <div class="gspb-field-area">
                <input type="file" id="selectIcon" value="Select Icon">
                <input type="hidden" id="selectedIconId" name="selectedIconId" value="">

                <div id="iconimageContainer" class="gspb-field-area" style="margin-top:20px">
                    <?php
                    // Display the selected image if available
                    if (!empty($site_icon)) {
                        echo '<img src="' . esc_url($site_icon) . '" alt="Site Icon">';
                    }
                    ?>
                </div>
            </div>
            <script>
                jQuery(document).ready(function($) {
                    $('#selectIcon').on('click', function(e) {
                        e.preventDefault();

                        var frame = wp.media({
                            title: 'Select or Upload Icon Image',
                            button: {
                                text: 'Select'
                            },
                            multiple: false
                        });

                        frame.on('select', function() {
                            var attachment = frame.state().get('selection').first().toJSON();

                            $('#selectedIconId').val(attachment.id);

                            var imageUrl = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;
                            $('#iconimageContainer').html('<img src="' + imageUrl + '" alt="Selected Image" >');
                        });

                        frame.open();
                    });
                });
            </script>
        </div>
        <div style="display:flex; gap: 15px; ">
            <input type="submit" name="gspb_save_settings" value="<?php esc_attr_e('Save', 'greenshift') ?>" class="button button-secondary button-large" style="margin: 20px 0 10px 0">
            <input type="submit" name="gspb_save_settings_next" value="<?php esc_attr_e('Save and Continue', 'greenshift') ?>" class="button button-primary button-large" style="margin: 20px 0 10px 0">
        </div>
    </form>
</div>