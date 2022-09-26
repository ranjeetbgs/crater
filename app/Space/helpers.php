<?php

use Crater\Models\CompanySetting;
use Crater\Models\Currency;
use Crater\Models\CustomField;
use Crater\Models\Setting;
use Illuminate\Support\Str;
use Carbon\Carbon;

/**
 * Get company setting
 *
 * @param $company_id
 * @return string
 */
function get_company_setting($key, $company_id)
{
    if (\Storage::disk('local')->has('database_created')) {
        return CompanySetting::getSetting($key, $company_id);
    }
}

/**
 * Get app setting
 *
 * @param $company_id
 * @return string
 */
function get_app_setting($key)
{
    if (\Storage::disk('local')->has('database_created')) {
        return Setting::getSetting($key);
    }
}

/**
 * Get page title
 *
 * @param $company_id
 * @return string
 */
function get_page_title($company_id)
{
    $routeName = Route::currentRouteName();

    $pageTitle = null;
    $defaultPageTitle = 'Crater - Self Hosted Invoicing Platform';

    if (\Storage::disk('local')->has('database_created')) {
        if ($routeName === 'customer.dashboard') {
            $pageTitle = CompanySetting::getSetting('customer_portal_page_title', $company_id);

            return $pageTitle ? $pageTitle : $defaultPageTitle;
        }

        $pageTitle = Setting::getSetting('admin_page_title');

        return $pageTitle ? $pageTitle : $defaultPageTitle;
    }
}

/**
 * Set Active Path
 *
 * @param $path
 * @param string $active
 * @return string
 */
function set_active($path, $active = 'active')
{
    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

/**
 * @param $path
 * @return mixed
 */
function is_url($path)
{
    return call_user_func_array('Request::is', (array)$path);
}

/**
 * @param string $type
 * @return string
 */
function getCustomFieldValueKey(string $type)
{
    switch ($type) {
        case 'Input':
            return 'string_answer';

        case 'TextArea':
            return 'string_answer';

        case 'Phone':
            return 'number_answer';

        case 'Url':
            return 'string_answer';

        case 'Number':
            return 'number_answer';

        case 'Dropdown':
            return 'string_answer';

        case 'Switch':
            return 'boolean_answer';

        case 'Date':
            return 'date_answer';

        case 'Time':
            return 'time_answer';

        case 'DateTime':
            return 'date_time_answer';

        default:
            return 'string_answer';
    }
}

/**
 * @param $money
 * @return formated_money
 */
function format_money_pdf($money, $currency = null)
{
    $money = $money / 100;

    if (! $currency) {
        $currency = Currency::findOrFail(CompanySetting::getSetting('currency', 1));
    }

    $format_money = number_format(
        $money,
        $currency->precision,
        $currency->decimal_separator,
        $currency->thousand_separator
    );

    $currency_with_symbol = '';
    if ($currency->swap_currency_symbol) {
        $currency_with_symbol = $format_money.'<span style="font-family: DejaVu Sans;">'.$currency->symbol.'</span>';
    } else {
        $currency_with_symbol = '<span style="font-family: DejaVu Sans;">'.$currency->symbol.'</span>'.$format_money;
    }

    return $currency_with_symbol;
}

/**
 * @param $string
 * @return string
 */
function clean_slug($model, $title, $id = 0)
{
    // Normalize the title
    $slug = Str::upper('CUSTOM_'.$model.'_'.Str::slug($title, '_'));

    // Get any that could possibly be related.
    // This cuts the queries down by doing it once.
    $allSlugs = getRelatedSlugs($model, $slug, $id);

    // If we haven't used it before then we are all good.
    if (! $allSlugs->contains('slug', $slug)) {
        return $slug;
    }

    // Just append numbers like a savage until we find not used.
    for ($i = 1; $i <= 10; $i++) {
        $newSlug = $slug.'_'.$i;
        if (! $allSlugs->contains('slug', $newSlug)) {
            return $newSlug;
        }
    }

    throw new \Exception('Can not create a unique slug');
}

function getRelatedSlugs($type, $slug, $id = 0)
{
    return CustomField::select('slug')->where('slug', 'like', $slug.'%')
        ->where('model_type', $type)
        ->where('id', '<>', $id)
        ->get();
}

function respondJson($error, $message)
{
    return response()->json([
        'error' => $error,
        'message' => $message
    ], 422);
}

function formatDate($company_id, $date)
{   
    if(!$date) return null;
    $dateFormat = CompanySetting::getSetting('carbon_date_format', $company_id);

    return Carbon::parse($date)->format($dateFormat);
}

function hasTransportOption($company_id)
{   
    return CompanySetting::getSetting('has_transport_option', $company_id) == 'YES';
}

function getStateCode($state)
{
    $x = array_search($state, array_column(config('crater.states'), 'name') );
    return config('crater.states')[$x]['code'];
}

function amountInWords(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($rupees ? 'Rupees '.$rupees . ' Only' : ''); // . $paise;
}

function amountInWordsUSD($num){ 
    $decones = array( 
                '01' => "One", 
                '02' => "Two", 
                '03' => "Three", 
                '04' => "Four", 
                '05' => "Five", 
                '06' => "Six", 
                '07' => "Seven", 
                '08' => "Eight", 
                '09' => "Nine", 
                10 => "Ten", 
                11 => "Eleven", 
                12 => "Twelve", 
                13 => "Thirteen", 
                14 => "Fourteen", 
                15 => "Fifteen", 
                16 => "Sixteen", 
                17 => "Seventeen", 
                18 => "Eighteen", 
                19 => "Nineteen" 
                );
    $ones = array( 
                0 => " ",
                1 => "One",     
                2 => "Two", 
                3 => "Three", 
                4 => "Four", 
                5 => "Five", 
                6 => "Six", 
                7 => "Seven", 
                8 => "Eight", 
                9 => "Nine", 
                10 => "Ten", 
                11 => "Eleven", 
                12 => "Twelve", 
                13 => "Thirteen", 
                14 => "Fourteen", 
                15 => "Fifteen", 
                16 => "Sixteen", 
                17 => "Seventeen", 
                18 => "Eighteen", 
                19 => "Nineteen" 
                ); 
    $tens = array( 
                0 => "",
                2 => "Twenty", 
                3 => "Thirty", 
                4 => "Forty", 
                5 => "Fifty", 
                6 => "Sixty", 
                7 => "Seventy", 
                8 => "Eighty", 
                9 => "Ninety" 
                ); 
    $hundreds = array( 
                "Hundred", 
                "Thousand", 
                "Million", 
                "Billion", 
                "Trillion", 
                "Quadrillion" 
                ); //limit t quadrillion 
    $num = number_format($num,2,".",","); 
     //return $num;
    $num_arr = explode(".",$num); 
    // return $num_arr[0];
    $wholenum = $num_arr[0]; 
    $decnum = $num_arr[1]; 
    $whole_arr = array_reverse(explode(",",$wholenum)); 
    krsort($whole_arr); 
    $rettxt = ""; 
    foreach($whole_arr as $key => $i){ 
        if($i < 20){ 
            $rettxt .= @$ones[$i]; 
        }
        elseif($i < 100){ 
            $rettxt .= $tens[substr($i,0,1)]; 
            $rettxt .= " ".$ones[substr($i,1,1)]; 
        }
        else{ 
            $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
            $rettxt .= " ".$tens[substr($i,1,1)]; 
            $rettxt .= " ".$ones[substr($i,2,1)]; 
        } 
        if($key > 0){ 
            $rettxt .= " ".$hundreds[$key]." "; 
        } 
    
    } 
    $rettxt = $rettxt." Dirhams";

    // return $decnum;
    
    if($decnum > 0){ 
        $rettxt .= " and "; 
        if($decnum < 20){ 
            $rettxt .= $decones[$decnum]; 
        }
        elseif($decnum < 100){ 
            $rettxt .= $tens[substr($decnum,0,1)]; 
            $rettxt .= " ".$ones[substr($decnum,1,1)]; 
        }
        $rettxt = $rettxt." Fils"; 
    } 
    return $rettxt;
} 
