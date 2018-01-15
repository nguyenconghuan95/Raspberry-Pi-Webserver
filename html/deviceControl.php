<?php
    class deviceControl {
        public function sw($conn, $device, $state) {
            if (($this -> is_same_state($conn, $device, $state)) == 0) {
                $sql = "UPDATE led SET STATUS='".$state."' WHERE LED='".$device."'";
                mysqli_query($conn, $sql);
                $sql = "UPDATE led SET CHANGED=1 WHERE LED='".$device."'";
                mysqli_query($conn, $sql);
            }
        }

        private function is_same_state($conn, $device, $state) {
            $sql = "SELECT STATUS FROM led WHERE LED='".$device."'";
            $result = mysqli_query($conn, $sql);
            $status = mysqli_fetch_array($result);

            if ($status[0] == $state) {
                return 1;
            }
            else
                return 0;
        }

        public function handleLimit($conn, $zone) {
            $sql = "SELECT * FROM limitIndex WHERE Zone=".$zone;
            $result = mysqli_query($conn, $sql);
            while ($parameter = mysqli_fetch_assoc($result)) {   
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
                    echo "jump to this";
                    $this -> sw($conn, "light".$zone, "Off");
                }
            }
        }
    }
?>