<?php
get_header(); ?>
<!-- Page Container -->
<?php include 'server.php'; ?>
<main>
   <div class="w3-container w3-content"
      style="max-width:1400px;margin-top:10px;border:2px solid #2196f3;border-radius:10px;">
      <!-- W3 CSS Grid -->
      <div class="w3-row">
         <div class="w3-col m12">
            <!-- ************************* START TEMPLATE AREA ********************************-->
            <!-- CONTENT CARD-->
            <header class="w3-container w3-blue" style="margin-top:20px;">
               <script>
                  document.write(' <div style="font-size:40px;">WEB COMPONENT</div>');
               </script>
               <!-- <h1 style="font-size:40px;">WordCamp Dublin</h1> -->
            </header>
           
                     <style>
                        :root {}
                        body {
                           background-color: #fff;
                           box-sizing: border-box;
                           overflow-y: scroll;
                           font-family: "Quicksand";
                        }
                        .postGrid {
                           display: grid;
                           grid-template-columns: 10% 90%;
                           grid-gap: 20px;
                           border: 3px solid #ffa500;
                           border-radius: 10px;
                           background: #fff;
                           padding: 10px;
                           overflow:hidden;
                        }
                        .main {
                          
                           margin-top: 70px;
                        }
                     </style>
                     </head>
                     <body>
                        <div id="status"></div>
                        <main>
                           <div class="main">
                              <div class="postGrid">
                                 <!-- ================== WEB COMPONENTS HERE ================== -->
       
<!-- -->   
<!-- -->                         
                                 <all-posts></all-posts>
<!-- -->                                  
                                 <the-post></the-post>
<!-- -->  
<!-- -->  
<!-- -->  
                                 <!-- ================== WEB COMPONENTS HERE ================== -->
<!-- -->  
<!-- -->                   
                                 <script>
                                    const template = document.createElement('template');
                                    template.innerHTML = `
                                       <style>
                                          body {
                                             box-sizing: border-box;
                                             
                                          }
                                          button {
                                             display: block;
                                             padding: 12px;
                                             margin: 0 0 10px 10px;
                                             width:100px;
                                             font-size: 1.2rem;
                                             color:black;
                                             font-weight: bolder;
                                             background:#fff;
                                             cursor:pointer;
                                             border: 1px solid orange;
                                             border-radius: 15px;
                                             text-align:center;
                                             outline:none;
                                          }
                                          button:hover {
                                             background: #fff;
                                             color:white;
                                             outline:none;
                                          }
                                       </style>
                                       <section></section>
                                    `;
                                    class PostDetail extends HTMLElement {
                                       constructor() {
                                          super();
                                          this.attachShadow({
                                             mode: 'open'
                                          });
                                       }
                                       get aPost() {
                                          // occurs every time we output post data which is 4 x in card at bottom
                                          // console.log("[POST-DETAIL COMPONENT] WILL RETURN ON RENDER " + this._post.id);
                                          return this._post;
                                       }
                                       set aPost(value) {
                                          // post objects sent in Custom Event in post-list.js
                                          this._post = value;
                                          this._render();
                                       }
                                       _render() {
                                          this.shadowRoot.innerHTML = `
                                             <style>
                                                body {
                                                   font-family: "Quicksand";
                                                   box-sizing: border-box;
                                                }
                                                .card {
                                                   max-width:100%;
                                                   word-break: break-all;
                                                  
                                                }
                                                h2 {
                                                   margin-top:0;
                                                   color:#2196f3;
                                                   font-size:1.8rem;
                                                }
                                                p {
                                                   font-size:1.4rem;
                                                }
                                             </style>
                                             <div class="card">
                                                <h2>${this.aPost.title.rendered}</h2>
                                                <h3>Post ID of  ${this.aPost.id}</h3>
                                                <h3>Authored by ${this.aPost.authorName}</h3>
                                                <p>${this.aPost.content.rendered}</p>
                                             </div>
                                          `;
                                       }
                                    }

                                    // This would normally be a JS file that is enqueued...
                                    customElements.define('the-post', PostDetail);
                                    class PostList extends HTMLElement {
                                       constructor() {
                                          super();
                                          this.attachShadow({
                                             mode: 'open'
                                          });
                                          // true means deep clone
                                          this.shadowRoot.appendChild(template.content.cloneNode(true));
                                          this.postListElement = this.shadowRoot.querySelector('section');
                                       }
                                       get allPosts() {
                                          return this._arrayOfPosts;
                                       }
                                       set allPosts(value) {
                                          this._arrayOfPosts = value;
                                          console.log('post-list.js ', this._arrayOfPosts);
                                          this._render();
                                       }
                                       _render() {
                                          this._arrayOfPosts.forEach(postArray => {
                                             const button = document.createElement('button');
                                             // add id number to button display
                                             button.appendChild(document.createTextNode(postArray.id));
                                             button.addEventListener('click', (e) => {
                                                // we create an event and also send with it the postArray
                                                this.dispatchEvent(new CustomEvent('selectedPost', {
                                                   detail: postArray
                                                }));
                                             });
                                             this.postListElement.appendChild(button);
                                          });
                                       }
                                    }
                                    customElements.define('all-posts', PostList);
                                    const postListComponent = document.querySelector('all-posts');
                                    const postDetailComponent = document.querySelector('the-post');
                                    //let url = '../_data/cat25.json';
                                    let url = 'https://49plus.co.uk/udemy/wp-json/wp/v2/posts';
                                    console.log("[URL] " + url);
                                    // selectedPost is the name of a Custom Event defined in post-list.js
                                    // when button clicked the event is fired and data passed to index.js
                                    // this then uses SETTER to load post detail component
                                    postListComponent.addEventListener('selectedPost', e => {
                                       // links to post-detail.js
                                       postDetailComponent.aPost = e.detail;
                                    });
                                    fetch(url)
                                       .then(res => res.json())
                                       .then(data => {
                                          console.log("FETCH", data);
                                          // load the postListComponent with array of posts
                                          // we can set a property on an HTML tag and this property can be an array
                                          // links to post-list.js and uses 'set' function
                                          postListComponent.allPosts = data;
                                          // set initial post to be displayed
                                          // if value of array is invalid there will be no display
                                          // Comment out line below to not show a post initially
                                          // links to post-detail.js and uses set funtion
                                          postDetailComponent.aPost = data[0];
                                          //alert(data[2].id + ' ' + data[2].slug) ;
                                       });
                                 </script>
                                 <!-- ================== WEB COMPONENTS HERE ================== -->
                              </div>
                           </div>
                        </main>
                        <script>
                           // THIS USES BROWSER'S ONLINE EVENT
                           // 
                           window.addEventListener('load', function () {
                              var status = document.getElementById("status");
                              //var log = document.getElementById("log");
                              function updateOnlineStatus(event) {
                                 // detect change in online status and do something message and style wise...
                                 var condition = navigator.onLine ? "online" : "offline";
                                 if (condition === "offline") {
                                    //status.className = "offline";
                                    status.innerHTML =
                                       "<span class='offline' style='color:red;font-weight:bold;font-size:1.5rem;'>YOU ARE NOW: " +
                                       condition.toUpperCase() +
                                       " - external links will not work but posts will...</span>";
                                    // set background to grey to emphasise offline
                                    document.querySelector('main').style.backgroundColor= "#eee";
                                 } else {
                                    status.className = "";
                                    status.innerHTML = "";
                                    document.querySelector('main').style.backgroundColor= "#fff";
                                 }
                              }
                              window.addEventListener('online', updateOnlineStatus);
                              window.addEventListener('offline', updateOnlineStatus);
                           });
                        </script>
                        <!-- ================ MAIN CODE ======================= -->
                      <br><br>
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