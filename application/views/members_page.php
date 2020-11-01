<div class="container-fluid">
<div class="alert alert-success" style="display: none;"></div>
    
    <form id="memberForm" method="POST"  action="<?=base_url("members/save")?>" name="membersForm" enctype="multipart/form-data"  >
        <table style="width:860px;">
          <tr>
            <td colspan="4"><div class="form-group col-lg-12"><h3>
                <?=$frm["header"]?>  &nbsp;  <a class="btn btn-primary" href="<?=base_url('members/create')?>" role="button">Formu Yenile</a></h3>
            <h5><?=$error?></h5></div>
            </td>
          </tr>
          <tr>
              <td colspan="4"> 
                  <div class="form-group col-lg-12"><label for="tcno" class="form-control-label">TC No*</label><?=$frm["tc"]?><?=$frm["tcsub"]?></div>
              </td>
          </tr>
          <tr>     
              <td colspan="2" valign="top" style="width:430px;">
                  <div class="form-group col-lg-12"><label for="ad" class="control-label">Ad*</label><?=$frm["ad"]?></div>
              </td>
              <td colspan="2" valign="top" style="width:430px;">
                  <div class="form-group col-lg-12"><label for="soyad" class="control-label">Soyad*</label><?=$frm["soyad"]?></div>
               </td>
           </tr>
           <tr>     
               <td valign="top" style="width:215px;">
                    <div class="form-group col-sm-12"><label for="baba_ad" class="control-label">Baba Adı</label><?=$frm["baba_ad"]?></div>
               </td>
               <td  valign="top" style="width:215px;">
                    <div class="form-group col-lg-12"><label for="anne_ad" class="control-label">Anne Adı</label><?=$frm["anne_ad"]?></div>
               </td>
               <td  valign="top" style="width:215px;">
                    <div class="form-group col-sm-12"><label for="dogum_il" class="control-label">Doğum İli</label><?=$frm["dogum_il"];?></div>
               </td>
               <td  valign="bottom" style="width:215px;">
                    <div class="form-group col-sm-12" id="dogum_ilce_container"><?=$frm["dogum_ilce"];?></div>
               </td>
           </tr>
           <tr>     
               <td   valign="top" style="width:215px;">
                    <div class="form-group col-sm-12"><label for="Cinsiyet" class="control-label">Cinsiyet*</label><?=$frm["cinsiyet"];?></div>
               </td>
               <td  valign="top" style="width:215px;">        
                     <div class="form-group col-sm-12"><label for="dogum_tarihi" class="control-label">Doğum Tarihi</label><?=$frm["dogum_tarihi"];?></div>
               </td>
               <td  valign="top" style="width:215px;">
                     <div class="form-group col-sm-12"><label for="dogum_tarihi" class="control-label">Çalıştığı Kurum</label><?=$frm["kurum"];?></div>
               </td>
               <td  valign="top" style="width:215px;">
                     <div class="form-group col-sm-12"><label for="meslek" class="control-label">Mesleği</label><?=$frm["meslek"];?></div>
               </td>
           </tr>
           <tr>     
                <td valign="top" style="width:215px;"><div class="form-group col-sm-12"><?=$frm["kutuk_il"];?></div></td>
                <td valign="top" style="width:215px;"><div class="form-group col-sm-12" id="kutuk_ilce_container"><?=$frm["kutuk_ilce"];?></div></td>
                <td valign="top" style="width:215px;"><div class="form-group col-sm-12" id="kutuk_koy"><?=$frm["kutuk_koy"];?></div></td>
                <td valign="top" style="width:215px;"><div class="form-group col-sm-12" id="kutuk_semt_container"></div></td>
                </td>
           </tr>
           <tr>     
                <td valign="top">
                   <div class="form-group col-sm-12"><label for="is_tel">İş Tel</label><?=$frm["is_tel"]?></div>
                </td>
                <td valign="top">
                   <div class="form-group col-sm-12"><label for="cep_tel">Cep Tel</label><?=$frm["cep_tel"]?></div>
                </td>
                <td valign="top">
                   <div class="form-group col-sm-12"><label for="email">E-mail</label><?=$frm["email"]?></div>
                </td>
                <td valign="top">
                   <div class="form-group col-sm-12"><label for="kan_gurubu">&nbsp;</label><?=$frm["kan_gurubu"]?></div>
                </td>
           </tr>
           <tr>  
              <td colspan="4"><hr><label for="isadresi">&nbsp;&nbsp;&nbsp;&nbsp;İş adres bilgileri</label></td>
           </tr> 
           <tr>
                <td colspan="4">
                     <div class="form-group col-sm-3">
                        <?=$frm["is_il"];?>           
                    </div>
                    <div class="form-group col-sm-3" id="is_ilce_container"><?=$frm["is_ilce"];?> </div>
                    <div class="form-group col-sm-3" id="is_semtmahalle_container"><?=$frm["is_semt"];?></div>
                    
                </td>
              </tr>
              <tr>
                  <td colspan="4">
                    <div class="form-group col-lg-12">
                        <label for="is_adres">İş Açık Adres</label>
                        <?=$frm["is_adres"];?>
                    </div>
                  </td>
              </tr>
              <tr>
                    <td colspan="4"><hr color="red"><label for="isadresi">&nbsp;&nbsp;&nbsp;&nbsp;Ev adres bilgileri</label></td>
              </tr>
              <tr>
                <td colspan="4">
                        <div class="form-group col-sm-3"><?=$frm["ev_il"];?> </div>
                        <div class="form-group col-sm-3" id="ev_ilce_container"><?=$frm["ev_ilce"];?></div>
                        <div class="form-group col-sm-3" id="ev_semtmahalle_container"><?=$frm["ev_semt"];?></div>           
                </td>
              </tr> 
              <tr>
                  <td colspan="4">
                    <div class="form-group col-lg-12">
                        <label for="ev_adres">Açık Ev Adresi Ek</label>
                        <?=$frm["ev_adres"];?>
                    </div>
                  </td>
              </tr>
              <tr>
                  <td colspan="4"><hr color="red">
                        <div class="form-group col-lg-12">
                            <label for="onerenler">Önerenler (İsimleri Virgülle(,) Ayırın)</label>
                            <?=$frm["onerenler"]?><br>
                            <?=$frm["sube_id"]?>
                        </div>
                  </td>
              </tr>
              <tr>
                  <td colspan="4">
                        <div class="form-group col-lg-12">
                        
                        <?php if($frm["fotograf"]!=""){
                           echo '<a  href="'.base_url("images/".$frm["fotograf"]).'" target="_blank" >';
                           echo '<img style="margin:18px;" src="'.base_url("images/".$frm["fotograf"]).'" width="140px;" align="left">';
                           echo '</a>';
                        }?>
                            
                            
                            Üye Resimi<input id="input-20" name="fotograf" type="file" class="file-loading" accept="image/*">
                        </div>
                  </td>
              </tr> 
              <tr>
                  <td colspan="4">
                    <div class="form-group col-lg-12">
                       <?=$frm["uye_id"]?>
                       
                       <button type="submit" class="btn btn-primary" disabled="disabled">Kaydet</button>
                    </div>
                  </td>
              </tr>
         
        </table>
    
    
    </form>
</div>

