<?php

$counter = 0;
var_dump($_SESSION);
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
               value="" placeholder="Quantity">
        <input type="date" name="<?php echo "productExpireDate" . $counter; ?>">
        <input type="number" min="0" name="<?php echo "productPrice" . $counter++; ?>"
               placeholder="Price">
        <br>
    <?php endforeach; ?>
    <select name="machineId">
        <?php foreach ($result['machineData'] as $machine): ?>
            <option value="<?php echo $machine['vendingMachineId']; ?>"> <?php echo $machine['vendingMachineId'] ?></option>
        <?php endforeach; ?>
        <br>
    </select>
    <input type="submit" value="Add Products">
</form>