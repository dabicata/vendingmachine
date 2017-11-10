<?php


namespace vending;

include_once __DIR__ . '/VendingMachine.php';

class CreateMachine
{
    public function generateMachine()
    {
        if (($_POST['machineRows'] > 0) && ($_POST['machineColumns'] > 0) && ($_POST['machineSize'] > 0)) {
            $machine = new VendingMachine();
            $machine->createMachine($_POST['machineRows'], $_POST['machineColumns'], $_POST['machineSize']);
        }
    }

}