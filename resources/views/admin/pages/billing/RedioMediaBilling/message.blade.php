@php
//print_r($ary61);  
$html=[];
if(@$RO_id->Slot61 < count($ary61))
{
  $ttime=substr(@$RO_id->Slot61-count($ary61),1,15);
  $html[].= "Please remove $ttime time sloat between (7AM-9AM).<br>";
}
else if(@$RO_id->Slot61 > count($ary61))
{
  $ttime=substr(@$RO_id->Slot61-count($ary61),0,15);
  $html[].= "Please add $ttime time sloat between (7AM-9AM) <br>";
}

//print_r($ary63);  
if(@$RO_id->Slot62 < count($ary62))
{
  $ttime=substr(@$RO_id->Slot62-count($ary62),1,15);
  $html[].= "Please remove $ttime extra time sloat between (9AM-12PM)<br>";
}
else if(@$RO_id->Slot62 > count($ary62))
{
  $ttime=substr(@$RO_id->Slot62-count($ary62),0,15);
  $html[].= "Please add $ttime time sloat between (9AM-12PM).<br>";
}
//for sloat 63 
if(@$RO_id->Slot63 < count($ary63))
{
  $ttime=substr(@$RO_id->Slot63-count($ary63),1,15);
  $html[].= "Please remove $ttime time sloat between (12PM-07PM).<br>";
}
else if(@$RO_id->Slot63 > count($ary63))
{
  $ttime=substr(@$RO_id->Slot63-count($ary63),0,15);
  $html[].= "Please add $ttime time sloat between (12PM-07PM).<br>";
}

//for sloat 64
if(@$RO_id->Slot64 < count($ary64))
{
  $ttime=substr(@$RO_id->Slot64-count($ary64),1,15);
  $html[].= "Please remove $ttime time sloat between (07 PM-08 PM).<br>";
}
else if(@$RO_id->Slot64 > count($ary64))
{
  $ttime=substr(@$RO_id->Slot64-count($ary64),0,15);
  $html[].= "Please add $ttime time sloat between (07 PM-08 PM).<br>";
}

//for sloat 65
if(@$RO_id->Slot65 < count($ary65))
{
  $ttime=substr(@$RO_id->Slot65-count($ary65),1,15);
  $html[].= "Please remove $ttime time sloat between (8PM-10PM).<br>";
}
else if(@$RO_id->Slot65 > count($ary65))
{
  $ttime=substr(@$RO_id->Slot65-count($ary65),0,15);
  $html[].= "Please add $ttime time sloat between (8PM-10PM).<br>";
}

//for sloat 66
if(@$RO_id->Slot66 < count($ary66))
{
  $ttime=substr(@$RO_id->Slot66-count($ary66),1,15);
  $html[].= "Please remove extra time sloat between (10PM-11PM).<br>";
}
else if(@$RO_id->Slot66 > count($ary66))
{
  $ttime=substr(@$RO_id->Slot66-count($ary66),0,15);
  $html[].= "Please add $ttime time sloat between (10PM-11PM).<br>";
}

//for sloat 31
if(@$RO_id->Slot31 < count($ary31))
{
  $html[].= "Please remove extra time sloat between (6AM-12AM)<br>";
}
else if(@$RO_id->Slot31 > count($ary31))
{
  $html[].= "Please add more time sloat between (6AM-12AM)<br>";
}

//for sloat 32
if(@$RO_id->Slot32 < count($ary32))
{
  $html[].= "Please remove extra time sloat between (12PM-5PM)<br>";
}
else if(@$RO_id->Slot32 > count($ary32))
{
  $html[].= "Please add more time sloat between (12PM-5PM)<br>";
}

//for sloat 33
if(@$RO_id->Slot33 < count($ary33))
{
  $html[].= "Please remove extra time sloat between (05PM-11PM)<br>";
}
else if(@$RO_id->Slot33 > count($ary33))
{
  $html[].= "Please add more time sloat between (05PM-11PM)<br>";
}



if(count($html) > 0)
{
  foreach($html as $key => $value)
  {
    echo "<span style='color: red;'>".$value."</span>";
  }

}

@endphp