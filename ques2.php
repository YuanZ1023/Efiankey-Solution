<?php
function checkDiscount($purchaseValue) {
    if ($purchaseValue < 100) {
        return "Purchase Value is $purchaseValue, there are no discount.";
    } elseif ($purchaseValue >= 500) {
        return "Purchase Value is $purchaseValue, discount is 10%";
    } else {
        return "Purchase Value is $purchaseValue, discount is 5%";
    }
}

echo checkDiscount(300);
echo checkDiscount(80);
