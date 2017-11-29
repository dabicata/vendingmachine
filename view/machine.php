<table id="machinelist" class="display" cellspacing="0" width="100%">
    <tr>
        <th>Machine Id</th>
        <th>Machine Rows</th>
        <th>Machine Columns</th>
        <th>Machine Size</th>
    </tr>
    <?php
    foreach ($machineData as $value): ?>
        <tr>
            <td> <?php echo $value['vendingMachineId']; ?> </td>
            <td> <?php echo $value['vendingMachineRows']; ?> </td>
            <td> <?php echo $value['vendingMachineColumns']; ?> </td>
            <td> <?php echo $value['machineSize']; ?> </td>
            <td><a href="index.php?action=editMachineView&machineId= <?php echo $value['vendingMachineId']; ?>">Edit</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
