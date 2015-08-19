<?php
/*
Plugin Name: Jibber Voice Comments
Description: Replace WordPress commenting with Jibber comments.
Version: 1.0.0
Author: jibber.social
Author URI: http://www.ibber.social
Plugin URI: http://www.jibber.social
*/



//Adding medta tags to the page header
add_action('wp_head', 'jvc_adding_jibber_admin_credentials');
//call register settings function
add_action( 'admin_init', 'jvc_register_voice_settings' );
//Overriding the default comment template
add_filter('comments_template', 'jvc_comments_template');
//Adding jibber specific scripts and styles 
add_action( 'wp_enqueue_scripts', 'jvc_scripts_and_styles' );

//Registrating admin menus
add_action('admin_menu', 'jvc_plugin_setup_menu');


function jvc_scripts_and_styles() {
    wp_enqueue_style( 'style-jibber', plugin_dir_url( __FILE__ ) . 'style.css' );
    wp_enqueue_script( 'script-external-jibber', 'http://www.jibber.social/static/js/external/jibber.js', array(), '1.0.0', true );
    wp_enqueue_script( 'script-jibber', plugin_dir_url( __FILE__ ) . 'script.js', array(), '1.0.0', true );
}

function jvc_adding_jibber_admin_credentials()
{
    $options   = get_option("jibber_voice");
    $jibber_id = $options['jibber_admin_id'];
    echo "<meta property='jibber:admin' content='{$jibber_id}'>";
}

function jvc_comments_template(){
        return dirname(__FILE__) . '/comments.php';
}
 
function jvc_plugin_setup_menu(){
        add_menu_page( 'Jibber Comments', 'Jibber', 'manage_options', 'jibber-comments-plugin', 'jvc_init' );
}

function jvc_init(){
    echo "<h1>Jibber Voice Comments</h1>";
    $options = get_option("jibber_voice");
    ?>
    <div class="wrap">
        <h2>Admin Settings</h2>
        <form method="post" action="options.php">
            <?php settings_fields('jibber-comments-plugin'); ?>
            <table class="form-table">
                <tr valign="top"><th scope="row">Enter the jibber-ID of admin account:</th>
                    <td><input type="text" name="<?php echo "jibber_voice[jibber_admin_id]" ?>" value="<?php echo $options['jibber_admin_id']; ?>" /></td>
                </tr>
<!--                 <tr valign="top"><th scope="row">Title:</th>
                    <td><input type="text" name="<?php echo "jibber_voice[title_todo]"?>" value="<?php echo $options['title_todo']; ?>" /></td>
                </tr> -->
            </table>
            <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
            </p>
        </form>
    </div>
<?php
}

function jvc_register_voice_settings() {
    //register our settings
    register_setting( 'jibber-comments-plugin', 'jibber_admin_id' );
    register_setting( 'jibber-comments-plugin', 'jibber_voice' );
    register_setting( 'jibber-comments-plugin', 'title_todo' );
}


