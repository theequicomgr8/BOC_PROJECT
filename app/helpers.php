<?php
function convertNumberword($number){
    $no = floor($number);
    $point = round($number - $no, 2) * 100;
    $hundred = null;
    $digits_1 = strlen($no);
    $i = 0;
    $str = array();
    $words = array('0' => '', '1' => 'One', '2' => 'Two',
     '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
     '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
     '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
     '13' => 'Thirteen', '14' => 'Fourteen',
     '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
     '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
     '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
     '60' => 'Sixty', '70' => 'Seventy',
     '80' => 'Eighty', '90' => 'Ninety');
    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
    while ($i < $digits_1) {
      $divider = ($i == 2) ? 10 : 100;
      $number = floor($no % $divider);
      $no = floor($no / $divider);
      $i += ($divider == 10) ? 1 : 2;
      if ($number) {
         $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
         $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
         $str [] = ($number < 21) ? $words[$number] .
             " " . @$digits[$counter] . $plural . " " . $hundred
             :
             $words[floor($number / 10) * 10]
             . " " . $words[$number % 10] . " "
             .@$digits[$counter] . $plural . " " . $hundred;
      } else $str[] = null;
   }
   $str = array_reverse($str);
   $result = implode('', $str);
   $points = ($point) ?
     "." . $words[$point / 10] . " " . 
           $words[$point = $point % 10] : '';
   return $result . "Rupees  " . $points;
 }
 
 //Convert Indian formats
 function moneyFormatIndiainnumber($num){
 $explrestunits = "" ;
 $num = preg_replace('/,+/', '', $num);
 $words = explode(".", $num);
 $des = "00";
 if(count($words)<=2){
     $num=$words[0];
     if(count($words)>=2){$des=$words[1];}
     if(strlen($des)<2){$des="$des";}else{$des=substr($des,0,2);}
 }
 if(strlen($num)>3){
     $lastthree = substr($num, strlen($num)-3, strlen($num));
     $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
     $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
     $expunit = str_split($restunits, 2);
     for($i=0; $i<sizeof($expunit); $i++){
         // creates each of the 2's group and adds a comma to the end
         if($i==0)
         {
             $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
         }else{
             $explrestunits .= $expunit[$i].",";
         }
     }
     $thecash = $explrestunits.$lastthree;
 } else {
     $thecash = $num;
 }
 return "$thecash"; // writes the final format where $currency is the currency symbol.
 
 }
 ?>