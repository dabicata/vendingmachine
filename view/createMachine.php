<form action="index.php?action=createMachine" method="post">
    <input type="hidden" name="action" value="createMachine">
    Machine Rows:<br>
    <input type="number" step="1" min="1" pattern="[0-9]" name="machineRows">

    <br>
    Machine Columns:<br>
    <input type="number" step="1" min="1" pattern="[0-9]" name="machineColumns">
    <br>
    Machine Size:<br>
    <input type="number" step="1" min="1" pattern="[0-9]" name="machineSize">
    <br>
    <input type="submit" value="Create Machine">
</form>
