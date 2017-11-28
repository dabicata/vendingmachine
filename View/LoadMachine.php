<?php

$counterProductName = 0;
$counterProductType = 0;
$counterExpireDate = 0;
$counterPrice = 0;
?>
<form action="/vendingmachine/public/index.php?action=loadMachine" method="post">
    <input type="hidden" name="action" value="createProduct">
    <?php foreach ($result[1] as $types): ?>
        <select name="<?php echo "productName" . $counterProductName++; ?>">
            <br>
            <?php foreach ($result[1] as $types2): ?>
                <option value="<?php echo $types2['productTypeName']; ?>"><?php echo $types2['productTypeName']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="number" min="0" name="<?php echo "productCounter" . $counterProductType++; ?>"
               placeholder="Quantity">
        <input type="date" name="<?php echo "productExpireDate" . $counterExpireDate++; ?>">
        <input type="number" min="0" name="<?php echo "productPrice" . $counterPrice++; ?>"
               placeholder="Price">
        <br>
    <?php endforeach; ?>
    <select name="machineId">
        <?php foreach ($result[0] as $machine) {
            echo '<option value="' . $machine['vendingMachineId'] . '">' . $machine['vendingMachineId'] . '</option>';
        }
        ?>
        <br>
    </select>
    <input type="submit" value="Add Products">
</form>