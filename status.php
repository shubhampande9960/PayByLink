<!DOCTYPE html>
<html>
   <head>
      <title>Checkout Status</title>
   </head>
   <body>
      <?php
         $checkoutId = $_GET["checkoutId"];
         
         $Id = $_GET["id"];
         
         $responseData = request($checkoutId, $Id);
         
         
         
         function request($checkoutId, $Id)
         
         {
         
         
         
         	$url = "https://eu-test.oppwa.com/paybylink/v1/" . $Id . "/checkouts/" . $checkoutId . "/payment";
         
         	$url .= "?entityId=8ac7a4c983c3edda0183c5b8973d766c";
         
         
         
             $ch = curl_init();
         
             curl_setopt($ch, CURLOPT_URL, $url);
         
             curl_setopt($ch, CURLOPT_HTTPHEADER, [
         
                 "Authorization:Bearer OGE4Mjk0MTc1ZDYwMjM2OTAxNWQ3M2JmMDBlNTE4MGN8ZE1xNU1hVEQ1cg==",
         
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
         <textarea name="" id="txt_result" cols="100" rows="30"  
         <pre>
         <?php echo $responseData; ?> </textarea>
      </div>
      <br><br>
      <div class="field">
         <div class="control">
            <a href="http://localhost/PayByLink/" class="button is-primary is-small">
            </span>
            <span>Submit Another Request</span>
            </a>
         </div>
      </div>
   </body>
</html>
