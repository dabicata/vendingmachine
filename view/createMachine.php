<form action="index.php?action=createMachine" method="post">
    <input type="hidden" name="action" value="createMachine">
    Machine Rows:<br>
    <input type="number" class="<?php if ($_SESSION['invalidValues']['invalidRowsRed'] ?? false) {
        echo 'incorrect';
    } ?>"
           value="<?php if (isset($_SESSION['validValues']['validRows']) || isset($_SESSION['invalidValues']['invalidRows'])) {
               if (isset($_SESSION['validValues']['validRows'])) {
                   echo $_SESSION['validValues']['validRows'];
               } else {
                   echo $_SESSION['invalidValues']['invalidRows'];
               }
           } ?>" step="1" min="0" pattern="[0-9]" name="machineRows">
    <br> Machine Columns:<br>
    <input type="number" class="<?php if ($_SESSION['invalidValues']['invalidColumnsRed'] ?? false) {
        echo 'incorrect';
    } ?>"
           value="<?php if (isset($_SESSION['validValues']['validColumns']) || isset($_SESSION['invalidValues']['invalidColumns'])) {
               if (isset($_SESSION['validValues']['validColumns'])) {
                   echo $_SESSION['validValues']['validColumns'];
               } else {
                   echo $_SESSION['invalidValues']['invalidColumns'];
               }
           } ?>" step="1" min="0" pattern="[0-9]" name="machineColumns">
    <br>
    Machine Size:<br>
    <input type="number" class="<?php if ($_SESSION['invalidValues']['invalidSizeRed'] ?? false) {
        echo 'incorrect';
    } ?>"
           value="<?php if (isset($_SESSION['validValues']['validSize']) || isset($_SESSION['invalidValues']['invalidSize'])) {
               if (isset($_SESSION['validValues']['validSize'])) {
                   echo $_SESSION['validValues']['validSize'];
               } else {
                   echo $_SESSION['invalidValues']['invalidSize'];
               }
           } ?>" step="1" min="0" pattern="[0-9]" name="machineSize">
    <br>
    <input type="submit" value="Create Machine">
</form>
