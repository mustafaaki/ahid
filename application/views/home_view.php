<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Dernek Üye Yönetim Sistemi</title>
    <script type="text/javascript" src="<?=base_url("js/wysihtml5-0.3.0.min.js");?>"></script>
    
    <script src="<?=base_url("js/jquery.min.js")?>"></script>
	<script src="<?=base_url("js/bootstrap.min.js")?>"></script>
	
	<script type="text/javascript" src="<?=base_url("js/bootstrap3-wysihtml5.js");?>"></script> 
	
		<link rel="stylesheet" href="<?=base_url("css/bootstrap.min.css");?>">
		<link rel="stylesheet" href="<?=base_url("css/font-awesome.min.css")?>">
   <link rel="stylesheet" href="<?=base_url("css/bootstrap-wysihtml5.css");?>">
           
     

    

    <link href="<?=base_url("css/home.view.css")?>" rel="stylesheet">
    <link href="<?=base_url("css/datepicker.css")?>" rel="stylesheet">
    <link href="<?=base_url("css/form-validation.css")?>" rel="stylesheet">
    <link href="<?=base_url("css/bootstrap-select.min.css")?>" rel="stylesheet">
   
    
    <script type="text/javascript">
    base_url='<?=base_url()?>';

    </script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  
 


</head>
<body>

<table>
  <tr>
  <td valign="top"><?=$leftmenu;?></td>
  <td valign="top">
    
                    
           <?=$incPage;?>
  </td>
  </tr>
</table>

  <div class="popup">
   <i  class="fa fa-window-close fa-lg popupCloser" aria-hidden="true"></i>
   <div></div>
</div>  
  

    <script type="text/javascript" src="<?=base_url("js/formValidation.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("js/framework/bootstrap.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("js/myscript.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("js/bootstrap-datepicker.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("js/myFormValidation.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("js/bootstrap-select.min.js")?>"></script>
    <script src="<?=base_url("js/locales/bootstrap-datepicker.tr.js")?>" charset="UTF-8"></script>
     
    <!-- language  -->
    <script type="text/javascript" src="<?=base_url("js/language/tr_TR.js")?>" charset="UTF-8"></script>
    
    <script type="text/javascript">
  
    $('.input-daterange input').each(function() {
        $(this).datepicker({
			format: 'dd-mm-yyyy',
            todayBtn: 'linked',
            language: 'tr'});
    });
    </script>


	
  </body>
</html>