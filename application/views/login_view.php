<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="<?=base_url("css/bootstrap.min.css");?>" rel="stylesheet">
<link href="<?=base_url("css/login.css");?>" rel="stylesheet">
</head>
<body>

<div class="container">
    <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3"> 
        
        <div class="row">                
            <div class="iconmelon">
              <div class="brand"><img align="middle" src="<?=base_url('logo.png')?>" ></div>
            </div>
        </div>
        <div class="panel panel-default" >
                    <div class="panel-heading">
                        <div class="panel-title text-center">AHİD Üye Bilgi Yönetim Sistemi</div>
                    </div>     
                	 
                		<div class="form-top">
                    		<div class="text-center"><br><?php echo $error ?></div>
                		</div>
                   <div class="panel-body" >
                        <form role="form" action="<?php echo base_url('login/check')?>" method="post" class="login-form" id="loginForm">
                        	<div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            	<input id="user" type="text" class="form-control" name="email" placeholder="e-mail" value="<?=$email?>">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            	<input type="password" name="pass" placeholder="Şifre" class="form-control" id="password">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-log-in"></i> Giriş</button>
                            </div> 
                        </form>
                    </div>  
         </div><!-- default panel -->
    </div>  <!-- loginbox end -->
</div><!-- Container end -->
<script src="<?=base_url("js/bootstrap.min.js");?>"></script>
<style>
body {
    background-color: white;
}

#loginbox {
    margin-top: 30px;
}

#loginbox > div:first-child {        
    padding-bottom: 10px;    
}

.iconmelon {
    display: block;
    margin: auto;
}

#loginForm > div {
    margin-bottom: 25px;
}

#loginForm > div:last-child {
    margin-top: 10px;
    margin-bottom: 10px;
}

.panel {    
    background-color: transparent;
}

.panel-body {
    padding-top: 30px;
    background-color: rgba(2555,255,255,.3);
}

#particles {
    width: 100%;
    height: 100%;
    overflow: hidden;
    top: 0;                        
    bottom: 0;
    left: 0;
    right: 0;
    position: absolute;
    z-index: -2;
}

.iconmelon,
.im {
  position: relative;
  width: 110px;
  height: 110px;
  display: block;
  fill: #525151;
}

.iconmelon:after,
.im:after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
    
</style>
</body>
</html>

