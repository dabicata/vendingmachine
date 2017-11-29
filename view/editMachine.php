<form action="index.php?action=editMachine" method="post">
    <input type="hidden" name="action" value="editMachine">
    Machine Rows:<br>
    <input type="number" step="1" min="0" value="<?php echo $machineData['vendingMachineRows']; ?>"
           name="machineRows">
    <br>
    Machine Columns:<br>
    <input type="number" step="1" min="0" value="<?php echo $machineData['vendingMachineColumns']; ?>"
           name="machineColumns">
    <br>
    Machine Size:<br>
    <input type="number" step="1" min="0" value="<?php echo $machineData['machineSize']; ?>" name="machineSize">
    <br>
    <input type="hidden" value="<?php echo $machineData['vendingMachineId']; ?>" name="vendingMachineId">
    <input type="submit" value="Save">
</form>
