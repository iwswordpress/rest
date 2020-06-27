<?php

get_header(); ?>

<!-- Page Container -->
<?php include 'server.php'; ?>
<main>

    <div class="w3-container w3-content"
        style="max-width:1200px;margin-top:10px;border:2px solid #2196f3;border-radius:10px;">
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
                                <input id="btnPosts" name="btnPosts" class="w3-btn w3-border w3-large w3-blue" value="LOAD POSTS">
                                <input id="btnMySQL" name="btnMySQL" class="w3-btn w3-border w3-large w3-blue" value="LOAD MySQL">
                                <input id="btnACF" name="btnACF" class="w3-btn w3-border w3-large w3-blue" value="LOAD ACF">
                            </div>
                            <div id="mainContent"></div>
                           
                            <!-- ================ MAIN CODE ======================= -->
                            <!-- Very good short video on FETCH JSON https://www.youtube.com/watch?v=cuEtnrL9-H0 -->
                            <!-- Very good short video on PROMISES https://www.youtube.com/watch?v=DHvZLI7Db8E -->
                            <!-- 
                                jQuery .done .fail .always
                                fetch  .then .catch .finally 
                            -->
                            <!-- In mixed owner sites, please use register and enqueueu scripts -->
                            <!-- Page level scripts added for demo purposes -->
                            <script>
                                // DOM Elements
                                    //LOAD DATA - custom MySQL table
                                const btnMySQL = document.getElementById('btnMySQL');
                                btnMySQL.addEventListener('click', loadData);
                                    // GET ACF FIELDS
                                const btnACF = document.getElementById('btnACF');
                                btnACF.addEventListener('click', loadACF);
                                    //LOAD POSTS - latest 10 possts
                                const btnPosts = document.getElementById('btnPosts');
                                btnPosts.addEventListener('click', loadPosts);


                                // GET POSTS
                                function loadPosts() {
                                    // Generate URL
                                    const url = '<?php echo $SITE; ?>' + 'wp-json/wp/v2/posts';
                                    console.log(url);
                                    fetch(url)
                                        .then(response => {
                                            console.log("We get back a STREAM initially...");
                                            console.log(response);
                                            return response.json();
                                        })
                                        .then(dataArray => {
                                            // Prints result from `response.json()` in get Request
                                            console.log("RESPONSE.JSON() is used to convert stream to JSON...");
                                            console.log("POSTS", dataArray)
                                            console.log(dataArray.length);
                                            console.log("Number of posts is " + dataArray.length);
                                            let outputData = '<?php echo $SITE; ?>' + 'wp-json/wp/v2/posts';

                                            outputData +=
                                                '<table class="w3-table w3-border w3-striped "><tr><th>ID</th><th>TITLE</th></tr>';
                                            for (let i = 0; i < dataArray.length; i++) {
                                                outputData += "<tr><td>" + dataArray[i].id + "</td><td>" +
                                                    dataArray[i].title.rendered + "</td></tr>";
                                            }
                                            outputData += "</table>";

                                            const main = document.getElementById('mainContent');
                                            main.innerHTML = outputData;

                                        })
                                        .catch(error => console.error(error))
                                }
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
                                            let outputData = '<?php echo $SITE; ?>' +
                                                'wp-json/wordcamp/v2/districts';
                                            outputData +=
                                                '<table class="w3-table w3-border w3-striped" ><tr><th>ID</th><th>CITY</th></tr>';
                                            for (var i = 0; i < data.length; i++) {
                                                outputData += "<tr><td> " + data[i].ID + "</td><td>" + data[i]
                                                    .Name + "</td></tr>";
                                            }
                                            outputData += "</table>";
                                            const main = document.getElementById('mainContent');
                                            main.innerHTML = outputData;
                                            //main.className = "box";
                                        })
                                        .catch(error => console.error(error))
                                }
                                  // GET MySQL DATA
                                  function loadACF() {
                                    // Generate URL
                                    const url = 'https://49plus.co.uk/udemy/wp-json/wp/v2/posts?_fields=id,authorName,acf';
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
                                            let outputData = '<?php echo $SITE; ?>' + 'wp-json/wp/v2/posts?_fields=id,authorName,acf';
                                            outputData +=
                                                '<table class="w3-table w3-border w3-striped" ><tr><th>ID</th><th>CITY</th></tr>';
                                            for (var i = 0; i < data.length; i++) {
                                                outputData += "<tr><td> " + data[i].id + "</td><td>" + data[i].acf.source + "</td></tr>";
                                            }
                                            outputData += "</table>";
                                            const main = document.getElementById('mainContent');
                                            main.innerHTML = outputData;
                                            //main.className = "box";
                                        })
                                        .catch(error => console.error(error))
                                }
                                // GET POSTS

                            </script>
                            <!-- ================ MAIN CODE ======================= -->
                            <div>
                            <div style="height:250px"></div> 
                            <div style="height:250px"></div>

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