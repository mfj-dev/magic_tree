<?php
include "db.php";
require("config_pay.php");
$stripe = new \Stripe\StripeClient(
    'sk_test_51JctLaBe9I2IrLUJ4KQlPf77OyqeBPxhTnJ7Gmsi6iYcbuXJXYWShmid2PpoYO250l85hZcvdFibMi5zFOMaAkhi003htHJUXq'
  );
 
  $stripe->payouts->create([
    'amount' => 3000,
    'currency' => 'usd',
  ]);
?>