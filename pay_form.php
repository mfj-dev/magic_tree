<?php
session_start();
require("config_pay.php");
?>
<form action="pay_submit.php" method="post">
<script 
src="https://checkout.stripe.com/checkout.js" class="stripe-button"
data-key="<?php echo $PublishableKey?>"
data-amount="3000"
data-name="Majestic Tree"
data-description="joining fee"
data-image="images\logo.svg"
data-currency="usd"
data-email=<?php echo $_SESSION['r_email']?>
>
</script>
</form>