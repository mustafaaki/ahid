<div class="container-fluid">
<div class="alert alert-success" style="display: none;"></div>
   <?php if($userInfo["type"]==1){ ?>
    <form id="subeForm" method="POST"  action="<?=base_url("sube/save")?>" name="subeForm"  >
     <?php }?>
        <table style="width:860px;">
        <tr>
            <td colspan="4"><div class="form-group col-lg-12"><h2><?=$frm["header"]?>  &nbsp; <a class="btn btn-primary" href="<?=base_url("sube");?>" role="button">Formu Yenile</a></h2> </div></td>
        </tr>
        <?php if($userInfo["type"]==1){ ?>
        <tr>
            <td colspan="4">
                <div class="form-group col-lg-4"><label for="sube_ad">Şube Adı*</label><?=$frm["sube_ad"]?></div>
                <div class="form-group col-lg-4"><label for="sube_adres">Şube Adresi*</label><?=$frm["sube_adres"]?></div>
                <div class="form-group col-lg-2"><label for="sube_no">Şube No*</label><?=$frm["sube_no"]?></div>
                <div class="form-group col-lg-2"><label for="sube_no">Şube Sicil No*</label><?=$frm["sube_ref"]?></div>
                
            </td>
        </tr>
       
        <tr>
          <td colspan="4">
            <div class="form-group col-lg-12">
               <?=$frm["sube_id"]?>
               <button type="submit" class="btn btn-primary" disabled="disabled">Kaydet</button>
            </div>
          </td>
        </tr>
         <?php }?>
        </table>
        <?php if($userInfo["type"]==1){ ?>
    </form>
    <?php }?>
     <table class="table table-bordered table-hover" style="width:860px;">
    <thead>
      <tr>
        <th width="80">No</th>
        <th>Şube Ad</th>
        <th>Şube Adres</th>
        <th>Kayıt No</th>
        <?php if($this->data["userInfo"]["type"]==1){ ?>
        <th width="40"></th>
        <th width="40"></th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
        <?php
        foreach ($sube_list as $x=>$v){
            if($v["sube_pub"]=="y"){
                $aktif='<a title="Şubeyi askıya al" href="'.base_url("sube/publish/".$v["sube_id"].'/n').'"><img src="'.base_url("img/aktif.png").'"></a>';
            }else if($v["sube_pub"]=="n"){
                $aktif='<a title="Şubeyi aktif yap" href="'.base_url("sube/publish/".$v["sube_id"].'/y').'"><img  src="'.base_url("img/deaktif.png").'"></a>';
            }
            
            echo "<tr><td>".$v["sube_no"]."</td><td>".$v["sube_ad"]."</td><td>".
            substr($v["sube_adres"],0,45)."<td>".$v["sube_ref"]."</td>";
            if($this->data["userInfo"]["type"]==1){
                echo '<td><a href="'.base_url("sube/index/".$v["sube_id"]).'"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>'."</td>";
                echo '<td>'.$aktif."</td>";
            }
            echo "</tr>";
        }
        ?>
    
    </tbody>
  </table>
 </div>
 </div>
