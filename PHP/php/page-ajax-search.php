<?php

get_header(); ?>

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
                                    const url = '<?php echo $SITE; ?>' + 'wp-json/wp/v2/posts?s=' + x;

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