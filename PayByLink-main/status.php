<!DOCTYPE html>
<html>
   <head>
      <title>PayByLink Status</title>
   </head>
   <body>
      <?php
         $checkoutId = $_GET["checkoutId"];
         
         $Id = $_GET["id"];
         
         $responseData = request($checkoutId, $Id);
         
         // Function to format the JSON string in a stylish format
         function formatJson($jsonString) {
             $decodedJson = json_decode($jsonString, true);
             if ($decodedJson === null) {
                 return $jsonString; // Invalid JSON, return as is
             }
             return json_encode($decodedJson, JSON_PRETTY_PRINT);
         }
         
         
         
         function request($checkoutId, $Id)
         
         {
         
         
         
         	$url = "https://eu-test.oppwa.com/paybylink/v1/" . $Id . "/checkouts/" . $checkoutId . "/payment";
         
         	$url .= "?entityId=8ac7a4c79394bdc801939736f1d10646";
         
         
         
             $ch = curl_init();
         
             curl_setopt($ch, CURLOPT_URL, $url);
         
             curl_setopt($ch, CURLOPT_HTTPHEADER, [
         
                 "Authorization:Bearer OGFjN2E0Yzc5Mzk0YmRjODAxOTM5NzM2ZjFhNzA2NDF8enlac1lYckc4QXk6bjYzI1NHNng=",
         
             ]);
         
             curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
         
             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
         
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         
             $responseData = curl_exec($ch);
         
             if (curl_errno($ch)) {
         
                 return curl_error($ch);
         
             }
         
             curl_close($ch);
         
             return $responseData;
         
         }
         
         ?>
      <h1>Transaction Response</h1>
      <div>
         <textarea name="" id="txt_result" cols="100" rows="30"><?php echo formatJson($responseData); ?></textarea>
      </div>
      <br><br>
      <div class="field">
         <div class="control">
            <a href="http://localhost/PayByLink-main/" class="button is-primary is-small">
            </span>
            <span>Submit Another Request</span>
            </a>
         </div>
      </div>
   </body>
</html>
