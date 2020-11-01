<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Dernek Üye Yönetim Sistemi</title>
    
    
    
 
<style type="text/css">
body { background: rgb(204,204,204);}
page {  background: white;display: block;margin: 0 auto;margin-bottom:0;box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);}
page[size="A4"] { margin:0 auto;padding:0; width: 21cm; height: 28cm;}



.metinj{	width:14cm;	text-align: justify;}

.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
   height:auto;width:auto;padding:0px;margin:0px; 
}
.my_print_table {width: 20cm;margin-bottom:0.3cm}
.my_print_table tr td{ }
 
@media print
{
body, page {    margin: 0;    box-shadow: 0;  }
page[size="A4"] {  	margin:0 auto;padding:0;  width: 21cm; }
body * { visibility: hidden; }
#yazdir * { visibility: visible; padding-top:0px;}
#yazdir { position: absolute; top: 0px; left: 0px; }
#yazdir > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
   height:auto;width:auto;padding:0px;margin:0px;}


header nav, footer {display: none;}

}
</style>
</head>
<body>
<page size="A4" id="yazdir">
        
        <table class="my_print_table"  align="center" cellpadding="0" cellspacing="0" border="1" >
          <tr><td rowspan="2" style="width:1.9cm;height:1.3cm" align="center">Karar<br>Sıra No</td><td colspan="3" align="center">Karara Esas Olan Evrakın</td><td  align="center">Mevzunun Mahiyeti ve Hülasası</td></tr>
          <tr><td style="width:3cm" align="center">Tarih</td><td  align="center">No</td><td align="center" align="center">Nereden Gönderildiği</td><td rowspan="2"  style="vertical-align: top" valign="top"><?=$defter["konu"]?></td></tr>
          <tr style="height:0.6cm"><td align="center"><?=$defter["no"]?></td><td style="height:0.6cm" align="center"><?=date_formatchange("d-m-Y",$defter["tarih"])?></td><td></td><td></td></tr>
        </table>
        <table class="my_print_table"  align="center" cellpadding="0" cellspacing="0" border="1">
          <tr><td align="center" style="margin:0;padding:3px">Toplantı Tarihi <?=date_formatchange("d-m-Y",$defter["tarih"])?> Günü</td></tr>
          <tr><td style="margin:0;padding:3px"><b style="display:inline-block;width: 4.6cm">Başkanın Adı ve Soyadı</b> : <?=$defter["baskan"]?></td></tr>
          <tr><td style="margin:0;padding:3px"><b style="display:inline-block;width: 4.6cm">Azaların Adı ve Soyadı</b> : <?=str_replace(";",",",$defter["azalar"]);?></b></td></tr>
        </table>
        <table class="my_print_table" align="center" cellpadding="0" cellspacing="0" border="1">
          <tr>
            <td align="center" style="margin:0;padding:2px">
            <b><h5 style="margin:0;padding:0">Karar Metni</h5></b>
            </td>
          </tr>
          <tr>
            <td style="height: 11cm;font-size:0.28cm;padding:5px;" valign="top">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=htmlspecialchars_decode($defter["icerik"])?><br>
              <?php 
                  $c=0;
                  foreach($uyeler as $uyeInd=>$adsoyad){
                    $uyeArr[$c] = " ".$adsoyad["ad"]." ".$adsoyad["soyad"];
                    $c++;
                  }
                    echo implode(", ",$uyeArr);
                  if($c>=1){
                    echo "<br> Toplam ".$c." kişi.";
                  }
              ?>
            </td>
          </tr>
        </table>
        <table class="my_print_table"  align="center" valign="bottom" cellpadding="0" cellspacing="0" border="1">         
              <tr>
               <td style="margin:0;padding:0px; padding-bottom:0.35cm; padding-top:0.35cm;">
                 
                  <table border="0" cellpadding="0" cellspacing="0">
                  <?
                  echo $imza;
                  $imz = explode(";",$defter["imza"]);
                    $count==0;
                  foreach ($imz as $imzInd=>$imzVal){
                      if($count==0 or $count%7==0){
                         echo "<tr>";
                      }
                      echo '<td align="center" style="width:2.85cm;padding:0cm;padding-top:0.35cm;padding-bottom:0.35cm;font-size:0.28cm;">'.$imzVal.'</td>';
                      $count++;
                      if( ($count%7 == 0) && $count!=0 ){
                        echo  "</tr>";
                      }
                     
                  }
                  if($count%7 != 0){
                    $kalan=$count%7;
                    for($i ;$i<=$kalan;$i++){
                      echo "<td></td>";
                    }
                    echo "</tr>";
                  }
                     
                  ?>
                    </table>
                </td>
              </tr>    
        </table>
</page>
</body>
</html>