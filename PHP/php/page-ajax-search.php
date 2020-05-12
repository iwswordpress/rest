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


<!-- ENTER YOUR REST API ORIGIN URL HERE -->

<!-- ENTER YOUR REST API ORIGIN URL HERE -->

<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway'>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
    :root {
    /* margin-left: calc(100vw - 100%);
    overflow-y: scroll; */
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
        word-break: break-all;

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

    .box {
        border: 3px solid green;
        border-radius: 10px;
        padding: 10px;
        font-weight: bold;
    }
</style>
<!-- Page Container -->

<?php include 'server.php'; ?>
<main>
    <br><br>
    <div class="w3-container w3-content" style="max-width:1600px;border:2px solid #2196f3;border-radius:10px;">
        <!-- W3 CSS Grid -->
        <div class="w3-row">
            <div class="w3-col m12">
                <!-- ************************* START TEMPLATE AREA ********************************-->
                <!-- CONTENT CARD-->
                <div>
                    <p><?php //echo "<b>get_theme_file_uri():</b> ".get_theme_file_uri(); ?></p>
                    <p><?php //echo "<b> get_template_directory_uri():</b> ". get_template_directory_uri(); ?></p>

                </div>
                <header class="w3-container w3-blue" style="margin-top:20px;">
                    <script>
                        document.write(' <div style="font-size:40px;">SEARCH FORM</div>');
                    </script>
                    <!-- <h1 style="font-size:40px;">WordCamp Dublin</h1> -->
                </header>



                <div class="w3-container" style="width:100%;">
                    <div class="w3-row">
                        <div class="w3-col m12" style="margin-top:20px;padding-left:30px;padding-right:30px;">
                            <h2>Returns posts from search...</h2>
                            <p><?php echo $SITE; ?>wp-json/wp/v2/posts?search=</p>
                            <div style="margin-bottom:30px;">
                                <input id="x" type="text" name="searchTerm" placeholder="search..." value="lorem">

                                <input id="btnSearch" name="btnSearch" class="w3-btn w3-border w3-large w3-blue"
                                    value="SEARCH">
                            </div>
                            <div id="mainContent2"></div>
                            <!-- ================ MAIN CODE ======================= -->
                            <script>
                                const btnSearch = document.getElementById('btnSearch');
                                btnSearch.addEventListener('click', searchHandler);


                                function searchHandler() {
                                    //alert("TEST");
                                    console.log("== SEARCH ===");
                                    const x = document.getElementById('x').value;
                                    console.log('search for: ', x);
                                    const url = '<?php echo $SITE; ?>' + 'wp-json/wp/v2/posts?search=' + x;

                                    console.log(url);
                                    fetch(url)
                                        .then(response => response.json())
                                        .then(data => {
                                            // Prints result from `response.json()` in get Request
                                            console.log("DATA", data)
                                            console.log(data.length);
                                            let outputData = "";

                                            for (let i = 0; i < data.length; i++) {
                                                outputData += data[i].id + " Post Title: " + data[i].title
                                                    .rendered + "<br>";
                                            }

                                            const main2 = document.getElementById('mainContent2');
                                            main2.innerHTML = outputData;
                                            main2.className = "box";
                                        })
                                        .catch(error => console.error(error))
                                }
                            </script>
                            <!-- ================ MAIN CODE ======================= -->

                        </div><!-- end col m12 --->
                    </div><!-- end container card -->
                </div><!-- end col page -->
            </div><!-- end page row -->
        </div><!-- end page container -->
        <br><br><br>
</main>
<br><br>
<!-- End Page Container -->

<?php get_footer();

?>