<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Setting;
use DB;

class CommonController extends Controller
{
    public static function getCoiNumber()
    {
        // $coi_number = DB::table('transactions')->max('coi_number');
        $terminal_coi_number = Transaction::max('terminal_coi_number');
        return substr('0000000'.(intval($terminal_coi_number) + 1), -7);
    }

    public static function getTransactionType($type)
    {
        switch($type) {
            case 'A':   return 'Family Protect - Plus'; break;
            case 'AO':  return 'KP Protect';            break;
            case 'B':   return 'Pinoy Protect - Plus';  break;
            case 'D':   return 'Family Protect';        break;
            case 'R':   return "Pawner's Protect";      break;
            case 'M':   return "Mediphone";             break;
            case 'BF':  return "Pinoy Protect Five";    break;
            case 'DT':  return "Family Protect Ten";    break;
            case "C":   return "Customer Protect";      break;
        }
    }

    public static function getTransactionTypeCode($type)
    {
        switch($type) {
            case 'Family Protect - Plus': return 'A';  break;
            case 'KP Protect':            return 'AO'; break;
            case 'Pinoy Protect - Plus':  return 'B';  break;
            case 'Family Protect':        return 'D';  break;
            case "Pawner's Protect":      return 'R';  break;
            case "Mediphone":             return 'M';  break;
            case "Pinoy Protect Five":    return 'BF'; break;
            case "Family Protect Ten":    return 'DT'; break;
            case "Customer Protect":      return 'C';  break;
        }
    }

    public static function fixUnpostedTransactions($date_from, $date_to)
    {
        // DB::enableQueryLog();

        Transaction::where(function($query) {
                $query->whereNull('posted')
                    ->orWhere('posted', false);
            })
            ->whereBetween('date_issued', [$date_from, $date_to])
            ->where('date_issued', '<', DB::raw('CURDATE()'))
            ->where('status', '!=', 'deleted')
            ->update(['status' => 'deleted']);
        
        // dd(DB::getQueryLog(), $date_from, $date_to);
    }

    public static function curl($domain, $type = 'GET', $body = array(), $header = array())
    {
        $type = strtoupper($type);

        if($type == 'GET') {
            $curl = curl_init($domain.'?'.http_build_query($body));
            if(count($header))
                curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $type);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        } elseif($type == 'PUT') {
            $curl = curl_init($domain);
            if(count($header))
                curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $type);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        } elseif($type == 'PATCH') {
            $curl = curl_init($domain);
            if(count($header))
                curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_URL, $domain);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $type);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
        } elseif($type == 'JSON') { /* JSON */
            $curl = curl_init($domain);
            curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Accept: application/json']);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        } else { /* POST */
            $curl = curl_init($domain);
            if(count($header))
                curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            // curl_setopt($curl, CURLOPT_HEADER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        $error = curl_error($curl);
        $curl_info = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if($curl_info == 200) {
            if($result === FALSE) $data = json_decode($error);
            else $data = json_decode($result);
        } else $data = json_decode($curl_info);

        curl_close($curl);
        return $data;
    }

    public static function getTerminalSignature()
    {
        $terminal_signature = Setting::where('name', 'terminal_signature')->first();
        return $terminal_signature->value;
    }
}
