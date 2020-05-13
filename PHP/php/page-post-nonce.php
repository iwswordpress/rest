<?php

get_header(); ?>


<!-- Page Container -->
<script>
    const rnd =  Math.floor(Math.random() * 100000000000);
    localStorage.setItem("JWT", rnd );
</script>

<?php include 'server.php'; ?>
<main>
    <br><br>
    <div class="w3-container w3-content" style="max-width:1600px;border:2px solid #2196f3;border-radius:10px;">
        <div class="w3-row">
            <div class="w3-col m12">
                <header class="w3-container w3-blue" style="margin-top:20px;">
                    <script>
                        document.write(' <div style="font-size:40px;">Add a POST with security nonce</div>');
                    </script>
                    <!-- <h1 style="font-size:40px;">WordCamp Dublin</h1> -->
                </header>
                <br>
                <p>Create a post. Min length 5 characters each field.</p>
                <p>It also sends a hidden NONCE token to verify that a genuine page sent this data as well as a JWT.</p>
                <p>NONCE does not work if logged in - use logged-in-user details to verify.</p>
                <p>Uses  <?php echo $SITE; ?>wp-json/owt/v1/rest03</p>
                <form autocomplete="off" id="myForm" method="post" action="posted.php">
                    <table class="w3-table w3-bordered" style="background:white;" id="mainTable">
                        <!-- ======================== EMAIL ========================================================-->
                      
                        <tr>
                            <td class="">Title <br></td>
                            <td>
                                <input id="title" type="text" name="title" placeholder="enter...">
                            </td>
                        </tr>
                        <tr>
                            <td style="width:150px;">Content <br></td>
                            <td style="width:600px;">
                                <textarea id="data" type="text" name="data" placeholder="enter..."></textarea>
                            </td>
                        </tr>
                        <tr id="sendRow">
                            <td>
                                <input id="btnSubmit" name="btnSubmit" class="w3-btn w3-border w3-large w3-blue"
                                    type="button" value="SEND FORM">
                            </td>
                            <td></td>
                        </tr>
                    </table>
                </form>
                <!-- ======================== END OF FORM =====================================================-->
                <table>
                    <tr>
                        <td><b> RETURN VALUE:</b></td>
                    </tr>
                    <tr>
                        <td>
                            <div id="output"></div>
                        </td>
                    </tr>
                </table>

                <script>
                    
                    const btn = document.getElementById('btnSubmit');
                    btn.addEventListener('click', formHandler);
                    //jwt.innerHTML = "Data being sent: " + emailValue + " - " + passwordValue;
                    function formHandler() {
                     
                        const title = document.getElementById('title').value;
                        const data = document.getElementById('data').value;
                        //const data = title = "Conent here";
                       
                        console.log("Title", title);
                        console.log("Content", data);
                        const output = document.getElementById('output');
                        const JWT = localStorage.getItem('JWT');
                       
                        // one can use localize_script to create global JS variable to use in PHP
                        // must be wp_rest to work and have headers in fetch
                        // https://stackoverflow.com/questions/41878315/wp-ajax-nonce-works-when-logged-out-but-not-when-logged-in
                        const nonceValue = '<?php  echo wp_create_nonce('wp_rest'); ?>';
                        console.log("form nonceValue: " + nonceValue);

                        const formData = new FormData();
                        formData.append('title', title);
                        formData.append('content', data);
                        formData.append('jwt', JWT);
                        formData.append('nonce', nonceValue);
                        
                        let apiUrl = '<?php echo $SITE; ?>' + 'wp-json/owt/v1/rest03';
                        console.log("url: " + apiUrl);
                        fetch(apiUrl, {
                                method: 'POST',
                                body: formData,
                                //credentials: 'same-origin', // include, *same-origin, omit
                                headers: { 'X-WP-Nonce': nonceValue}
                            })
                            .then(function (response) {
                                return response.text();
                            })
                            .then(function (data) {
                                console.log(data);
                                // display result on page for demo purposes
                                output.innerHTML = data;
                              
                            });
                    }
                </script>
               
                <!-- ================ MAIN CODE ======================= -->
                <br><br><br>
            </div><!-- end col m12 --->
        </div><!-- end container card -->

        <br><br><br>
        <!-- ************************* END TEMPLATE AREA ********************************-->
    </div><!-- endcard -->

    <br><br><br><br><br>
</main>
<!-- End Page Container -->

<?php get_footer();

?>