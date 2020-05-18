<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bootstrap to WordPress
 */

get_header(); ?>

<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway'>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
    :root {
    margin-left: calc(100vw - 100%);
    overflow-y: scroll;
}
    html,
    body,
    h1,
    h2,
    h3,
    h4,
    h5 {
        font-family: "Raleway", sans-serif;
        font-size: 24px;
        word-break: none;

    }

    body {
        background: #fff;
    }

    h1 {
        font-size: 34px;
        font-weight: bold;
    }


    .intro {
        font-weight: bolder;
        background: #2196f3;
        color: white;
        padding: 10px 30px;
        border-radius: 10px;
    }

    .outro {
        font-weight: bolder;
        background: white;
        color: black;
        padding: 10px 30px;
        border-radius: 10px;
        border: 3px solid orange;
        margin-top: 30px;
    }
    div {
        padding:10px;
    }

    .box {
        border: 3px solid green;
        border-radius: 10px;
        padding: 10px;
        font-weight: bold;
    }
</style>
<!-- Page Container -->
<script>
    const rnd = Math.floor(Math.random() * 100000000000);
    localStorage.setItem("JWT", rnd);
</script>


<main>
    <br><br>
    <div class="w3-container w3-content" style="max-width:1600px;border:2px solid #2196f3;border-radius:10px;">
        <div class="w3-row">
            <div class="w3-col m12">
                <header class="w3-container w3-blue" style="margin-top:20px;">
                    <script>
                        document.write(' <div style="font-size:40px;">WordCamp LOGIN</div>');
                    </script>
                    <!-- <h1 style="font-size:40px;">WordCamp Dublin</h1> -->
                </header>
                <br>
                <p>This reflects back what is sent from form but must be <strong>valid email and password greater than 5 characters</strong>.</p>
                <p>It send back a lot of data (view console) and displays ID and JSON WEB TOKEN (JWT) which can be stored in localStorage.</p>
                <p>Uses http://localhost/wprest/wp-json/udemy/v1/login</p>
                <form autocomplete="off" id="myForm" method="post" action="posted.php">
                    <table class="w3-table w3-bordered" style="background:white;" id="mainTable">
                        <!-- ======================== EMAIL ========================================================-->
                        <tr>
                            <td style="width:150px;">Email <br></td>
                            <td style="width:600px;">
                                <input id="email" type="text" name="email" value="demo@wpjs.co.uk" placeholder="enter...">
                            </td>
                        </tr>
                        <tr>
                            <td class="">Password <br></td>
                            <td>
                                <input id="pswa" type="text" name="pswa" value="demo2020" placeholder="enter...">
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
                    <tr> <td><div id="user_id" ></div></td></tr>
                    <tr> <td><div id="jwt" style="word-break:break-all;"></div></td></tr>
                </table>

                <script>
                    const btn = document.getElementById('btnSubmit');
                    btn.addEventListener('click', formHandler);

                    //jwt.innerHTML = "Data being sent: " + emailValue + " - " + passwordValue;
                    function formHandler() {
                        // Get form data and create variables to div elements 
                        // to output data.
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
                        // it deoesn't
                        // const testdata = {
                        //     "email": emailValue,
                        //     "password": passwordValue       
                        // }
                        let apiUrl = 'http://localhost/wprest/wp-json/udemy/v1/login';
                        console.log("url: " + apiUrl);
                        fetch(apiUrl, {
                                method: 'POST',
                                body: formData
                                //body: testdata
                            })
                            .then(function (response) {
                                return response.text();
                            })
                            .then(function (data) {
                                console.log(data);
                                // data is JSON-like but is just a string of characters
                                // JSON.parse converts the string to a JSON object.
                                const dataJSON = JSON.parse(data);
                                console.dir(dataJSON);
                                // get ID and JWT
                                const id = dataJSON.user.data.ID;
                                const token = dataJSON.jwt;
                                console.log("ID: " + id);
                                console.log("JWT: " + token);
                                // output data to the div tags in HTML section
                                user_id.innerHTML = "ID: " + id;
                                jwt.innerHTML = "JWT: " + token;
                              
                            })
                            // if we don't get a valid authentication for any reason
                            // handle this gracefully.
                            .catch(function(error) {
                                user_id.innerHTML = "AUTHENTICATION FAILED - NO ID AVAILABLE";
                            })
                            ;
                            
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