<!-- DISPLAY ONLY -->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

<style>
body {
  font-family: 'Open Sans', sans-serif;
  background: black;
  font-size: 18px;
  color: #bbb;
}

#header {
  color: green;
}
.header  {
  color: green;
}
#payload {
  color: orange;
}
.payload {
  color: orange;
}
#signature {
  color: red;
}
.signature {
  color: red;
}
.jwt {
   font-size:0.7em;
   
}
</style>

<?php

// JWT Header
$header = [
  "alg"     => "HS256", // hashing algorithm used
  "typ"     => "JWT"
];

// JWT Payload data
$payload = [
  "id"         => "1234567890",
  "name"       => "Craig West",
  "createdOn"  => "2019-03-23",
  "validUntil" => "2019-03-24"
];

// Highly confidential
$secret = "2020QWERTY";

// ***************** FUNCTIONS *********************

// These functions are in the mu-plugins folder jwt.php.
// They are included here for demo and have a '2' added to the function names 
// so that an ERROR is not thrown for having a function declared twice.

?>

<style>
  body {
    font-size:1.4rem;
  } 
</style>

<div style="padding:40px; word-wrap: break-word;">
<h2>// JWT Header</h2>
<div class="header">
$header = [<br>
  "alg"     => "HS256", // hashing algorithm used<br>
  "typ"     => "JWT"<br>
];<br>
</div>
// JWT Payload data<br>
<div class="payload">
$payload = [<br>
  "id"        => "1234567890",<br>
  "name"        => "Craig West",<br>
  "createdOn"        => "2019-03-23"<br>
  "validUntil" => "2019-03-24"<br>
];<br>
</div>


<?php

 
// ***************** Create the JWT **********************
$jwt = generateJWT('sha256', $header, $payload, $secret);
// ***************** Verify the JWT **********************
$verify = verifyJWT('sha256', $jwt, $secret);
// *******************************************************

//----------------  DISPLAY ONLY -------------------
// The JWT token has format HEADER.PAYLOAD.SIGNATURE
// We can split this string into its three parts and item 2 will contain the PAYLOAD
// This will be $arrJWT[1] as arrays have a starting index of 0.
$arrJWT = explode(".",$jwt);

// display token color coded
if ($verify) { // IF VERIFIED
  echo "<div><br><strong>JWT: </strong><br><span id='header'>".base64UrlEncode(json_encode($header))."</span>.<br><span id='payload'>". base64UrlEncode(json_encode($payload)).".<br></span><span id='signature'>".$arrJWT[2]."</span><br></div>";
  echo "<br><strong>SECRET KEY: </strong><span style='color:green;font-weight:bold;'>". $secret."</span> <br>";
  echo "<strong>VERIFIED: </strong><span style='color:green;font-weight:bold;'>TRUE</span>";
}
else {
    echo "<span class='jwt'><b>JWT TOKEN: </b>".$jwt."</span><br>SECRET KEY ". $secret."<br>VERIFIED: <span style='color:RED;font-weight:bold;'>FALSE</span>";
}


?>
<div>
  <p><h2>Create JWT process:</h2>
    <ol>
      <li>Convert HEADER to JSON.</li>
      <li>Base64 encode it.</li>
      <li>Convert PAYLOAD to JSON.</li>
      <li>Base64 encode it.</li>
      <li>Concatenate the two with a "."</li> 
      <li>Perform HASH on that concatenated string with the SECRET KEY and HASH ALGORITHM to give raw signature.</li> 
      <li>Base64 encode this raw signature to give JWT</li> 
    </ol>
  </p>
</div>
<h2>Decoding JWT token:</h2>
<p>We have our JWT = <span style="color:green;">$arrJWT</span> from above and using  <span style="color:green;">explode(".",$jwt)</span> we split the JWT into its three parts of HEADER, PAYLOAD and SIGNATURE.</p>
<p>Payload is in arrJWT[1] and is just Base64 encoded so we Base64 decode it and then use <span style="color:green;">json_decode</span>.</p>
<p>This gives an associative array.</p>
<p>As we know the data structure of the payload we can get items as we want.</p>

<?php
echo "=======================<br>";
echo "<h2>Payload: ".base64UrlDecode($arrJWT[1])."</h2>";
$arr = json_decode(base64UrlDecode($arrJWT[1]));


// Loop through the associative array as we know structure of payload
// We can use switch
foreach($arr as $key=>$value){
 
  if ($key == "name"){
    $name = $value;
    echo "<h2>name: ". $name."</h2>";
  }
  if ($key == "id"){
   
    $id = $value;
    echo "<h2>id: ". $id."</h2>";
  }
  if ($key == "createdOn"){
   
    $createdOn= $value;
    echo "<h2>createdOn: ". $createdOn."</h2>";
  }
  if ($key == "validUntil"){
   
    $validUntil= $value;
    echo "<h2>validUntil: ". $validUntil."</h2>";
  }
}
// var_dump($arr );
// $arrID = explode(":",$arrPayload[0]); 
// echo "-------";
// $arrPayload = explode(",",base64UrlDecode($arrJWT[1]));
// $ID = str_replace('"',"",$arrID[1]); // get value of id from 2nd item $arrID[1]
// echo "<h2>ID = ".$ID."</h2>"; // remove quotes

//----------------  DISPLAY ONLY -------------------
?>
  
</div>  