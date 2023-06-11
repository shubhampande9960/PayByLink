<!DOCTYPE html>
<html>
   <head>
      <title>PayByLink Integration</title>
      <link rel="stylesheet" type="text/css" href="styles.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
   </head>
   <body>
      <h1>PayByLink Integration</h1>
      <?php
         function request() {
         
             // API endpoint URL
         
             $url = "https://eu-test.oppwa.com/paybylink/v1";
         
         
         
             // Payment request data
         
             $data = "entityId=8ac7a4c983c3edda0183c5b8973d766c" .
         
                     "&amount=264.96" .
         
                     "&currency=USD" .
         
                     "&paymentType=DB" .
         
                     "&merchant.name=More Than Sportswear" .
         
                     "&merchantTransactionId=A-123456" .
         
                     "&shopperResultUrl=http://localhost/PayByLink/status.php" .
         
                     "&customer.givenName=John" .
         
                     "&customer.surname=Doe" .
         
                     "&customer.mobile=+491111122222" .
         
                     "&customer.email=john.doe@email.com" .
         
                     "&layout.logo=https://docs.aciworldwide.com/sites/all/themes/devportal_theme/images/more-than-sportswear/logo.png" .
         
                     "&layout.logoWidth=317px" .
         
                     "&layout.logoHeight=117px" .
         
                     "&layout.backgroundImage=https://docs.aciworldwide.com/sites/all/themes/devportal_theme/images/more-than-sportswear/header.jpg" .
         
                     "&layout.merchantNameColor=#ffffff" .
         
                     "&layout.amountColor=#ffffff" .
         
                     "&layout.payButtonColor=#0dcaf0" .
         
                     "&layout.payButtonTextColor=#ffffff" .
         
                     "&cart.items[0].currency=USD" .
         
                     "&cart.items[0].description=Premium Soccer Shoes" .
         
                     "&cart.items[0].merchantItemId=1" .
         
                     "&cart.items[0].name=Premium Soccer Shoes" .
         
                     "&cart.items[0].price=68.99" .
         
                     "&cart.items[0].quantity=1" .
         
                     "&cart.items[0].totalAmount=68.99" .
         
                     "&cart.items[1].currency=USD" .
         
                     "&cart.items[1].description=Blue-White Fan Trikot" .
         
                     "&cart.items[1].merchantItemId=2" .
         
                     "&cart.items[1].name=Blue-White Fan Trikot" .
         
                     "&cart.items[1].price=72.99" .
         
                     "&cart.items[1].quantity=2" .
         
                     "&cart.items[1].totalAmount=145.98" .
         
                     "&cart.items[2].currency=USD" .
         
                     "&cart.items[2].description=Champion Soccer Ball" .
         
                     "&cart.items[2].merchantItemId=3" .
         
                     "&cart.items[2].name=Champion Soccer Ball" .
         
                     "&cart.items[2].price=49.99" .
         
                     "&cart.items[2].quantity=1" .
         
                     "&cart.items[2].totalAmount=49.99";
         
         
         
             $ch = curl_init();
         
             curl_setopt($ch, CURLOPT_URL, $url);
         
             curl_setopt($ch, CURLOPT_HTTPHEADER, array(
         
                 'Authorization:Bearer OGE4Mjk0MTc1ZDYwMjM2OTAxNWQ3M2JmMDBlNTE4MGN8ZE1xNU1hVEQ1cg=='));
         
             curl_setopt($ch, CURLOPT_POST, 1);
         
             curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
         
             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
         
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         
             $responseData = curl_exec($ch);
         
             if (curl_errno($ch)) {
         
                 return curl_error($ch);
         
             }
         
             curl_close($ch);
         
             return $responseData;
         
         }
         
         
         
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         
             $responseData = request();
         
             $response = json_decode($responseData, true);
         
         
         
             if ($response && isset($response['result']['code']) && $response['result']['code'] == '000.000.000') {
         
                 // Payment successful
         
                 echo '<div class="container">';
         
                 echo '<h2>Payment Status</h2>';
         
                 echo '<p class="success"> Payment Link Created Successfully </p>';
         
                 echo '<div class="payment-details">';
         
                 echo '<div class="label">Result Code:</div>';
         
                 echo '<div class="value">' . $response['result']['code'] . '</div>';
         
         
         
                 echo '<div class="label">Build Number:</div>';
         
                 echo '<div class="value">' . $response['buildNumber'] . '</div>';
         
         
         
                 echo '<div class="label">Timestamp:</div>';
         
                 echo '<div class="value">' . $response['timestamp'] . '</div>';
         
         
         
                 echo '<div class="label">NDC:</div>';
         
                 echo '<div class="value">' . $response['ndc'] . '</div>';
         
         
         
                 echo '<div class="label">ID:</div>';
         
                 echo '<div class="value">' . $response['id'] . '</div>';
         
         
         
         echo '<a class="link" href="' . $response['link'] . '" target="_blank" onclick="openPaymentLink(event)"><i class="fas fa-external-link-alt"></i> Payment Link</a>';
         
         
         
         echo '<script>
         
         function openPaymentLink(event) {
         
         event.preventDefault();
         
         window.open(event.target.href, "_blank");
         
         }
         
         </script>';
         
         
         
         // Display the payment link
         
                 echo '<a class="link" href="#" onclick="loadIframe(\'' . $response['link'] . '\')"> Click here to make the payment</a>';
         
                 echo '<iframe id="payment-iframe" src="" style="display: none;"></iframe>';
         
                 
         
         echo '</div>'; // end .payment-details
         
                 echo '</div>'; // end .container
         
         
         
                 // Store the generated {id} in a session
         
                 $_SESSION['payment_id'] = $response['id'];
         
             } else {
         
                 // Payment failed
         
                 echo '<div class="container">';
         
                 echo '<h1>Payment Status</h1>';
         
                 echo '<p class="error">Payment failed: ' . $responseData . '</p>';
         
                 echo '</div>'; // end .container
         
             }
         
         }
         
         ?>
      <script>
         function loadIframe(link) {
         
             var iframe = document.getElementById('payment-iframe');
         
             iframe.src = link;
         
             iframe.style.display = 'block';
         
         }
         
      </script>
      <form method="POST">
         <br>
         <input type="submit" value="Make Payment">
      </form>
   </body>
</html>
