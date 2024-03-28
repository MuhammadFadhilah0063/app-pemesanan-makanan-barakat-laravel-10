<?php

use App\Models\OfflineOrder;
use App\Models\OnlineOrder;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

/**
 * format rupiah
 */
function rupiah($value)
{
    if ($value < 0) {
        return 'Rp. ' . number_format(abs($value), 0, ',', '.');
    } else {
        return 'Rp. ' . number_format($value, 0, ',', '.');
    }
}


/**
 * format ribuan
 */
function ribu($value)
{
    return number_format($value, 0, ',', '.');
}

/**
 * create id random
 */
function makeId($prefix, $length = 4)
{
    $random = '';
    for ($i = 0; $i < $length; $i++) {
        $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
    }

    $now = Carbon::now();
    $formattedDateTime = $now->format('dmy');

    // Example OND-200623C7J6
    $id = $prefix . '-' . $formattedDateTime . Str::upper($random);

    return $id;
}

/**
 * create estimation time
 */
function estimationTime($time, $estimation)
{
    $result = Carbon::createFromFormat('H:i', $time);
    $result->addHour($estimation);

    return $result->format('H:i');
}

/**
 * @return string name of month
 */
function indonesianMonth($month)
{
    $indonesianMonth = [
        "01" => "Januari",
        "02" => "Februari",
        "03" => "Maret",
        "04" => "April",
        "05" => "Mei",
        "06" => "Juni",
        "07" => "Juli",
        "08" => "Agustus",
        "09" => "September",
        "10" => "Oktober",
        "11" => "November",
        "12" => "Desember",
    ];

    foreach ($indonesianMonth as $key => $value) {
        if ($key == $month) return $value;
    }
}

function formatTime($time)
{
    $carbonTime = Carbon::createFromFormat('H:i:s', $time);
    $formattedTime = $carbonTime->format('H.i');
    return $formattedTime;
}

function formatDate($date)
{
    Date::setLocale('id');
    $carbonDate = Carbon::createFromFormat('Y-m-d', $date);
    return $carbonDate->translatedFormat('d F Y');
}

function formatDateWithTime($date)
{
    Date::setLocale('id');
    $carbonDate = Carbon::createFromFormat('Y-m-d H:i:s', $date);
    return $carbonDate->translatedFormat('d F Y');
}

function formatDateWithTime2($date)
{
    Date::setLocale('id');
    $carbonDate = Carbon::createFromFormat('Y-m-d H:i:s', $date);
    return $carbonDate->translatedFormat('d F Y H:i:s');
}

function transactionBadges()
{
    // Badge transaksi pending or success
    return [
        'onlineOrderPending' => OnlineOrder::where('status', 'pending')->count(),
        'offlineOrderProcess' => OfflineOrder::where('status', 'process')->count(),
        'onlineReservationPending' => Reservation::where('reservation_id', 'LIKE', 'RSV%')->where('reservation_status', 'pending')->count(),
        'offlineReservationPending' => Reservation::where('reservation_id', 'LIKE', 'ROF%')->where('reservation_status', 'pending')->count(),
    ];
}
