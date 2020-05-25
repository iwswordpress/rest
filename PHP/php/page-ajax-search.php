<?php

get_header(); ?>

<?php include 'server.php'; ?>

<main>
   
<div class="w3-container w3-content" style="max-width:1200px;margin-top:10px;border-radius:10px;">
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
                                <input id="x" type="text" name="searchTerm" placeholder="search..." value="JSON">

                                <input id="btnSearch" name="btnSearch" class="w3-btn w3-border w3-large w3-blue"
                                    value="SEARCH">
                            </div>
                            <div id="mainContent2"></div>
                            <!-- ================ MAIN CODE ======================= -->
                            <script>
                                // DOM Elements
                                const btnSearch = document.getElementById('btnSearch');
                                btnSearch.addEventListener('click', searchHandler);

                                // GET SEARCH DATA
                                function searchHandler() {
                                    //alert("TEST");
                                    console.log("== SEARCH ===");
                                    const x = document.getElementById('x').value;
                                    console.log('search for: ', x);
                                    // Generate URL
                                    const url = '<?php echo $SITE; ?>' + 'wp-json/wp/v2/posts?search=' + x;

                                    console.log(url);
                                    fetch(url)
                                        .then(response => response.json())
                                        .then(dataArray => {
                                            // Prints result from `response.json()` in get Request
                                            console.log("dataArray", dataArray)
                                            console.log(dataArray.length);
                                            let outputData = "";
                                         
                                            outputData +=
                                            '<table class="w3-table w3-border w3-striped "><tr><th>ID</th><th>TITLE</th></tr>';
                                            for (let i = 0; i < dataArray.length; i++) {
                                            outputData += "<tr><td>" + dataArray[i].id + "</td><td>" + dataArray[i].title.rendered +
                                                "</td></tr>";
                                            }
                                            outputData += "</table>";
                                           

                                            const main2 = document.getElementById('mainContent2');
                                            main2.innerHTML = outputData;
                                            //main2.className = "box";
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
       <div style="height:100px;"></div>
</main>
<br><br>
<!-- End Page Container -->

<?php get_footer();

?>