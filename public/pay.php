function request() {
$url = "https://test.oppwa.com/v1/payments";
$data = "entityId=8a8294174b7ecb28014b9699220015ca" .
"&amount=92.00" .
"&currency=EUR" .
"&paymentBrand=VISA" .
"&paymentType=DB" .
"&card.number=4200000000000000" .
"&card.holder=Jane Jones" .
"&card.expiryMonth=05" .
"&card.expiryYear=2034" .
"&card.cvv=123";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$responseData = curl_exec($ch);
if(curl_errno($ch)) {
return curl_error($ch);
}
curl_close($ch);
return $responseData;
}
$responseData = request();
