<?php
    class Matematika {
        //Konstanta class
        const PHI = 3.14;

        //Static member variabel
        public static $counter = 100;

        //Static member function
        public static function tambahkan($a, $b){
            return $a + $b;
        } 

        //akses member variabel dari dalam class
        public static function naikanCounter(){
            self::$counter++;
        }

        //akses konstanta class
        public static function luaslingkaran($jari){
            return self::PHI * $jari * $jari;
        }
    }
?>