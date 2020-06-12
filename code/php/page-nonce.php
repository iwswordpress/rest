<?php

get_header(); ?>

<script>
   // these are the global JS variables set up in wp_localize_js_var.php
   console.log("global js wpNonce via wp_localize_script: " + siteObj.wpNonce);
   console.log("global js siteUrl via wp_localize_script: " + siteObj.siteUrl);
   console.log("global js filePath via wp_localize_script: " + siteObj.filePath);
   hello();
</script>
<div id="primary" >
    <div id="content" class="site-content" role="main" style="padding-left:10px; padding-right:10px;">
        <br>
        <p>Nonces are generated numbers used to verify origin and intent of requests for security purposes.</p>
        <p>A new one is created if one logs out and then back in.</p>
        <p><a href="https://developer.wordpress.org/plugins/security/nonces/" target="_blank">https://developer.wordpress.org/plugins/security/nonces/</a></p>
        <p>We can verify a supplied nonce value against the value WP created. It returns true or false.</p>
        <p>As the WP nonce was created on the page in WP, we can be sure the data received came from that page.</p>
        <p>WP uses the tick cycle of 12 hrs starting from midnight.</p>
        <p>A nonce is valid for 2 ticks, so a tick will not be valid in the third tick, so a <em><b>maximum</b></em> of 24hrs <em><b>not a full 24hrs</b></em>.</p>
        <p>Great article on nonces: <a href="https://www.bynicolas.com/code/wordpress-nonce/" target="_blank">https://www.bynicolas.com/code/wordpress-nonce/</a></p>
      
        <?php 
			global $wpdb;
		
            echo "Session Token: ".wp_get_session_token();
            $InvalidNonce = '3dd3445tt3r33';
            $PageNonce = wp_create_nonce('NoncePageTest');
        ?>
        <dl>
            <dt>$PageNonce = wp_create_nonce('NoncePageTest')</dt>
            <dd><?php echo "PageNonce = ".$PageNonce;?></dd>
            <dt>Invalid Nonce $InvalidNonce set by us: </dt>
            <dd><?php echo "InvalidNonce = ".$InvalidNonce;?></dd>
            <dt>Verify our CREATED NONCE:  wp_verify_nonce($PageNonce,'NoncePageTest')</dt>
            <dd><?php echo ((bool)wp_verify_nonce($PageNonce,'NoncePageTest')?'NONCE is VALID':'NONCE is INVALID');?>
            <dt>Verify our INVALID NONCE:  wp_verify_nonce($InvalidNonce,'NoncePageTest')</dt>
            <dd><?php echo ((bool)wp_verify_nonce($InvalidNonce,'NoncePageTest')?'NONCE is VALID':'NONCE is INVALID');?>
            </dd>
        </dl>
        <p>https://developer.wordpress.org/rest-api/using-the-rest-api/authentication/</p>
        <p>https://developer.wordpress.org/reference/functions/wp_nonce_field/</p>
        <p>https://codex.wordpress.org/WordPress_Nonces</p>
        <p>https://pantheon.io/blog/nonce-upon-time-wordpress</p>
    </div><!-- #content -->
    <br><br><br>
</div><!-- #primary -->
</div><!-- #main-content -->