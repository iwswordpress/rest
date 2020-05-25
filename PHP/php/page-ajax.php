<?php

get_header(); ?>

<!-- Page Container -->
<?php include 'server.php'; ?>
<main>
   
<div class="w3-container w3-content" style="max-width:1200px;margin-top:10px;border:2px solid #2196f3;border-radius:10px;">
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
                            <input id="btnPosts" name="btnPosts" class="w3-btn w3-border w3-large w3-blue"
                                    value="LOAD POSTS">
                                <input id="btnSearch" name="btnSearch" class="w3-btn w3-border w3-large w3-blue"
                                    value="LOAD MySQL">
                            </div>
                            <div id="mainContent"></div>
                            <!-- ================ MAIN CODE ======================= -->
                            <!-- Very good short video on FETCH JSON https://www.youtube.com/watch?v=cuEtnrL9-H0 -->
                            <!-- Very good short video on PROMISES https://www.youtube.com/watch?v=DHvZLI7Db8E -->
                            <!-- 
                                jQuery .done .fail .always
                                fetch  .then .catch .finally 
                            -->
                            <script>
                                // DOM Elements
                                const btnSearch = document.getElementById('btnSearch');
                                btnSearch.addEventListener('click', loadData);
                                const btnPosts = document.getElementById('btnPosts');
                                btnPosts.addEventListener('click', loadPosts);
                                // GET MySQL DATA
                                function loadData() {
                                    // Generate URL
                                    const url = '<?php echo $SITE; ?>' + 'wp-json/wordcamp/v2/districts';
                                    console.log(url);
                                    fetch(url)
                                        .then(response => {
                                                console.log(response);
                                                return response.json();
                                            })
                                        .then(data => {
                                            // Prints result from `response.json()` in get Request
                                            console.log("DATA", data)
                                            console.log(data.length);
                                            let outputData = '<?php echo $SITE; ?>' + 'wp-json/wordcamp/v2/districts';
                                            outputData += '<table class="w3-table w3-border w3-striped" ><tr><th>ID</th><th>CITY</th></tr>';
                                            for (var i = 0; i < data.length; i++) {
                                                outputData += "<tr><td> " + data[i].ID + "</td><td>" + data[i].Name + "</td></tr>";
                                            }
                                            outputData += "</table>";
                                            const main = document.getElementById('mainContent');
                                            main.innerHTML = outputData;
                                            //main.className = "box";
                                        })
                                        .catch(error => console.error(error))
                                }
                                // GET POSTS
                                function loadPosts() {
                                    // Generate URL
                                    const url =  '<?php echo $SITE; ?>' + 'wp-json/wp/v2/posts';
                                    console.log(url);
                                    fetch(url)
                                        .then(response => {
                                                console.log(response);
                                                return response.json();
                                            })
                                        .then(dataArray => {
                                            // Prints result from `response.json()` in get Request
                                            console.log("POSTS", dataArray)
                                            console.log(dataArray.length);
                                            console.log("Number of posts is " + dataArray.length);
                                            let outputData =  '<?php echo $SITE; ?>' + 'wp-json/wp/v2/posts';
                                          
                                         outputData += '<table class="w3-table w3-border w3-striped "><tr><th>ID</th><th>TITLE</th></tr>';
                                         for (let i = 0; i < dataArray.length; i++) {
                                            outputData += "<tr><td>" + dataArray[i].id + "</td><td>" + dataArray[i].title.rendered + "</td></tr>";
                                         }
                                         outputData += "</table>";
                                        
                                            const main = document.getElementById('mainContent');
                                            main.innerHTML = outputData;
                                            //main.className = "box";
                                        })
                                        .catch(error => console.error(error))
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
                                <p><?php echo "<b>CHILD IMAGES FOLDER get_theme_file_uri():</b> <br>".get_theme_file_uri()."/images/"; ?></p>
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