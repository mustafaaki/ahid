<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Dernek Üye Yönetim Sistemi</title>
    
     <link rel="stylesheet" href="<?=base_url("css/bootstrap.css")?>">
    
    <link href="<?=base_url("css/home.view.css")?>" rel="stylesheet">
    <link href="<?=base_url("css/datepicker.css")?>" rel="stylesheet">
    <link href="<?=base_url("css/form-validation.css")?>" rel="stylesheet">
    
    <script type="text/javascript">
    base_url='<?=base_url()?>';
    </script>
    <style>
@media print
{
body * { visibility: hidden; }
#yazdir * { visibility: visible; padding-top:40px;}
#yazdir { position: absolute; top: 40px; left: 30px; }
}
.break { page-break-before: always; }


body {
  background: rgb(204,204,204); 
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page[size="A4"] {  
  width: 21cm;
  height: 29.7cm; 
}
page[size="A4"][layout="portrait"] {
  width: 29.7cm;
  height: 21cm;  
}
page[size="A3"] {
  width: 29.7cm;
  height: 42cm;
}
page[size="A3"][layout="portrait"] {
  width: 42cm;
  height: 29.7cm;  
}
page[size="A5"] {
  width: 14.8cm;
  height: 21cm;
}
page[size="A5"][layout="portrait"] {
  width: 21cm;
  height: 14.8cm;  
}
@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }
}


.metinj{
	width:14cm;
	text-align: justify;
}
.control-label{
	text-align: left
}
.left-side{
	width:3.5cm;
	margin-left:3cm;
}
.uyeInfo  td{ border-bottom: solid 1px #000;padding:3px;
    border-bottom:  }
</style>
    </head>
    <body>
  <a href="javascript:window.print()">
Yazdır
</a>  

<page size="A4" id="yazdir">
<table  style="border:solid 0px #ccc;"  align="center">
<tr>
    <td colspan="2" align="center" style="width:10cm;padding-top:1.5cm;">
        <img src="<?=base_url("img/ahid-logo-big.jpg")?>" align="middle" style= "width:3.5cm;"><br>
       <b> ANKARALILAR DERNEĞİ<br>
        <?=$uye["sube_ad"];?><br></b>
        <?=$uye["sube_ref"]?><br>
        <?=$uye["sube_adres"]?><br>
        TEL:229 54 06  | FAX:229 55 06
        
    </td>
    <td align="right" style="width: 10cm;padding-top:1.5cm;padding-right:3.2cm">
        <b>ÜYE GİRİŞ BEYANNAMESİ</b><br>
        ÜYE KAYIT NO:<?=str_pad($uye["sube_no"],2,"0",STR_PAD_LEFT)." ".str_pad($uye["uye_id"],7,"0",STR_PAD_LEFT);?>
        <div class="tc-image" style="width:3.6cm;height:4cm;border:solid 1px #ccc;text-align:center">
             <?php 
       if($uye["fotograf"]!=""){
            echo '<img src="'.base_url("images/".$uye["fotograf"]).'" style="width:3.5cm" align="middle">';   
       }
       ?>
        </div>
    </td>
</tr>
<tr>
    <td colspan="3" align="left" style="padding-left:2.7cm;padding-right:3cm;text-justify: inter-word;">
       &nbsp;<br>
        <div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dernek Genel Başkanlığına,</div>
        <div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2908 sayılı Dernekler Kanununun 16. Maddesinde öngörülen şartları taşıyorum.
        </div>
        <div class="metinj">
        Derneğin Tüzük, Program, İç Yönetmeliklerine uymayı kabul ve senelik .................................TL
        üyelik aidatını ödemeyi taahhüt ediyorum.
        Üyeliğe kabulümü arz ederim.
       </div>
       <div style="width: 4cm;float:right;margin-right:0cm;text-align: center;margin: 0.8cm;margin-top: 0cm;"> <b>İMZA</b><br>......./......./.........</div>
        
      
         
    </td>
</tr>
<tr>
    <td align="center" colspan="3">
    
        <table style="width: 18cm;" class="uyeInfo" align="">
            <tr>
                <td style="width: 3cm;"><b>TC Kimlik No</b></td><td style="width: 6cm;">:<?=$uye["uye_tc"]?></td>
                <td  style="width: 3cm;"><b>Ad Soyad</td><td style="width: 6cm;">:<?=$uye["uye_ad"]?> <?=$uye["uye_soyad"]?></td>
            </tr>
            <tr>
                <td><b>Cinsiyet</b></td><td>:<?=$uye["cinsiyet"]?></td>
                <td><b>Doğum Tarihi</b></td><td>:<?=date_formatchange("d-m-Y",$uye["dogum_tarihi"])?></td>
            </tr>
            <tr>
                <td><b>Baba Adı</b></td><td>:<?=$uye["uye_baba_ad"]?></td>
                <td><b>Anne Adı</b></td><td>:<?=$uye["uye_anne_ad"]?></td>
                
            </tr>
            <tr>
                <td><b>Kütük il</b></td><td>:<?=$uye["kutuk_il"]?></td>
                <td><b>Kütük İlçe/Köy</b></td><td>:<?=$uye["kutuk_ilce"]?>/<?=$uye["kutuk_koy"]?></td>
            </tr>
             <tr>
                <td><b>Doğum İl</b></td><td>:<?=$uye["dogum_il"]?></td>
                <td><b>Doğum İlçe</b></td><td>:<?=$uye["dogum_ilce"]?></td>
            </tr>
            <tr>
                <td><b>İş Tel</b></td><td>:<?=$uye["uye_is_tel"]?></td>
                <td><b>Cep Tel</b></td><td>:<?=$uye["uye_cep_tel"]?></td>
            </tr>
            
            <tr>
                <td><b>Çalıştığı Kurum</td><td>:<?=$uye["kurum"]?></td>
                <td><b>Meslek</b></td><td>:<?=$uye["meslek"]?></td>
            </tr>
             <tr>
                <td><b>Kan Gurubu</b></td><td>:<?=$uye["kan_gurubu"]?></td>
                <td><b>Email</b></td><td>:<?=$uye["email"]?></td>
            </tr>
            <tr>
                <td><b>İş Adres</b></td><td colspan="3"><?=$uye["is_semt"]?> <?=$uye["is_mahalle"]?> <?=$uye["is_adres"]?> &nbsp; <?=$uye["is_ilce"]?>/<?=$uye["is_il"]?></td>
            </tr>
             <tr>
                <td><b>Ev Adres</b></td><td colspan="3"><?=$uye["ev_semt"]?> <?=$uye["ev_mahalle"]?> <?=$uye["ev_adres"]?> &nbsp; <?=$uye["ev_ilce"]?> / <?=$uye["ev_il"]?></td>
            </tr>
            <tr>
               <td colspan="4" align="right" style="border-bottom:dotted 1px; "><?=$uye["uye_ad"]?> <?=$uye["uye_soyad"]?> 'ın üye olarak kaydını arz ederiz.</td>
            </tr>
        </table>
   
    
    </td>
</tr>

<tr>
    <td colspan="3" align="center"><br>
        <table align="center"  style="width:18cm;"> 
                    <tr><td colspan="3" align="center" style="text-align: center;height:1.1cm"><b>ÖNERENLER</b></td></tr>
                    <tr align="center">
                        <td  style="width:6cm;font-weight: bold">ÜYE</td>
                        <td style="width:6cm;font-weight: bold">ÜYE</td>
                        <td style="width:6cm;font-weight: bold">ÜYE</td>
                    </tr>
                    <tr align="center">
                        <?php 
                            $onerenLis=explode(",",$uye["onerenler"]);
                            //$oneren2=explode(";",$uye["onerenler"]);
                           // $onerenLis=array_merge($oneren1,$oneren2);
                            for($i=0; $i<=2 ;$i++){
                                echo '<td valign="top" style="height:1cm;">'.$onerenLis[$i]."</td>";
                            }
                        ?>
                    </tr>
          <tr>
          <?php 
          if($defter_result["tarih"]!=""){
           $tarih=date_formatchange("d-m-Y",$defter_result["tarih"]);
           $no=$defter_result["no"];  
          }else{
           $tarih="......./....../20....";
           $no="...............";
          }
          
          ?>
             <td height="30" colspan="3" align="left">
                    <div style="margin:0.5cm;text-align: justify;"><b>Yukarıdaki kimliği yazılı olan <?=$tarih?> tarih ve <?=$no?> sayılı 
        Yönetim Kurulu Kararı ile üyeliğe kabul edilmiştir.</b>
              </td>
          
          </tr>
         </table>       
        </div>
          <table align="center"  style="width:18cm;margin:0.1cm" > 
                    <tr><td style="width:9cm" align="center">Genel Sekreter</td><td style="width:9cm" align="center">Genel Başkan</td></tr>
          </table>
    </td>
</tr>
</table>

</page>
 <script type="text/javascript" src="<?=base_url("js/jquery.min.js")?>"></script>
 <script type="text/javascript" src="<?=base_url("js/bootstrap.min.js")?>"></script>
</body>
</html>