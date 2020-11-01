<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Dernek Üye Yönetim Sistemi</title>
    
<link rel="stylesheet" href="<?=base_url("css/bootstrap.css")?>">    
<link rel="stylesheet" href="<?=base_url("css/home.view.css")?>" >
<link rel="stylesheet" href="<?=base_url("css/datepicker.css")?>" >
<link rel="stylesheet" href="<?=base_url("css/form-validation.css")?>">
<link rel="stylesheet" href="<?=base_url("css/jquery.data.tables.min.css");?>">
<link rel="stylesheet" href="<?=base_url("css/font-awesome.min.css")?>">
<script type="text/javascript">
base_url='<?=base_url()?>';
</script>   
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script type="text/javascript" src="<?=base_url("js/jquery.min.js")?>"></script>
<script type="text/javascript" src="<?=base_url("js/bootstrap.min.js")?>"></script>
<script type="text/javascript" src="<?=base_url("js/jquery.data.tables.js");?>"></script> 
<script type="text/javascript" src="<?=base_url("js/jquery.data.tables.bootstrap.min.js");?>"></script>  
<script type="text/javascript" src="<?=base_url("js/jquery.data.tables.UIkit.js");?>"></script> 
</head>
<body style="margin:10px;">

<table class="stripe row-border order-column" cellspacing="0" id="listTable">
<thead class="thead-inverse">
    <tr>
     <?php 
        foreach($result[0] as $g=>$gg){
        if($shortHeader[$g]){
                echo '<th>'.$shortHeader[$g].'</th>';
            }else{
                echo '<th>'.$g.'</th>';
            }
        }
      ?>
    </tr> 
</thead>
<tfoot class="thead-inverse">
    <tr>
           
          <?php 
            foreach($result[0] as $g=>$gg){
            if($shortHeader[$g]){
                    echo '<th>'.$shortHeader[$g].'</th>';
                }else{
                    echo '<th>'.$g.'</th>';
                }
            }
          ?>
    </tr>  
</tfoot>
<tbody>
        <?php 
          foreach($result as $i=>$v){
              echo "<tr>";
               foreach($v as $k=>$text){
                   $kCount++;
                   if($k=="uye_id"){
                     $text=str_pad($text,7,"0",STR_PAD_LEFT);
                   }else if($k=="dogum_tarihi"){
                     $text = date_formatchange("d-m-Y",$text);   
                   }else if($k=="sube_id"){
                     $text = str_pad($text,2,"0",STR_PAD_LEFT);
                   }
                   if($k=="tc"){
                      $identity= '<a href="'.base_url("members/create/".$text).'"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>'.
                      '&nbsp;<i class="popupOpener fa fa-id-card" aria-hidden="true" func="call_member" unique-data="'.$text.'"></i>';
                   }else{
                      $identity="";
                   }
                  
                   echo '<td>'.$text." ".$identity.'</td>';
               }    
              echo "</tr>";
          }
        ?>
</tbody>
</table>

<div class="popup">
   <i  class="fa fa-window-close fa-lg popupCloser" aria-hidden="true"></i>
   <div></div>
</div>

<style type="text/css">
    /* Ensure that the demo table scrolls */
    th, td { white-space: nowrap; }
    div.dataTables_wrapper { margin: 0 auto; } 
    div.container {  width: auto; }
</style>
 
  
 
    <script type="text/javascript" src="<?=base_url("js/myscript.js")?>"></script>
    
    
</body>
</html>