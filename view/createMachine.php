<form action="index.php?action=createMachineView" method="post">
    <input type="hidden" name="action" value="createMachine">
    Machine Rows:<br>
    <input type="number" class="<?php if ($array['invalidValues']['invalidRowsRed'] ?? false) {
        echo 'incorrect';
    } ?>"
           value="<?php if (isset($array['validValues']['validRows']) || isset($array['invalidValues']['invalidRows'])) {
               if (isset($array['validValues']['validRows'])) {
                   echo $array['validValues']['validRows'];
               } else {
                   echo $array['invalidValues']['invalidRows'];
               }
           } ?>" step="1" min="0" pattern="[0-9]" name="machineRows">
    <br> Machine Columns:<br>
    <input type="number" class="<?php if ($array['invalidValues']['invalidColumnsRed'] ?? false) {
        echo 'incorrect';
    } ?>"
           value="<?php if (isset($array['validValues']['validColumns']) || isset($array['invalidValues']['invalidColumns'])) {
               if (isset($array['validValues']['validColumns'])) {
                   echo $array['validValues']['validColumns'];
               } else {
                   echo $array['invalidValues']['invalidColumns'];
               }
           } ?>" step="1" min="0" pattern="[0-9]" name="machineColumns">
    <br>
    Machine Size:<br>
    <input type="number" class="<?php if ($array['invalidValues']['invalidSizeRed'] ?? false) {
        echo 'incorrect';
    } ?>"
           value="<?php if (isset($array['validValues']['validSize']) || isset($array['invalidValues']['invalidSize'])) {
               if (isset($array['validValues']['validSize'])) {
                   echo $array['validValues']['validSize'];
               } else {
                   echo $array['invalidValues']['invalidSize'];
               }
           } ?>" step="1" min="0" pattern="[0-9]" name="machineSize">
    <br>
    Machine Name:<br>
    <input type="text" class="<?php if ($array['invalidValues']['invalidNameRed'] ?? false) {
        echo 'incorrect';
    } ?>"
           value="<?php if (isset($array['validValues']['validName']) || isset($array['invalidValues']['invalidName'])) {
               if (isset($array['validValues']['validName'])) {
                   echo $array['validValues']['validName'];
               } else {
                   echo $array['invalidValues']['invalidName'];
               }
           } ?>" name="machineName">
    <br>
    Machine Description:<br>
    <textarea name="machineDesc" class="<?php if ($array['invalidValues']['invalidDescRed'] ?? false) {
        echo 'incorrect';
    } ?>"><?php if (isset($array['validValues']['validDesc']) || isset($array['invalidValues']['invalidDesc'])) {
            if (isset($array['validValues']['validDesc'])) {
                echo $array['validValues']['validDesc'];
            } else {
                echo $array['invalidValues']['invalidDesc'];
            }
        } ?></textarea>
    <br>
    Status: <br>
    <div class="<?php if ($array['invalidValues']['invalidStatusRed'] ?? false) {
        echo 'incorrect';
    } ?>">
        <?php
        foreach ($array['status'] as $value): ?>
            <input type="radio" value="<?php echo $value['statusId'] ?>" <?php
            if (isset($array['validValues']['validStatus'])) {
                if ($value['statusId'] == $array['validValues']['validStatus']) {
                    echo 'checked="checked"';
                }
            }
            ?> name="status"> <?php echo $value['status'] ?>
            <br>
        <?php endforeach; ?>
    </div>
    <br>
    Active Days:<br>
    <div class="<?php if ($array['invalidValues']['invalidDaysRed'] ?? false) {
        echo 'incorrect';
    } ?>">
        <?php
        //        var_dump($array);
        foreach ($array['days'] as $value): ?>
            <input type="checkbox" value="<?php echo $value['dayId'] ?>" <?php
            if (isset($array['validValues']['validDays'])) {
                foreach ($array['validValues']['validDays'] as $validDay) {
                    if ($value['dayId'] == $validDay) {
                        echo 'checked="checked"';
                    }
                }
            }
            ?> name="days[]"> <?php echo $value['days'] ?>
            <br>
        <?php endforeach; ?>
    </div>
    <input type="submit" value="Create Machine">
</form>
<?php var_dump($array['validValues']['validDays']); ?>