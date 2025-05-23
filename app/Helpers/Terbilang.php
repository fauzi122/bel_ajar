<?php

namespace App\Helpers;

class RECTY {
    private static $satuan = [
        '','satu','dua','tiga','empat','lima','enam','tujuh','delapan','sembilan'
    ];

    private static $puluhan = [
        'sepuluh','sebelas','dua belas','tiga belas','empat belas',
        'lima belas','enam belas','tujuh belas','delapan belas','sembilan belas'
    ];

    private static $puluh = [
        '','sepuluh','dua puluh','tiga puluh','empat puluh','lima puluh',
        'enam puluh','tujuh puluh','delapan puluh','sembilan puluh'
    ];

    private static $ribu = [
        '', 'ribu', 'juta', 'miliar', 'triliun', 'kuadriliun', 'kuintiliun',
        'sekstiliun', 'septiliun', 'oktiliun', 'noniliun', 'desiliun'
    ];

    public static function toTerbilang($number) {
        $bilangan = abs($number);
        $str = '';
        if ($bilangan < 10) {
            $str = self::$satuan[$bilangan];
        } elseif ($bilangan < 20) {
            $str = self::$puluhan[$bilangan - 10];
        } elseif ($bilangan < 100) {
            $str = self::$puluh[floor($bilangan / 10)] . ' ' . self::toTerbilang($bilangan % 10);
        } elseif ($bilangan < 1000) {
            $str = self::toTerbilang(floor($bilangan / 100)) . ' ratus ' . self::toTerbilang($bilangan % 100);
        } else {
            $i = 0;
            while ($bilangan >= pow(1000, $i+1) && $i < count(self::$ribu)-1) {
                $i++;
            }
            $sementara = floor($bilangan / pow(1000, $i));
            $str = self::toTerbilang($sementara) . ' ' . self::$ribu[$i] . ' ' . self::toTerbilang($bilangan % pow(1000, $i));
        }

        if ($number < 0) {
            $str = 'minus ' . $str;
        }

        return ucfirst(trim($str));
    }
}
