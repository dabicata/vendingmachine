<form action="index.php?action=editMachine" method="post">
    <input type="hidden" name="action" value="editMachine">
    Machine Rows:<br>
    <input type="number" class="<?php if ($_SESSION['invalidValues']['invalidRowsEditRed'] ?? false) {
        echo 'incorrect';
    } ?>"
           value="<?php if (isset($_SESSION['validValues']['validRowsEdit']) || isset($_SESSION['invalidValues']['invalidRowsEdit'])) {
               if (isset($_SESSION['validValues']['validRowsEdit'])) {
                   echo $_SESSION['validValues']['validRowsEdit'];
               } else {
                   echo $_SESSION['invalidValues']['invalidRowsEdit'];
               }
           } ?>" step="1" min="0" pattern="[0-9]" name="machineRows">
    <br>
    Machine Columns:<br>
    <input type="number" class="<?php if ($_SESSION['invalidValues']['invalidColumnsEditRed'] ?? false) {
        echo 'incorrect';
    } ?>"
           value="<?php if (isset($_SESSION['validValues']['validColumnsEdit']) || isset($_SESSION['invalidValues']['invalidColumnEdit'])) {
               if (isset($_SESSION['validValues']['validColumnsEdit'])) {
                   echo $_SESSION['validValues']['validColumnsEdit'];
               } else {
                   echo $_SESSION['validValues']['invalidColumnsEdit'];
               }
           } ?>" step="1" min="0" pattern="[0-9]" name="machineColumns">
    <br>
    Machine Size:<br>
    <input type="number" class="<?php if ($_SESSION['invalidValues']['invalidSizeEditRed'] ?? false) {
        echo 'incorrect';
    } ?>"
           value="<?php if (isset($_SESSION['validValues']['validSizeEdit']) || isset($_SESSION['invalidValues']['invalidSizeEdit'])) {
               if (isset($_SESSION['validValues']['validSizeEdit'])) {
                   echo $_SESSION['validValues']['validSizeEdit'];
               } else {
                   echo $_SESSION['invalidValues']['invalidSizeEdit'];
               }
           } ?>" step="1" min="0" pattern="[0-9]" name="machineSize">
    <br>
    <input type="hidden" value="<?php echo $machineData['vendingMachineId']; ?>" name="vendingMachineId">
    <input type="submit" value="Save">
</form>
<?php var_dump($_SESSION);