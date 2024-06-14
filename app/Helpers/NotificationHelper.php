<?php

namespace App\Helpers;

class NotificationHelper
{
    public static function sendNotification($array): string
    {
        $fields = [];

        $path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';

        if (count($array['ios_array']) > 0) {
            $fields = [
                'registration_ids' => $array['ios_array'],
                'notification' =>
                    [
                        'mutable-content' => true,
                        'vibrate' => "1",
                        'sound' => "mySound",
                        'badge' => 1,
                        "priority" => "high",
                        'title' => $array['title'],
                        'body' => $array['body'],
                        'trip_id' => $array['trip_id'] ?? null,
                    ],
                'data' =>
                    [
                        'trip_id' => $array['trip_id'] ?? null,
                        'content' => ""
                    ],
            ];
        }
        if (count($array['android_array']) > 0) {
            $fields = [
                'registration_ids' => $array['android_array'],
                'priority' => 'high',
                'title' => $array['title'],
                'body' => $array['body'],
                'trip_id' => $array['trip_id'] ?? null,
                'data' => [
                    'message' => $array['body'],
                    'body' => $array['body'],
                    'trip_id' => $array['trip_id'] ?? null,
                ],
            ];
        }
        if (count($fields) > 0) {
            $headers = [
                'Authorization:key=' . env('FCM_KEY'),
                'Content-Type:application/json',
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            curl_close($ch);
            \Log::info($array);
            \Log::info($result);
        }
        return true;
    }
}