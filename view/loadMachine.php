<?php

$counter = 0;
var_dump($_SESSION);
var_dump(isset($_SESSION['validValues'][$counter]['invalidPrice']));
?>
<form action="index.php?action=loadMachine" method="post">
    <input type="hidden" name="action" value="createProduct">
    <?php foreach ($result['productType'] as $types): ?>
        <select name="<?php echo "productName" . $counter; ?>">
            <br>
            <?php foreach ($result['productType'] as $types2): ?>
                <option value="<?php echo $types2['productTypeName']; ?>"><?php echo $types2['productTypeName']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="number" min="0" name="<?php echo "productQuantity" . $counter; ?>"
               class="<?php if ($_SESSION['invalidValues'][$counter]['invalidQuantityRed'] ?? false) {
                   echo 'incorrect';
               } ?>"
               value="<?php
               if (isset($_SESSION['validValues'][$counter]['validQuantity']) || isset($_SESSION['invalidValues'][$counter]['invalidQuantity'])) {
                   if (isset($_SESSION['validValues'][$counter]['validQuantity'])) {
                       echo $_SESSION['validValues'][$counter]['validQuantity'];
                   } else {
                       echo $_SESSION['invalidValues'][$counter]['invalidQuantity'];
                   }
               } ?>" placeholder="Quantity">
        <input type="date" class="<?php if ($_SESSION['invalidValues'][$counter]['invalidDateRed'] ?? false) {
            echo 'incorrect';
        } ?>" value="<?php
        if (isset($_SESSION['validValues'][$counter]['validDate']) || isset($_SESSION['invalidValues'][$counter]['invalidDate'])) {
            if (isset($_SESSION['validValues'][$counter]['validDate'])) {
                echo $_SESSION['validValues'][$counter]['validDate'];
            } else {
                echo $_SESSION['invalidValues'][$counter]['invalidDate'];
            }
        } ?>" name=" <?php echo "productExpireDate" . $counter; ?>">

        <input type="number" min="0" name="<?php echo "productPrice" . $counter; ?>"
               class="<?php if ($_SESSION['invalidValues'][$counter]['invalidPriceRed'] ?? false) {
                   echo 'incorrect';
               } ?>" value="<?php
        if (isset($_SESSION['validValues'][$counter]['validPrice']) || isset($_SESSION['invalidValues'][$counter]['invalidPrice'])) {
            if (isset($_SESSION['validValues'][$counter]['validPrice'])) {
                echo $_SESSION['validValues'][$counter]['validPrice'];
            } else {
                echo $_SESSION['invalidValues'][$counter]['invalidPrice'];
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