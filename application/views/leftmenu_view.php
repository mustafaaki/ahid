<nav class="navbar navbar-default sidebar" role="navigation">
<div class="brand"><a href="<?=base_url('home')?>" title="Anasayfa"><img align="middle" src="<?=base_url('logo.png')?>"></a><br>Hoşgeldin <?=$login["loginInfo"]['username']?></div>
    <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>      
    </div>
    <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Üye İşlemleri <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-credit-card"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
             <li><a href="<?=base_url("members/create")?>">Yeni Üye Girşi</a></li>
             <li><a href="<?=base_url("searchlist/tumu")?>">Şube Üye Listesi</a></li>
             <?php if($userInfo["type"]==1 or $userInfo["type"]==3){ ?>
             <li><a href="<?=base_url("searchlist/tumsubeuyeleri")?>">Tüm Şube Üye Listesi</a></li>
             
             <?php }?>
             <li><a href="<?=base_url("members/search")?>">DetayLı Üye Arama</a></li>       
          </ul>
        </li>          
        <li ><a href="#" class="dropdown-toggle" data-toggle="dropdown">Karar Defteri<span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-book"></span></a>
            <ul class="dropdown-menu forAnimate" role="menu">
                <li><a href="<?=base_url("defter/liste")?>">Alınan Kararlar Liste & Arama </a></li>
                <li><a href="<?=base_url("defter/create")?>">Karar Yeni  Giriş</a></li>
                
            </ul>
        </li>
        <?php if($userInfo["type"]==1 or $userInfo["type"]==3){ ?>        
        <li><a href="<?=base_url("sube")?>">Şube Kayıt<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th"></span></a></li>
        <?php }?>
        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Kullanıcılar<span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
            <ul class="dropdown-menu forAnimate" role="menu">
            <?php if($userInfo["type"]==1 or $userInfo["type"]==3){ ?>
                <li><a href="<?=base_url("user/create")?>">Kullanıcılar</a></li>
                <?php }?>
                <li><a href="<?=base_url("password/change")?>">Şifremi Değiş</a></li>
                
            </ul>
        </li>
        
        <li><a href="<?=base_url('yonetim/create')?>">Yönetici Listesi<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tower"></span></a>
       
        <li><a href="<?=base_url('help')?>">Yardım<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-question-sign"></span></a>
        <li><a href="<?=base_url("logout")?>">Güvenli Çıkış<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-play-circle"></span></a>
        </li>
       
      </ul>
    </div>
  </div>
</nav>
        