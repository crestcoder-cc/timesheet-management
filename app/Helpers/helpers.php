<?php

use App\Models\AgentCreditHistory;
use App\Models\UserAgent;
use Carbon\Carbon;

if (!function_exists('dateFormat')) {
    function dateFormat($date, $with_time = false)
    {
        if ($with_time) {
            return date('m/d/Y h:i A', strtotime($date));
        }
        return date('m/d/Y', strtotime($date));
    }
}
if (!function_exists('humanTime')) {
    function humanTime($time)
    {
        $carbonDate = Carbon::parse($time);
        $isToday = $carbonDate->isToday();
        $isYesterday = $carbonDate->isYesterday();
        if ($isToday) {
            return $carbonDate->format('h:i');
        } elseif ($isYesterday) {
            return 'Yesterday';
        } else {
            return $carbonDate->format('m/d/Y');
        }
    }
}
if (!function_exists('numberToWord')) {
    function numberToWord($num)
    {
        $num = ( string )(( int )$num);

        if (( int )($num) && ctype_digit($num)) {
            $words = array();

            $num = str_replace(array(',', ' '), '', trim($num));

            $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven',
                'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen',
                'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen');

            $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty',
                'seventy', 'eighty', 'ninety', 'hundred');

            $list3 = array('', 'thousand', 'million', 'billion', 'trillion',
                'quadrillion', 'quintillion', 'sextillion', 'septillion',
                'octillion', 'nonillion', 'decillion', 'undecillion',
                'duodecillion', 'tredecillion', 'quattuordecillion',
                'quindecillion', 'sexdecillion', 'septendecillion',
                'octodecillion', 'novemdecillion', 'vigintillion');

            $num_length = strlen($num);
            $levels = ( int )(($num_length + 2) / 3);
            $max_length = $levels * 3;
            $num = substr('00' . $num, -$max_length);
            $num_levels = str_split($num, 3);

            foreach ($num_levels as $num_part) {
                $levels--;
                $hundreds = ( int )($num_part / 100);
                $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ' ' : '');
                $tens = ( int )($num_part % 100);
                $singles = '';

                if ($tens < 20) {
                    $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '');
                } else {
                    $tens = ( int )($tens / 10);
                    $tens = ' ' . $list2[$tens] . ' ';
                    $singles = ( int )($num_part % 10);
                    $singles = ' ' . $list1[$singles] . ' ';
                }
                $words[] = $hundreds . $tens . $singles . (($levels && ( int )($num_part)) ? ' ' . $list3[$levels] . ' ' : '');
            }
            $commas = count($words);
            if ($commas > 1) {
                $commas = $commas - 1;
            }

            $words = implode(', ', $words);

            $words = trim(str_replace(' ,', ',', ucwords($words)), ', ');
            if ($commas) {
                $words = str_replace(',', ' and', $words);
            }

            return $words;
        }

        if (!(( int )$num)) {
            return 'Zero';
        }
        return '';
    }
}
if (!function_exists('updateAgentCredit')) {
    function updateAgentCredit($agent_id)
    {
        $user_agents = UserAgent::where('id', $agent_id)->first();
        $credit = AgentCreditHistory::where('agent_id', $user_agents->id)->where('type', 'credit')->sum('amount');
        $debit = AgentCreditHistory::where('agent_id', $user_agents->id)->where('type', 'debit')->sum('amount');
        $balance = $credit - $debit;
        $user_agents->agent_credit = $balance;
        $user_agents->save();
        return $balance;
    }
}

