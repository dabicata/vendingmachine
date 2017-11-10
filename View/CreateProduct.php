<?php

namespace vending\view;


use vending\model\ProductTypeDAO;


include_once __DIR__ . '/../model/DAO/ProductTypeDAO.php';
include __DIR__ . '/../controller/Chips.php';
include __DIR__ . '/../controller/Cola.php';
include __DIR__ . '/../controller/Snikers.php';


$productTypes = new ProductTypeDAO();
$productTypesArray = $productTypes->selectAll();
$counterProductName = 0;
$counterProductType = 0;
$counterExpireDate = 0;
$counterPrice = 0;
?>
<!DOCTYPE html>
<html>
<body>
<form action="/vendingmachine/controller/Controller.php" method="post">
    <input type="hidden" name="action" value="createProduct">
    <?php foreach ($productTypesArray as $types): ?>
        <select name="<?php echo "productName" . $counterProductName++; ?>">
            <br>
            <?php foreach ($productTypesArray as $types): ?>
                <option value="<?php echo $types['productTypeName']; ?>"><?php echo $types['productTypeName']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="number" min="0" name="<?php echo "productCounter" . $counterProductType++; ?>"
               placeholder="Quantity">
        <input type="date" name="<?php echo "productExpireDate" . $counterExpireDate++; ?>">

        <input type="number" min="0" name="<?php echo "productPrice" . $counterPrice++; ?>"
               placeholder="Price">
        <br>
    <?php endforeach; ?>
    <input type="submit" value="Submit">
</form>
</body>
</html>


