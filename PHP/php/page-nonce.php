<?php

get_header(); ?>

<div id="primary" >
    <div id="content" class="site-content" role="main" style="padding-left:10px; padding-right:10px;">
        <h1>This page is a WordPress NONCE test page.</h1>

        <p>We create a nonce and WP uses a label that we give it, in this case 'NoncePageTest'.</p>
        <p>We can verify a supplied nonce value against the value WP created. It returns true or false.</p>
        <p>As the WP nonce was created on the page in WP, we can be sure the data received came from that page.</p>
        <p>Great article on nonces: <a href="https://www.bynicolas.com/code/wordpress-nonce/" target="_blank">https://www.bynicolas.com/code/wordpress-nonce/</a></p>
        <?php 
			global $wpdb;
			echo "DB: ".$wpdb->dbname;
			echo "<br>";
            echo "Session Token: ".wp_get_session_token();
            $InvalidNonce = '3dd3445tt3r33';
            $PageNonce = wp_create_nonce('NoncePageTest');
        ?>
        <dl>
            <dt>$PageNonce = wp_create_nonce('NoncePageTest')</dt>
            <dd><?php echo "PageNonce = ".$PageNonce;?></dd>
            <dt>Invalid Nonce $InvalidNonce set by us: $InvalidNonce = '3dd3445tt3r33'</dt>
            <dd><?php echo "InvalidNonce = ".$InvalidNonce;?></dd>
            <dt>Verify the simple NONCE: wp_verify_nonce($PageNonce,'NoncePageTest')</dt>
            <dd><?php echo ((bool)wp_verify_nonce($PageNonce,'NoncePageTest')?'NONCE is VALID':'NONCE is INVALID');?>
            <dt>Verify the simple NONCE: wp_verify_nonce($InvalidNonce,'NoncePageTest')</dt>
            <dd><?php echo ((bool)wp_verify_nonce($InvalidNonce,'NoncePageTest')?'NONCE is VALID':'NONCE is INVALID');?>
            </dd>
        </dl>
        <p>https://developer.wordpress.org/rest-api/using-the-rest-api/authentication/</p>
        <p>https://www.bynicolas.com/code/wordpress-nonce/</p>  
        <p>https://developer.wordpress.org/reference/functions/wp_nonce_field/</p>
        <p>https://codex.wordpress.org/WordPress_Nonces</p>
        <p>https://pantheon.io/blog/nonce-upon-time-wordpress</p>
    </div><!-- #content -->
    <br><br><br>
</div><!-- #primary -->
</div><!-- #main-content -->