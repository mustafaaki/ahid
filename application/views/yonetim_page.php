<div class="container-fluid">
    <div class="alert alert-success" style="display: none;"></div>
    <?php if($this->data["userInfo"]["type"]==1 or $this->data["userInfo"]["type"]==2){ ?>
    <form id="yonetimForm" method="POST" action="<?=base_url("yonetim/save")?>" name="yonetimForm" >
        <table style="min-width:860px;">
          <tr>
                <td>
                    <div class="form-group col-lg-12">
                        <h3><?=$frm["header"]?></h3>
                        <h5><?=$frm['error']?></h5>
                    </div>
                </td>
          </tr>
          <tr>
                <td>
                    <div id="isim" class="form-group col-sm-5">
                        <label for="Cinsiyet" class="control-label">Yönetici Ad soyad*</label>
                        <?=$frm["isim"]?>
                    </div>            
                    <div id="unvan" class="form-group col-sm-5">
                        <label for="Cinsiyet" class="control-label">Yönetici Ünvan*</label>
                        <?=$frm["unvan"]?>
                    </div>            
                    <div id="sira" class="form-group col-sm-2">
                        <label for="Cinsiyet" class="control-label">Sıra No*</label>
                        <?=$frm["sira"]?>
                    </div>            
                <td>
          </tr>
          <tr>
              <td>
                    <div id="isim" class="form-group col-sm-3">
                        <label for="Cinsiyet" class="control-label">Email</label>
                        <?=$frm["email"]?>
                    </div>
                    <div id="isim" class="form-group col-sm-3">
                        <label for="Cinsiyet" class="control-label">İş Tel</label>
                        <?=$frm["is_tel"]?>
                    </div>
                    <div id="isim" class="form-group col-sm-3">
                        <label for="Cinsiyet" class="control-label">Cep Tel</label>
                        <?=$frm["cep_tel"]?>
                    </div>
                    <div id="isim" class="form-group col-sm-3">
                        <label for="Cinsiyet" class="control-label">Fax</label>
                        <?=$frm["fax"]?>
                    </div>
              
              </td>
          </tr>
          <tr>
              <td>
                <div class="form-group col-lg-12">
                   <?=$frm["user_id"]?>
                   <?=$frm["sube_id"]?>
                   <?=$frm["id"]?>
                   <button type="submit" class="btn btn-primary">Kaydet</button>
                </div>
              </td>
          </tr>
        </table>          
    </form>
     <hr>
    <?php } ?>
    <table class="table table-hover" style="width:860px;">
            <tr>
              <td>
              <h3>Yönetim Listesi</h3>
                <?=$sube_list?><br>&nbsp;
              </td>
              
            </tr>
    
    </table>
    <table class="table table-bordered table-hover" style="width:860px;">
    <thead>
      <tr>
        <th>Ad Soyad</th>
        <th>Ünvan</th>
        <th width="160">Şube Ad</th>
        <th width="80">Sıra</th>
        <?php if($this->data["userInfo"]["type"]==1 or $this->data["userInfo"]["type"]==2){ ?>
        <th>Düzenle</th>
        <th>Sil</th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
    <?php 
    foreach($sube_yonetim as $yonetimInd=>$yonetimVal){
        echo "<tr>";
        echo '<td><i class="popupOpener fa fa-id-card" aria-hidden="true" func="call_yonetim" unique-data="'.$yonetimVal["id"].'"></i>'. $yonetimVal["isim"].'</td>';
        echo "<td>". $yonetimVal["unvan"]."</td>";
        echo '<td width="87" align="center">'.substr($yonetimVal["sube_ad"],0,15)."...</td>";
        echo '<td width="70" align="center">'.$yonetimVal["sira"]."</td>";
        if($this->data["userInfo"]["type"]==1 or $this->data["userInfo"]["type"]==2){
            echo '<td width="50" align="center"><a href="'. base_url('yonetim/create/'.$yonetimVal['id']).'"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a></td>';
            echo '<td width="50" align="center"><a href="'. base_url('yonetim/delete/'.$yonetimVal['id']).'"><i class="fa fa-times-circle-o fa-lg" aria-hidden="true"></i></a></td>';
        } 
        echo "</tr>";
    }
    
    ?>
        
    </tbody>
    </table>
 </div>
