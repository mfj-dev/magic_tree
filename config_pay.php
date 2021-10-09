<?php
require('stripe-php-master/init.php');
$PublishableKey="pk_test_51JctLaBe9I2IrLUJV2H2VeKJmozlmq2ThmPScwweOol61nkOxcfPk0iB5jcfAENni5lgRqFAYwoRR4OxLLbTzoEn004CYqfk3Y";
$SecretKey="sk_test_51JctLaBe9I2IrLUJ4KQlPf77OyqeBPxhTnJ7Gmsi6iYcbuXJXYWShmid2PpoYO250l85hZcvdFibMi5zFOMaAkhi003htHJUXq";
\Stripe\Stripe::setApiKey($SecretKey);
?>