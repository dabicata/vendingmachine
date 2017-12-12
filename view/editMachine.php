<form action="index.php?action=editMachine" method="post">
    <input type="hidden" name="action" value="editMachine">
    Machine Rows:<br>
    <input type="number" class="<?php if ($_SESSION['invalidValues']['invalidRowsEdit'] ?? false) {
        echo 'incorrect';
    } ?>" value="<?php if ($_SESSION['validValues']['validRowsEdit'] ?? false) {
        echo $_SESSION['validValues']['validRowsEdit'];
    } else {
        echo $machineData['vendingMachineRows'];
    } ?>" step="1" min="0" pattern="[0-9]" name="machineRows">
    <br>
    Machine Columns:<br>
    <input type="number" class="<?php if ($_SESSION['invalidValues']['invalidColumnsEdit'] ?? false) {
        echo 'incorrect';
    } ?>" value="<?php if ($_SESSION['validValues']['validColumnsEdit'] ?? false) {
        echo $_SESSION['validValues']['validColumnsEdit'];
    } else {
        echo $machineData['vendingMachineColumns'];
    } ?>" step="1" min="0" pattern="[0-9]" name="machineColumns">
    <br>
    Machine Size:<br>
    <input type="number" class="<?php if ($_SESSION['invalidValues']['invalidSizeEdit'] ?? false) {
        echo 'incorrect';
    } ?>" value="<?php if ($_SESSION['validValues']['validSizeEdit'] ?? false) {
        echo $_SESSION['validValues']['validSizeEdit'];
    } else {
        echo $machineData['machineSize'];
    } ?>" step="1" min="0" pattern="[0-9]" name="machineSize">
    <br>
    <input type="hidden" value="<?php echo $machineData['vendingMachineId']; ?>" name="vendingMachineId">
    <input type="submit" value="Save">
</form>
<?php var_dump($_SESSION);