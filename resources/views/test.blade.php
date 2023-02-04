

{{-- @foreach ($seles as $dt)
    <p style="text-align: center;">{{$dt->seles_type}}</p>
@endforeach --}}
<?php
use Illuminate\Support\Facades\DB;
$amount = 2316532166454;
$numberWord = numberToWord($amount).' only';
//echo $numberWord;

 function numberToWord($amount){
    $word = "";
    if((int)($amount / 1000000000000) > 0){
        $word .= ' '.numberToWord((int)($amount / 1000000000000));
        $word .= ' Trillion  ';
        $amount = (int)($amount % 1000000000000);
    }
    if((int)($amount / 1000000000) > 0){
        $word .= ' '.numberToWord((int)($amount / 1000000000));
        $word .= ' Billion ';
        $amount = (int)($amount % 1000000000);
    }
    if((int)($amount / 1000000) > 0){
        $word .= ' '.numberToWord((int)($amount / 1000000));
        $word .= ' Million';
        $amount = (int)($amount % 1000000);
    }
    if((int)($amount / 1000) > 0){
        $word .= ' '.numberToWord((int)($amount / 1000));
        $word .= ' Thousand';
        $amount = (int)($amount % 1000);
    }
    if((int)($amount / 100) > 0){
        $word .= ' '.numberToWord((int)($amount / 100));
        $word .= ' Hundred ';
        $amount = (int)($amount % 100);
        if($amount > 0) $word .= ' And';
    }
    if((int)($amount / 10) > 0){
        if((int)($amount / 10) >1){
            $word .= ' '.gtDigitWordOnPositionTwo((int)($amount / 10));
            $word .= ' '.numberToWord((int)($amount % 10));
        }
        else{
            $word .= ' '.getWordForNumberOnTenToNineteen($amount);
        }
        $amount = 0;
    }
    if($amount > 0){
        $word .= ' '.gtDigitWord($amount);
    }
    return $word;
}

function getWordForNumberOnTenToNineteen($number){
    if($number == 10) return 'Ten';
    if($number == 11) return 'Eleven';
    if($number == 12) return 'Twelve';
    if($number == 13) return 'Thirteen';
    if($number == 14) return 'Fourteen';
    if($number == 15) return 'Fifteen';
    if($number == 16) return 'Sixteen';
    if($number == 17) return 'Seventeen';
    if($number == 18) return 'Eighteen';
    if($number == 19) return 'Ninteen';
}

function gtDigitWordOnPositionTwo($digit){
    if($digit == 2) return 'Twenty';
    if($digit == 3) return 'Thirty';
    if($digit == 4) return 'Forty';
    if($digit == 5) return 'Fifty';
    if($digit == 6) return 'Sixty';
    if($digit == 7) return 'Seventy';
    if($digit == 8) return 'Eighty';
    if($digit == 9) return 'Ninety';
}

function gtDigitWord($digit){
    if($digit == 1) return 'One';
    if($digit == 2) return 'Two';
    if($digit == 3) return 'Three';
    if($digit == 4) return 'Four';
    if($digit == 5) return 'Five';
    if($digit == 6) return 'Six';
    if($digit == 7) return 'Seven';
    if($digit == 8) return 'Eight';
    if($digit == 9) return 'Nine';
}
echo '<br>';
$qr = 'name'.','.'id';
ck($qr);

function ck($data = null){
//   $data = "'name','email'";
//     $usr = DB::table('users')->select($data)->get();
//     echo '<pre>';
//         print_r($usr);
}

?>
