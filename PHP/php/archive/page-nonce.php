<?php
/**
 * page-test.php
 * 
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header(); ?>

<style>
    :root {
        margin-left: calc(100vw - 100%);
        overflow-y: scroll;
    }

    body {
        font-size: 22px;
        background: #fff;
    }
</style>
<br><br>
<div id="primary" >
    <div id="content" class="site-content" role="main" style="padding-left:10px; padding-right:10px;">
        <h1>This page is a WordPress NONCE test page.</h1>

        <p>We create a nonce and WP uses a label that we give it, in this case 'NoncePageTest'.</p>
        <p>We can verify a supplied nonce value against the value WP created. It returns true or false.</p>
        <p>As the WP nonce was created on the page in WP, we can be sure the data received came from that page.</p>
        <?php 
			global $wpdb;
			echo "DB: ".$wpdb->dbname;
			echo "<br>";
            echo "Session Token: ".wp_get_session_token();
            $invalidNonce = '3dd3445tt3r33';
            $thisIsANonce = wp_create_nonce('NoncePageTest');
        ?>
        <dl>
            <dt>$thisIsANomce = wp_create_nonce('NoncePageTest')</dt>
            <dd><?php echo $thisIsANonce;?></dd>
            <dt>Invalid Nonce $invalidNonce set by us: $invalidNonce = '3dd3445tt3r33'</dt>
            <dd><?php echo $invalidNonce;?></dd>
            <dt>Verify the simple NONCE: wp_verify_nonce($thisIsANonce,'NoncePageTest')</dt>
            <dd><?php echo ((bool)wp_verify_nonce($thisIsANonce,'NoncePageTest')?'NONCE is VALID':'NONCE is INVALID');?>
            </dd>
        </dl>
        <p>https://developer.wordpress.org/reference/functions/wp_nonce_field/</p>
        <p>https://codex.wordpress.org/WordPress_Nonces</p>
        <p>https://pantheon.io/blog/nonce-upon-time-wordpress</p>
    </div><!-- #content -->
    <br><br><br>
</div><!-- #primary -->
</div><!-- #main-content -->