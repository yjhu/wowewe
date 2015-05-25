<?php

namespace app\models\utils;

class OfficeCampaignUtils {

//    const CAMPAIGN_ENDDATE = 30;

    public static function getOfficeCampaignBeginDate($date = null) {
        $end_date = self::getOfficeCampaignEndDate($date);
        $start_date = clone($end_date);
        $start_date->sub(date_interval_create_from_date_string('1 month'));

        return $start_date;
    }

    public static function getOfficeCampaignEndDate($date = null) {
        if ($date == null)
            $timestamp = time();
        else
            $timestamp = strtotime($date);
//
//        $year = date('Y', $timestamp);
//        $month = date('m', $timestamp);
//        $day = date('d', $timestamp);
//        if ($day > self::CAMPAIGN_ENDDATE) {
//            $month = $month + 1;
//            if ($month > 12) {
//                $year = $year + 1;
//                $month = 1;
//            }
//        }
//
//        $end_time = sprintf("%04d-%02d-%02d 23:59:59", $year, $month, self::CAMPAIGN_ENDDATE);
        
        $end_date = \DateTime::createFromFormat("Y-m-d H:i:s", \app\models\U::getLastDate(date('Y', $timestamp), date('m', $timestamp)));
        return $end_date;
    }

}
