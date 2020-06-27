<?php

get_header(); ?>

<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway'>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<!-- Page Container -->
<main>
    <div class="w3-container w3-content"
        style="max-width:1200px;margin-top:10px;border:2px solid #2196f3;border-radius:10px;">
        <div class="w3-row">
            <div class="w3-col m12">
                <header class="w3-container w3-blue" style="margin-top:20px;">
                    <script>
                        document.write(' <div style="font-size:40px;">AUTHENTICATE VIA WP - RETURN ID & JWT</div>');
                    </script>
                    <!-- <h1 style="font-size:40px;">WordCamp Dublin</h1> -->
                </header>
                <br>
                <p>
                    Using a user's login details, the REST endpoint validates user and returns the ID and JSON WEB TOKEN
                    that can be used in decoupled WP sites, for example.<br>
                    More information can be sent back and this can be seen in DEV > TOOLS > CONSOLE.<br>
                    Uses https:/49plus.co.uk/udemy/wp-json/udemy/v1/login.<br>
                    Use: <b>email: demo@49plus.co.uk</b> and <b>password: demo </b>
                </p>
                <form autocomplete="off" id="myForm" method="post" action="posted.php">
                    <table class="w3-table w3-bordered" style="background:white;" id="mainTable">
                        <!-- ======================== EMAIL ========================================================-->
                        <tr>
                            <td style="width:150px;">Email <br></td>
                            <td style="width:600px;">
                                <input id="email" type="text" name="email" value="demo@49plus.co.uk"
                                    placeholder="enter...">
                            </td>
                        </tr>
                        <tr>
                            <td class="">Password <br></td>
                            <td>
                                <input id="pswa" type="text" name="pswa" value="demo" placeholder="enter...">
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
                        <td><b> AUTHENTICATION:</b></td>
                    </tr>
                    <tr>
                        <td>
                            <div id="user_id"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div id="jwt" style="word-break:break-all;"></div>
                        </td>
                    </tr>
                </table>

                <script>
                    const btn = document.getElementById('btnSubmit');
                    btn.addEventListener('click', formHandler);

                    //jwt.innerHTML = "Data being sent: " + emailValue + " - " + passwordValue;
                    function formHandler() {
                        // Get form data and create variables to div elements 
                        // to output data.
                        const myForm = document.getElementById('myForm');
                        const emailValue = document.getElementById('email').value;
                        const passwordValue = document.getElementById('pswa').value;
                        console.log(emailValue);
                        console.log(passwordValue);
                        const output = document.getElementById('output');
                        const user_id = document.getElementById('user_id');
                        const jwt = document.getElementById('jwt');
                        user_id.innerHTML = "";
                        jwt.innerHTML = "";
                        // -----------
                        //Best to use FormData object as we our posting form data rather than JSON
                        const formData = new FormData();
                        formData.append('email', emailValue);
                        formData.append('password', passwordValue);
                        // test to see if it works without FormData
                        // it doesn't
                        // const testdata = {
                        //     "email": emailValue,
                        //     "password": passwordValue       
                        // }
                        let apiUrl = 'https://49plus.co.uk/udemy/wp-json/udemy/v1/login';
                        console.log("url: " + apiUrl);
                        fetch(apiUrl, {
                                method: 'POST',
                                body: formData
                                //body: testdata
                            })
                            .then(function (response) {
                                return response.json();
                            })
                            .then(function (data) {
                                console.log(data);

                                const message = data.message;
                                const id = data.ID;
                                const token = data.jwt;
                                const validID = data.valid.ID || 0; // if successful has id, if not set to zero
                                console.log("VALID ID = " + validID)
                                console.log("RESULT: " + message);
                                console.log("ID: " + id);
                                console.log("JWT: " + token);
                                if (validID > 0) {
                                    user_id.innerHTML = message + " ID: " + id;
                                    jwt.innerHTML = "JWT: " + token;
                                } else {
                                    user_id.innerHTML = "INVALID LOGIN";
                                }

                            })
                            // network failure rather than a 400
                            // handle this gracefully.
                            .catch(function (error) {
                                console.log(error);
                                user_id.innerHTML = "NETWORK ERROR";
                            })
                            .finally(function () {
                                // this occurs at end regardless
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