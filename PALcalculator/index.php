
<!DOCTYPE html>
<html>
 <head>
	<title>Lietuvos Respublikos valstybinis patent??uras</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">		
 </head>
 
<script type="text/javascript">
var month = [31, 29, 31,30,31,30,31,31,30,31,30,31];

function my20plusYear(){
document.getElementById('cy').value=parseInt(document.getElementById('ay').value)+20;
}
function myMonth(){
document.getElementById('cm').value=document.getElementById('am').value;
}
function myDay(){
document.getElementById('cd').value=document.getElementById('ad').value;
}
function fillFields(ay,am,ad,by,bm,bd,cy,cm,cd,pnr){

document.getElementById('ay').value=ay;
document.getElementById('am').value=am;
document.getElementById('ad').value=ad;

document.getElementById('by').value=by;
document.getElementById('bm').value=bm;
document.getElementById('bd').value=bd;

document.getElementById('cy').value=cy;
document.getElementById('cm').value=cm;
document.getElementById('cd').value=cd;
document.getElementById('Pnr').value=pnr;
}

function setMonthDay(str){
document.getElementById(str+"d").max= month[parseInt(document.getElementById(str+'m').value)-1];
}

function showHide(ad){
/* document.getElementById('ay').style.display = 'none';
document.getElementById('am').style.display = 'none';
document.getElementById('ad').style.display = 'none';

document.getElementById('by').style.display = 'none';
document.getElementById('bm').style.display = 'none';
document.getElementById('bd').style.display = 'none';

document.getElementById('cy').style.display = 'none';
document.getElementById('cm').style.display = 'none';
document.getElementById('cd').style.display = 'none';
document.getElementById('Pnr').style.display = 'none'; */

document.getElementById('forma').style.display = 'none';
document.getElementById('btn').style.display = 'none';
}
</script>
<style type="text/css">
 p {font-size: 12px;}
 h5 {font-size: 15px;
 font-weight: normal;
 }
 span {
 font-weight: Bold;
 }
 span.normalText {
 font-weight: normal;
 }
 dt{
 font-weight: Bold;
 }
</style>

<body>
<div  style="width:850px;margin: auto auto auto auto;">

<form action="index.php" method="post" id="forma" >
Patento numeris: <input name="Pnr" id="Pnr" type="text"/><br>
<h3>Patento paraiškos padavimo data:</h3>
Metai: <input name="yearA" id="ay" type="number" onchange="my20plusYear();"  min="1991" max="<?php echo date("Y");?>"/>
Menuo: <input name="monthA" id="am" type="number" onchange="myMonth();setMonthDay('a');"  min="1" max="12"/>
Diena: <input name="dayA" id="ad" type="number" onchange="myDay()" min="1" max="31"/>

<h3>Leidimo pateikti produktą į rinką data:</h3>
Metai: <input name="yearB" id="by" type="number"  min="1991" max="<?php echo date("Y");?>"/>
Menuo: <input name="monthB" id="bm" type="number" onchange="setMonthDay('b');"  min="1" max="12"/>
Diena: <input name="dayB" id="bd" type="number"  min="1" max="31"/>

<h3>Patento galiojimo pabaigos data: </h3>
Metai: <input name="yearC" id="cy" type="number"  min="1991" max="<?php echo date("Y")+30;?>"/>
Menuo: <input name="monthC" id="cm"  type="number" onchange="setMonthDay('c');"  min="1" max="12"/>
Diena: <input name="dayC" id="cd" type="number"  min="1" max="31"/><br><br>
<input type="submit" value="Skaičiuoti">
</form>
<br>
<button id="btn" onclick="showHide()">Slėpt laukus</button>
<h3>Liudijimo informacija:</h3>
<div style="text-align:left;">
<?php

$maxPAL = 5;


if(isset($_POST['yearA']) && $_POST['yearA']!='' && isset($_POST['monthA'])  && $_POST['monthA']!='' && isset($_POST['dayA']) && $_POST['dayA']!='' && isset($_POST['yearB']) && $_POST['yearB']!='' && isset($_POST['monthB']) && $_POST['monthB']!='' && isset($_POST['dayB']) && $_POST['dayB']!='' && isset($_POST['yearC']) && $_POST['yearC']!='' && isset($_POST['monthC']) && $_POST['monthC']!='' && isset($_POST['dayC']) && $_POST['dayC']!='')
{
//----------------------------------------------------------------
echo '<script type="text/javascript">';

echo 'fillFields('.$_POST['yearA'].','.$_POST['monthA'].','.$_POST['dayA'].','.$_POST['yearB'].','.$_POST['monthB'].','.$_POST['dayB'].','.$_POST['yearC'].','.$_POST['monthC'].','.$_POST['dayC'].','.$_POST['Pnr'].');';

echo '</script>';
//---------------------------------------------------------------------


$a = date_create($_POST['yearA'].'-'.$_POST['monthA'].'-'.$_POST['dayA']);
$b = date_create(($_POST['yearB']).'-'.$_POST['monthB'].'-'.$_POST['dayB']);
$c= date_create(($_POST['yearC']).'-'.$_POST['monthC'].'-'.$_POST['dayC']);
$bPlus15=date_create(date("Y-m-d", mktime(0, 0, 0, $_POST['monthB'], $_POST['dayB'], ($_POST['yearB']+15))));
$interval = $b->diff($a);
$intCminusB15 = $c->diff($bPlus15);
 

if(($interval->format('%Y')-5)>=$maxPAL){
$x= date_create(date("Y-m-d", mktime(0, 0, 0, ($_POST['monthC']), ($_POST['dayC']), ($_POST['yearC']+$maxPAL))));
}
else {
$x= date_create(date("Y-m-d", mktime(0, 0, 0, ($_POST['monthC']+($_POST['monthB']-$_POST['monthA'])), ($_POST['dayC']+($_POST['dayB']-$_POST['dayA'])), ($_POST['yearC']+($_POST['yearB']-$_POST['yearA']-5)))));
}

 //echo '<h4>A '. $a->format('Y - m - d'). '</h4><br>';
 //echo '<h4>d '. $bPlus15->format('Y - m - d'). '</h4><br>';
 //echo '<h4>x '. $x->format('Y - m - d'). '</h4><br>';
// echo $interval->format('%Y -%m - %d').'  laiko tarpas B-A<br>';

echo '<h5>Patento numeris: <span>'. $_POST['Pnr']. '</h5>';
echo '<h5>Patento paraiškos padavimo data: <br><span>'. $a->format('Y - m - d'). '</h5>';
echo '<h5>Leidimo pateikti produktą į rinką data: <br><span>'. $b->format('Y - m - d'). '</h5>';
echo '<h5>Patento galiojimo pabaigos data: <br><span>'. $c->format('Y - m - d'). '</h5>';

 
if(((($interval->format('%Y')-5)>0) || (($interval->format('%Y')-5)==0 && ($interval->format('%m')>0 || $interval->format('%d')>0))) && ($x<=$bPlus15) && ($interval->format('%Y')-5)<$maxPAL){ 

echo '<h5>PAL terminas:<br><span>'.($interval->format('%Y')-5).' met. - '. ($interval->format('%m men. - %d d.'))."</h5>";
echo '<h5>Liudijimo termino pabaigos data:<br><span>'. $x->format('Y - m - d').'</span></h5>';

}
else if(($interval->format('%Y')-5)>=5 && ($x<=$bPlus15)){

echo '<h5>PAL terminas:<br>  <span>5 met. - 00 men. - 00 d.</span></h5>';

echo '<h5>Liudijimo termino pabaigos data:<br>	<span>'.date("Y- m - d", mktime(0, 0, 0, $_POST['monthC'], $_POST['dayC'], ($_POST['yearC']+$maxPAL))).'</span></h5>';
}
else if(($interval->format('%Y')-5)>0 && ($x>=$bPlus15)) {

echo '<h5>Patento galiojimo pabaigos terminas:<br>'. ($intCminusB15->format('%Y met. - %m men. - %d d.'))."</h5>";
echo '<h5>Liudijimo termino pabaigos data:<br><span>'. $bPlus15->format('Y - m - d').'</span></h5>';
}
else {
echo '<h4 style="color:red;">Klaida!!!<h4>
<h5>Laiko tarpas tarp "Patento paraiškos padavimo" ir "Leidimo pateikt produktą į rinką" trumpesnis nei 5 metai.</h5>';
} 
}
?>
</div>


<!--<p>* Visi laukai turi būt užpildyti.</p>
<p>** Klavišas "Tab" perkelia į gretimą (sekantį) lauką. Galima patvirtint "Enter" klavišu.</p>
<p>*** Užpildžius pirmą eilutę duomenų paskutinė eilutė užsipildo automatiškai, tačiau ją galima koreguot.</p>
-->
<h3> Skaičiavimo formulė</h3>
<div style="border-top: 2px solid green; padding: 10px 10px 10px 10px;">
<h1>L = C + (B - A -5 <span class="normalText">(metai)</span>)</h1>
<h3 style="font-weight: bold;"><span class="normalText">Kai</span> (B - A -5 metai)>0<span class="normalText"> ir</span> (B - A -5 metai)<=5 <span class="normalText">(metai), o</span> L<=B+15 <span class="normalText">(metų)</span> </h3>

<h3>Aprašas</h2>
<dl>
  <dd><span class="bold">L</span> - patento galiojimo pabaigos galiojimo pabaigos data.</dd>
  <dd><span class="bold">A</span> - patento paraiškos padavimo data.</dd>
  <dd><span class="bold">B</span> - leidimo pateikti produktą į rinką data.</dd>
  <dd><span class="bold">C</span>- patento galiojimo pabaigos data.</dd>
  <dd><span class="bold">(B - A -5 metai)</span>- terminas (laiko tarpas), galimos reikšmės nuo 1 dienos iki 5 metų.</dd>
</dl>
</div>
</div>




</body>
</html> 
