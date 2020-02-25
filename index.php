<?php

if(isset($_POST['test-text-api-submit'])) {
    
    // REMEMBER TO SET YOUR API KEY AS $api_key
    $api_key = 'oTaY0aacKJ9Ttakp3mUZ83zF1hJjRclm3NxeafVw ';

    $content = (isset($_POST['test-text-api-input']) ? $_POST['test-text-api-input'] : '' );

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://dev.api.censorreact.intygrate.com/devv1/text",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => '{"text":"' . $content . '","profile":"default"}',
      CURLOPT_HTTPHEADER => array(
        "content-type: application/json",
        "x-api-key: " . $api_key,
      ),
    ));

    $result = curl_exec($curl);

    print_r($result);
    $api_result = json_decode($result);
    
    curl_close($curl);
}

$_SESSION['text-image'] = 'text';

if(isset($_POST['censorreact-text-image'])) {
  if($_POST['censorreact-text-image'] === 'text') {
    $_SESSION['text-image'] = 'text';
  } else if($_POST['censorreact-text-image'] === 'image') {
    $_SESSION['text-image'] = 'image';
  } 
}


?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>censorREACT PHP Demo</title>

  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=fallback" rel=stylesheet>
  <link rel="stylesheet" href="assets/css/styles.css">
  <script defer src="assets/js/scripts.js"></script>


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

    <div class='api-buttons'>
      <form name='censorreact-text-image' id='censorreact-text-image' method='post'>
        <button type='submit' class='test-text-api-title <?= ($_SESSION['text-image'] === 'text' ? 'active-text-image' : '') ?>' name='censorreact-text-image' value='text'>Text API</button>
        <button type='submit' class='test-image-api-title <?= ($_SESSION['text-image'] === 'image' ? 'active-text-image' : '') ?>' name='censorreact-text-image' value='image'>Image API</button>
        </form>
    </div>
    <?php
    if($_SESSION['text-image'] === 'text'){ ?>

      <form name='test-text-api-form' class='test-text-api-form' method='post'>
        <label for='test-text-api-input'>Enter Text</label>
        <textarea type='text' class='test-text-api-input' name='test-text-api-input'></textarea>
        <button type='submit' class='test-text-api-submit censorreact-btn' name='test-text-api-submit'>Test Text API</button>
      </form>

    <?php } else if($_SESSION['text-image'] === 'image') { ?>

      <form name='test-text-api-form' class='test-text-api-form' method='post'>
        <label for='test-text-api-input'>Enter image</label>
        <div class='imageCanvas'>
          <canvas id="imageCanvasPreview">
            <p>Canvas support needed!</p>
          </canvas>
          <div class="input-div">
            <label for="imageLoader" class="uploadBtn"
              >Upload
              <div class="arrow-up"></div>
              <input
                class="imageLoader"
                id="imageLoader"
                name="imageLoader"
                type="file"
                onchange="handleImg(event)"
                accept="image/*"
              />
            </label>
          </div>
        </div>
        <button type='submit' class='test-text-api-submit censorreact-btn' name='test-text-api-submit'>Test Image API</button>
      </form>
      <img id="hiddenImg" class="hiddenImg" alt='hiddenImg'/>

    <?php } ?>

    <div class='api-result-div'>
      <p class='api-result'>API Result:</p>

      <p><?php
        
        if(isset($api_result)) {
          print("<pre>" . $api_result . "</pre>");
        } else {
          echo 'No text to test';
        }
      
      ?></p>
    </div>

  </div>
  

</div>
</body>
</html> 