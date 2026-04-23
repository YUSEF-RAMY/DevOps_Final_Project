<?php

namespace App\Support;

use Carbon\Carbon;

class DateHelper
{
    /**
     * Format date in standard format: "12 Feb 2025, 10:00 PM"
     * 
     * @param mixed $date Carbon instance, DateTime, or date string
     * @return string
     */
    public static function format($date): string
    {
        if (empty($date)) {
            return '';
        }

        if ($date instanceof Carbon) {
            return $date->format('d M Y, h:i A');
        }

        try {
            return Carbon::parse($date)->format('d M Y, h:i A');
        } catch (\Exception $e) {
            return '';
        }
    }

    /**
     * Format date without time: "12 Feb 2025"
     * 
     * @param mixed $date Carbon instance, DateTime, or date string
     * @return string
     */
    public static function formatDate($date): string
    {
        if (empty($date)) {
            return '';
        }

        if ($date instanceof Carbon) {
            return $date->format('d M Y');
        }

        try {
            return Carbon::parse($date)->format('d M Y');
        } catch (\Exception $e) {
            return '';
        }
    }

    /**
     * Format time only: "10:00 PM"
     * 
     * @param mixed $date Carbon instance, DateTime, or date string
     * @return string
     */
    public static function formatTime($date): string
    {
        if (empty($date)) {
            return '';
        }

        if ($date instanceof Carbon) {
            return $date->format('h:i A');
        }

        try {
            return Carbon::parse($date)->format('h:i A');
        } catch (\Exception $e) {
            return '';
        }
    }
}

