<?php

$counter = 0;
var_dump($_SESSION);
var_dump(isset($_SESSION['validValues'][$counter]['validCounter']));
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
        <input type="number" min="0" name="<?php echo "productCounter" . $counter; ?>"
               class="<?php if ($_SESSION['invalidValues'][$counter]['invalidQuantity'] ?? false) {
                   echo 'incorrect';
               } ?>"
               value="<?php if ($_SESSION['validValues'][$counter]['validCounter'] ?? false) {
                   echo $_SESSION['validValues'][$counter]['validCounter'];
               } ?>" placeholder="Quantity">
        <input type="date" class="<?php if ($_SESSION['invalidValues'][$counter]['invalidDate'] ?? false) {
            echo 'incorrect';
        } ?>"
               value="<?php if ($_SESSION['validValues'][$counter]['validDate'] ?? false) {
                   echo $_SESSION['validValues'][$counter]['validDate'];
               } ?>" name=" <?php echo "productExpireDate" . $counter; ?>">

        <input type="number" min="0" name="<?php echo "productPrice" . $counter; ?>"
               class="<?php if ($_SESSION['invalidValues'][$counter]['invalidPrice'] ?? false) {
                   echo 'incorrect';
               } ?>" value="<?php if ($_SESSION['validValues'][$counter]['validPrice'] ?? false) {
            echo $_SESSION['validValues'][$counter]['validPrice'];
        } ?>"
               placeholder="Price">
        <br>
        <?php $counter++; endforeach; ?>
    <select name="machineId">
        <?php foreach ($result['machineData'] as $machine): ?>
            <option value="<?php echo $machine['vendingMachineId']; ?>"> <?php echo $machine['vendingMachineId'] ?></option>
        <?php endforeach; ?>
        <br>
    </select>
    <input type="submit" value="Add Products">
</form>