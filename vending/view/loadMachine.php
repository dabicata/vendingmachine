<?php

$counter = 0;
?>
<form action="index.php?action=loadMachineView" method="post">
    <input type="hidden" name="action" value="createProduct">
    <?php foreach ($result['productType'] as $types): ?>
        <select name="<?php echo "productName" . $counter; ?>">
            <br>
            <?php foreach ($result['productType'] as $types2): ?>
                <option value="<?php echo $types2['productTypeName']; ?>"><?php echo $types2['productTypeName']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="number" min="0" name="<?php echo "productQuantity" . $counter; ?>"
               class="<?php if ($array['invalidValues'][$counter]['invalidQuantityRed'] ?? false) {
                   echo 'incorrect';
               } ?>"
               value="<?php
               if (isset($array['validValues'][$counter]['validQuantity']) || isset($array['invalidValues'][$counter]['invalidQuantity'])) {
                   if (isset($array['validValues'][$counter]['validQuantity'])) {
                       echo $array['validValues'][$counter]['validQuantity'];
                   } else {
                       echo $array['invalidValues'][$counter]['invalidQuantity'];
                   }
               } ?>" placeholder="Quantity">
        <input type="date" class="<?php if ($array['invalidValues'][$counter]['invalidDateRed'] ?? false) {
            echo 'incorrect';
        } ?>" value="<?php
        if (isset($array['validValues'][$counter]['validDate']) || isset($array['invalidValues'][$counter]['invalidDate'])) {
            if (isset($array['validValues'][$counter]['validDate'])) {
                echo $array['validValues'][$counter]['validDate'];
            } else {
                echo $array['invalidValues'][$counter]['invalidDate'];
            }
        } ?>" name=" <?php echo "productExpireDate" . $counter; ?>">

        <input type="number" min="0" name="<?php echo "productPrice" . $counter; ?>"
               class="<?php if ($array['invalidValues'][$counter]['invalidPriceRed'] ?? false) {
                   echo 'incorrect';
               } ?>" value="<?php
        if (isset($array['validValues'][$counter]['validPrice']) || isset($array['invalidValues'][$counter]['invalidPrice'])) {
            if (isset($array['validValues'][$counter]['validPrice'])) {
                echo $array['validValues'][$counter]['validPrice'];
            } else {
                echo $array['invalidValues'][$counter]['invalidPrice'];
            }
        } ?>" placeholder="Price">
        <br>
        <?php $counter++;
    endforeach; ?>
    <select name="machineId">
        <?php foreach ($result['machineData'] as $machine): ?>
            <option value="<?php echo $machine['vendingMachineId']; ?>"> <?php echo $machine['vendingMachineId'] ?></option>
        <?php endforeach; ?>
        <br>
    </select>
    <input type="submit" value="Add Products">
</form>