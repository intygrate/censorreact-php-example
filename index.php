<?php 

if(isset($_POST['test-text-api-submit'])) {
    
    // REMEMBER TO SET YOUR API KEY AS $api_key
    $api_key = 'erg';

    $content = (isset($_POST['test-text-api-input']) ? $_POST['test-text-api-input'] : '' );

    /* Set the arguments to send through to the API */
    $args = array(
        'method' => 'POST', 
        'body' => json_encode(array(
            'text' => $content, 
            'profile' => 'default' 
        )),
        'headers' => array(
            'Content-Type' => 'application/json',
            'x-api-key' => $api_key  
        ),
    );

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $args);

    curl_setopt($curl, CURLOPT_URL, 'https://api.censorreact.intygrate.com/v1/text');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);


    //Get the result from the API and json_decode it
    $decoded_body = json_decode($response['body'], true);
    print_r($decoded_body);
    $api_result = $decoded_body;

} else {
  $api_result = '';
}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>censorREACT PHP Demo</title>

  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=fallback" rel=stylesheet>
  <link rel="stylesheet" href="assets/css/styles.css">


</head>
<body>
<header>
  <img src="assets/images/censorREACT-logo.png" alt="censorREACT logo">
</header>

<div class='php-demo-content'>
  
  <div class='php-demo-title'>
    <h1>CensorREACT PHP Demo</h1>
  </div>

  <div class='php-demo-content-inner'>

    <h2 class='test-text-api-title'>Test API code</h2>

    <form name='test-text-api-form' class='test-text-api-form' method='post'>
      <label for='test-text-api-input'>Enter Text</label>
      <textarea type='text' class='test-text-api-input' name='test-text-api-input'></textarea>
      <button type='submit' class='test-text-api-submit censorreact-btn' name='test-text-api-submit'>Test API</button>
    </form>

    <div class='api-result-div'>
      <p class='api-result'>API Result:</p>

      <p><?php
        
        if(isset($apiResult)) {
          echo $apiResult;
        } else {
          echo 'No text to test';
        }
      
      ?></p>
    </div>

  </div>
  

</div>
</body>
</html> 