<?php

    $weather = "";
    $error = "";

    if (array_key_exists('city', $_GET)) {

        $city = str_replace(' ', '', $_GET['city']);

        $file_headers = @get_headers("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");


        if($file_headers[0] == 'HTTP/1.1 404 Not Found') {

            $error = "That city could not be found.";

        } else {

        $forecastPage = file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");

        $pageArray = explode('<td colspan="9"><span class="b-forecast__table-description-title"><h2>', $forecastPage);
        if (sizeof($pageArray) > 1) {
          $weather = $pageArray[1];
            } else {

                $error = "That city could not be found.";

            }

        }

    }


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

      <title>Whats the weather?</title>
    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <style type="text/css">

      html {
          background: url(background.jpeg) no-repeat center center fixed;
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
          }

          body {

              background: none;

          }

          .container {

              text-align: center;
              margin-top: 100px;
              width: 450px;

          }

          input {

              margin: 20px 0;

          }

          #weather {

              margin-top:15px;

          }

      </style>

  </head>
  <body>

      <div class="container">

          <h1 class="display-4">What's The Weather?</h1>



          <form>
  <fieldset class="form-group">
    <label for="city">Enter the name of a city.</label>
    <input type="text" class="form-control text-center" name="city" id="city" placeholder="Eg. London, Tokyo" value = "<?php

																										   if (array_key_exists('city', $_GET)) {

																										   echo $_GET['city'];

																										   }

																										   ?>">
  </fieldset>

  <button type="submit" class="btn btn-primary">What is the weather <span id="cityname"></span>?</button>
</form>

          <div id="weather"><?php

              if ($weather) {

                  echo '<div class="alert alert-success" role="alert">
  '.$weather.'
</div>';

              } else if ($error) {

                  echo '<div class="alert alert-danger" role="alert">
  '.$error.'
</div>';

              }

              ?></div>
      </div>

    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript">
  $("#cityname").html("of " + $("#city").val());
  $("#city").on('keydown keyup paste', (e)=> {
    $("#cityname").html("of " + $("#city").val());
  })
</script>
  </body>
</html>
