<div class="container-fluid">
<div class="alert alert-success" style="display: none;"></div>
    
    <form id="passwordForm" method="POST" action="<?=base_url("password/save")?>" name="passwordForm" >
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
                    <div id="isim" class="form-group col-sm-6">
                        <label for="Cinsiyet" class="control-label">Eski şifre*</label>
                        <?=$frm["password"]?>
                    </div> 
                </td>
          </tr>
          <tr>
                <td>           
                    <div id="unvan" class="form-group col-sm-6">
                        <label for="Cinsiyet" class="control-label">Yeni şifre</label>
                        <?=$frm["new_password"]?>
                    </div>
                </td>
          </tr>
          <tr>
                <td>            
                    <div id="sira" class="form-group col-sm-6">
                        <label for="Cinsiyet" class="control-label">Yeni şifre tekrar</label>
                        <?=$frm["confirm_password"]?>
                    </div>            
                <td>
          </tr>
          <tr>
              <td>
                <div class="form-group col-lg-12">
                  
                   <button type="submit" class="btn btn-primary">Şifremi Kaydet</button>
                </div>
              </td>
          </tr>
      </table>
   </form>
</div>
          
          