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
<!-- ENTER YOUR rest-setup API ORIGIN URL HERE -->
<!-- ENTER YOUR REST API ORIGIN URL HERE -->
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway'>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
    /* :root {
        margin-left: calc(100vw - 100%);
        overflow-y: scroll;
    } */
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
                <header class="w3-container w3-blue" style="margin-top:20px;">
                    <script>
                        document.write(' <div style="font-size:40px;">AJAX GET</div>');
                    </script>
                    <!-- <h1 style="font-size:40px;">WordCamp Dublin</h1> -->
                </header>

                <div class="w3-container" style="width:100%;">
                    <div class="w3-row">
                        <div class="w3-col m12" style="margin-top:20px;padding-left:30px;padding-right:30px;">
                            <div style="margin-bottom:30px;">
                                <input id="btnPosts" name="btnSearch" class="w3-btn w3-border w3-large w3-blue"
                                    value="LOAD POSTS">
                                <input id="btnSearch" name="btnSearch" class="w3-btn w3-border w3-large w3-blue"
                                    value="LOAD DATA">
                            </div>
                            <div id="mainContent"></div>
                            <!-- ================ MAIN CODE ======================= -->
                            <script>
                                const btnSearch = document.getElementById('btnSearch');
                                btnSearch.addEventListener('click', loadData);
                                const btnPosts = document.getElementById('btnPosts');
                                btnPosts.addEventListener('click', loadPosts);

                                function loadPosts() {
                                    const url = 'https://49plus.co.uk/test/wp-json/wp/v2/posts';
                                    console.log(url);
                                    fetch(url)
                                        .then(response => response.json())
                                        .then(data => {
                                            // Prints result from `response.json()` in get Request
                                            console.log("POSTS", data)
                                            console.log(data.length);
                                            console.log("Number of posts is " + data.length);
                                            let outputData = "https://49plus.co.uk/test/wp-json/wp/v2/posts"
                                            outputData += "<table><tr><th>ID</th><th>TITLE</th></tr>";
                                            for (let i = 0; i < data.length; i++) {
                                                outputData += "<tr><td>" + data[i].id + "</td><td>" + data[i].title
                                                    .rendered +
                                                    "</td></tr>";
                                            }
                                            outputData += "</table>";
                                            const main = document.getElementById('mainContent');
                                            main.innerHTML = outputData;
                                            main.className = "box";
                                        })
                                        .catch(error => console.error(error))

                                    function loadData() {
                                        const url = 'https://49plus.co.uk/test/wp-json/wordcamp/v2/districts';
                                        console.log(url);
                                        fetch(url)
                                            .then(response => response.json())
                                            .then(data => {
                                                // Prints result from `response.json()` in get Request
                                                console.log("DATA", data)
                                                console.log(data.length);
                                                let outputData =
                                                    "https://49plus.co.uk/test/wp-json/wordcamp/v2/districts";
                                                outputData += "<table><tr><th>ID</th><th>CITY</th></tr>";
                                                for (var i = 0; i < data.length; i++) {
                                                    outputData += "<tr><td> " + data[i].ID + "</td><td>" + data[i]
                                                        .Name +
                                                        "<td></tr>";
                                                }
                                                outputData += "</table>";
                                                const main = document.getElementById('mainContent');
                                                main.innerHTML = outputData;
                                                main.className = "box";
                                            })
                                            .catch(error => console.error(error))
                                    }
                                }
                            </script>
                            <!-- ================ MAIN CODE ======================= -->
                            <div>
                                <br>


                                <?php
                                    global $wpdb;
                                    $db =  $wpdb->dbname;            
                                ?>
                                <p><?php echo "<b>SERVER: </b>".$SITE." <b>DB: </b>".$db;?></p>
                                <p><b>Database:</b> <?php echo $db ?></p>
                                <p><?php echo "<b>CHILD get_theme_file_uri():</b> <br>".get_theme_file_uri(); ?></p>
                                <p><?php echo "<b>CHILD IMAGES FOLDER get_theme_file_uri():</b> <br>".get_theme_file_uri()."/images/"; ?>
                                </p>
                                <p><?php echo "<b>PARENT get_template_directory_uri():</b> <br>". get_template_directory_uri(); ?>
                                </p>

                            </div>
                            <br><br><br>
                            <!-- ************************* END TEMPLATE AREA ********************************-->
                        </div><!-- endcard -->
                        <br><br><br>
                    </div><!-- end col page -->
                </div><!-- end page row -->
            </div><!-- end page container -->
</main>
<!-- End Page Container -->
<br><br><br>
<?php get_footer();
?>