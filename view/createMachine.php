<form action="index.php?action=createMachine" method="post">
    <input type="hidden" name="action" value="createMachine">
    Machine Rows:<br>
    <input type="number" class="<?php if ($_SESSION['invalidValues']['invalidRows'] ?? false) {
        echo 'incorrect';
    } ?>" value="<?php if ($_SESSION['validValues']['validRows'] ?? false) {
        echo $_SESSION['validValues']['validRows'];
    } ?>" step="1" min="0" pattern="[0-9]" name="machineRows">
    <br>Machine Columns:<br>
    <input type="number" class="<?php if ($_SESSION['invalidValues']['invalidColumns'] ?? false) {
        echo 'incorrect';
    } ?>" value="<?php if ($_SESSION['validValues']['validColumns'] ?? false) {
        echo $_SESSION['validValues']['validColumns'];
    } ?>" step="1" min="0" pattern="[0-9]" name="machineColumns">
    <br>
    Machine Size:<br>
    <input type="number" class="<?php if ($_SESSION['invalidValues']['invalidSize'] ?? false) {
        echo 'incorrect';
    } ?>" value="<?php if ($_SESSION['validValues']['validSize'] ?? false) {
        echo $_SESSION['validValues']['validSize'];
    } ?>" step="1" min="0" pattern="[0-9]" name="machineSize">
    <br>
    <input type="submit" value="Create Machine">
</form>
