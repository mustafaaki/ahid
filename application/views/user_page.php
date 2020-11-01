<div class="container-fluid">
        <div class="alert alert-success" style="display: none;"></div>
    <?php if($userInfo["type"]==1){?>
    <form id="userForm" method="POST"  action="<?=base_url("user/save")?>" name="userForm"  >
    <?php }?>
        <table style="width:860px;">
        <tr>
            <td colspan="4"><div class="form-group col-lg-12"><h3><?=$frm["header"]?></h3></div></td>
        </tr>
    <?php if($userInfo["type"]==1){?>
        <tr>
            <td colspan="2">
                <div class="form-group col-lg-6"><label for="sube_ad">Kullanıcı Adı*</label><?=$frm["username"]?></div>
                <div class="form-group col-lg-6"><label for="sube_adres">Email*</label><?=$frm["email"]?></div>
            </td>
        </tr>    
    
        <tr>
            <td colspan="2">
                <div class="form-group col-lg-6"><label for="pass">Şifre*</label><?=$frm["password"]?></div>
                <div class="form-group col-lg-6"><label for="pass">Şifre Tekrar</label><?=$frm["confirm_password"]?></div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="form-group col-lg-6"><label for="pass">Şube seçiniz!</label><?=$frm["sube_id"]?></div>
                <div class="form-group col-lg-6"><label for="pass">Yetki seçiniz!</label><?=$frm["type"]?></div>
            </td>
        </tr>
        <tr>
          <td colspan="4">
            <div class="form-group col-lg-6">
               
               <?=$frm["id"]?>
               <button type="submit" class="btn btn-primary" disabled="disabled">Kaydet</button>
            </div>
          </td>
        </tr>
       <?php }?>
        </table>
     <?php if($userInfo["type"]==1){?> 
        </form>
     <?php }?>
    <hr>
     <table class="table table-bordered table-hover" style="width:860px;">
    <thead>
      <tr>
        <th >Kullanıcı Ad</th>
        <th>Email</th>
        <th>Şube Ad</th>
        
        <th width="80">ŞubeNo</th>
        <th width="25">Yetki</th>
        <th with="30"></th>
        <th width="40"></th>
      </tr>
    </thead>
    <tbody>
        <?php
        foreach ($allusers as $x=>$v){
            if($v["pub"]=="n"){
                $aktif='<a title="Üyeyi aktifleştir" href="'.base_url("user/publish/".$v["id"].'/y').'"><img src="'.base_url("img/deaktif.png").'"</a>';
            }else if($v["pub"]=="y"){
                 $aktif='<a title="Üyeyi pasifleştir" href="'.base_url("user/publish/".$v["id"].'/n').'"><img  src="'.base_url("img/aktif.png").'"</a>';
            }
            echo '<tr><td>'.$v["username"].'</td><td>'.$v["email"].
            '</td><td>'.
            substr($v["sube_ad"],0,45)."</td>".
            '<td align="center">'.$v["sube_no"].'</td><td align="center">'.$v["type"]."</td>";
            
            echo "<td>";
            if($userInfo["type"]==1)
            echo '<a title="Güncelle" href="'.base_url('user/create/'.$v["id"]).'"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>';
            echo "</td>";
            
            echo '<td align="center">';
            if($userInfo["type"]==1)
            echo $aktif;
            echo '</td>';
            echo '</tr>';
        }
        ?>
    
    </tbody>
  </table>

   
</div>