<?php
include('securepay.php');

$sp = new SecurePay('ABC0001','abc123');
$sp->TestMode(); // Remove this line to actually preform a transaction

$sp->TestConnection();
print_r($sp->ResponseXml);

$sp->Cc = 4444333322221111;
$sp->ExpiryDate = '07/17';
$sp->ChargeAmount = 123;
$sp->ChargeCurrency = 'AUD';
$sp->Cvv = 321;
$sp->OrderId = 'ORD34234';
if ($sp->Valid()) { // Is the above data valid?
    $response = $sp->Process();
    if ($response == SECUREPAY_STATUS_APPROVED) {
        echo "Transaction was a success\n";
    } else {
        echo "Transaction failed with the error code: $response\n";
        echo "XML Dump: " . print_r($sp->ResponseXml,1) . "\n";
    }
} else {
    die("Your data is invalid\n");
}
?>
