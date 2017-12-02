<?php
    class deviceControl {
        public function sw($conn, $device, $state) {
            $sql = "UPDATE led SET STATUS='".$state."' WHERE LED='".$device."'";
            mysqli_query($conn, $sql);
            $sql = "UPDATE led SET CHANGED=1 WHERE LED='".$device."'";
            mysqli_query($conn, $sql);
        }

        public function handleLimit($conn, $zone) {
            $sql = "SELECT * FROM limitIndex WHERE Zone=".$zone;
            $result = mysqli_query($conn, $sql);
            while ($parameter = mysqli_fetch_assoc($result)) {    
                if ($_GET["temp"] > $parameter["LimitTemp"]) 
                    $this -> sw($conn, "hose".$zone, "On");
                else 
                    $this -> sw($conn, "hose".$zone, "Off");
                if ($_GET["humid"] < $parameter["LimitHumid"])
                    $this -> sw($conn, "hose".$zone, "On");
                else
                    $this -> sw($conn, "hose".$zone, "Off");
                if ($_GET["lux"] > $parameter["LimitLuxHigh"]) {
                    $this -> sw($conn, "sunshade".$zone, "On");
                }
                else {
                    $this -> sw($conn, "sunshade".$zone, "Off");
                }
                if ($_GET["lux"] < $parameter["LimitLuxLow"]) {
                    $this -> sw($conn, "light".$zone, "On");
                }
                else {
                    $this -> sw($conn, "light".$zone, "Off");
                }
            }
        }
    }
?>