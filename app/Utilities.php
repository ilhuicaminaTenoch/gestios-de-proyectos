<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utilities extends Model
{
    public function decodeVars(string $variables)
    {
        $data = base64_decode($variables);
        $parametros = explode('&', $data);
        foreach ($parametros as $llave => $parametro) {
            $separaVariables = explode('=', $parametro);
            $nuevoArray[$separaVariables[0]] = $separaVariables[1];
        }
        return $nuevoArray;
    }


    /**
     * @param        $date_1
     * @param        $date_2
     * @param string $differenceFormat
     *
     * PARA: Date Should In YYYY-MM-DD Format
     * RESULT FORMAT:
     * '%y Year %m Month %d Day %h Hours %i Minute %s Seconds'  =>  1 Year 3 Month 14 Day 11 Hours 49 Minute 36 Seconds
     * '%y Year %m Month %d Day' =>  1 Year 3 Month 14 Days
     *  '%m Month %d Day'                                            =>  3 Month 14 Day
     *                                '%d Day %h Hours'                                            =>  14 Day 11 Hours
     *                                '%d Day'                                                        =>  14 Days
     *                                %h Hours %i Minute %s Seconds'                                =>  11 Hours 49
     *                                Minute 36 SECONDS
     *                                '%i Minute %s Seconds'                                        =>  49 Minute 36
     *                                Seconds
     *                                '%h Hours                                                    =>  11 Hours
     *                                '%a Days                                                        =>  468 Days
     *
     *
     *
     *
     * @return string
     */
    public function dateDifference($date_1, $date_2, $differenceFormat = '%a')
    {
        //$timeZone = 'America/Mexico city';
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);

        $interval = date_diff($datetime1, $datetime2);

        return $interval->format($differenceFormat);

    }

}
