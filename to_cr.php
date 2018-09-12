Preconditions:

<?php
class db{
    public static function init();
    public function __construct($config);
    public function query($sql, $args );
}

class DeviceController {
    public function getParam($name);
}

?>


Code to CR:

<?php

class DeviceController extends ControllerAction
{
    //akcja ajaksowa
    public function updateDeviceNameAction()
    {
        $deviceId = $_GET['device_id'];
        $deviceName = $_GET['device_name'];

        $db = db::init();
        $db->query("UPDATE `device` set `name` = " . $deviceName . " WHERE device_id  = ".$deviceId);

    }

    public function viewDeviceAction()
    {
        $view = new View();
        ...
        $device = DeviceModel::get($_GET['device_id']);
        $view->assign("device", $device);
        ...
        echo $view->render(“device.php”);
    }

...
}
?>

views/device.php
...
<div>
<img class=”device” scr=”<?php echo $view->device->device_photo_url; ?>” />
<span class=”device_name”><?php echo $view->device->name ?></span>
</div>
...

<?php

class DeviceModel
{
    public static $devices = [];

    public static function update($device_photo_id, $device_name, $devId)
    {
        $db = new db([
            'host' => 'localhost',
            'user' => 'root'
            'password' => 'ania7',
            ...
        ]);
        $db->query("UPDATE `device` set `name` = {$device_name} WHERE device_id  = $devId");

        $device = $this->searchDevcieByName($device_name);
        $device_id = 0;

        foreach($device as $d){
            $device_id = $d->device_id;
        }

        self::$devices[$device_id] = $device;

        return true;

    }

    public static function searchDevcieByName($name)
    {
        $db = new db([
        'host' => 'localhost',
        'user' => 'root'
        'password' => 'ania7',
        ...
        ]);
        $s = $db->query("SELECT device_id, device_name,  FROM devcie
            WHERE device_name LIKE '%{$name}%'");

        return $s->fetchAll();
    }
...
}