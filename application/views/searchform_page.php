<div class="container-fluid">
<div class="alert alert-success" style="display: none;"></div>
    
    <form id="searchForm" method="POST" action="<?=base_url("searchlist/table")?>" name="searchForm" target="_blank" >
        <table style="width:860px;">
          <tr>
            <td colspan="4"><div class="form-group col-lg-12"><h3>Üye Arama Formu &nbsp; <a class="btn btn-primary" href="<?=base_url("members/search");?>" role="button">Formu Yenile</a></h3>
            <h5><?=$frm['error']?></h5></div></td>
          </tr>
 
          <tr>
              <td valign="bottom"> 
                  <div class="form-group col-lg-12"><label for="tcno" class="form-control-label">Anahtar Kelime, <h6>tc, uye_no, kurum, meslek, kutuk_koy, onerenler, is_adres, ev_adres alanıda arama yapar.</h6></label>
                  <input type="text" name="key" class="form-control" value="" >
                  </div>
              </td>
              <td valign="bottom"> 
                  <div class="form-group col-lg-12"><label for="tcno" class="form-control-label">Üye No
                  <h6>İlk iki hanesi hariç</h6></label>
                  <input type="text" name="uye_no" class="form-control" value="" >
                  </div>
              </td>
              <td valign="bottom"> 
                  <div class="form-group col-lg-12"><label for="tcno" class="form-control-label">Ad</label>
                  <input type="text" name="ad" class="form-control" value="" >
                  </div>
             </td>
             <td valign="bottom"> 
                  <div class="form-group col-lg-12"><label for="tcno" class="form-control-label">Soyad</label>
                  <input type="text" name="soyad" class="form-control" value="" >
                  </div>    
             </td>  
          </tr>
          <tr>
                <td valign="bottom">
                   <div class="form-group col-sm-12">
                        <label for="Cinsiyet" class="control-label">Cinsiyet*</label><?=$frm["cinsiyet"];?>
                   </div>
                </td>
                <td valign="bottom">
                    <div class="form-group col-lg-12">
                    <?=$frm["dogum_tarihi"];?>
                    </div>
                </td>
                <td valign="bottom">
                    <div class="form-group col-lg-12">
                  <?php if($userInfo["type"]==1 or $userInfo["type"]==3){
                      echo $frm["subeler"];
                      
                  } ?>
                    </div>
                </td>
                
                <td valign="bottom">
                    <div class="form-group col-sm-12"><?=$frm["kan_gurubu"];?></div>
                </td>
          </tr>
          <tr>   
               
               <td  valign="top" style="width:215px;">
                    <div class="form-group col-sm-12"><label for="dogum_il" class="control-label">Doğum İli</label><?=$frm["dogum_il"];?></div>
               </td>
               <td  valign="bottom" style="width:215px;">
                    <div class="form-group col-sm-12" id="dogum_ilce_container"><?=$frm["dogum_ilce"];?></div>
               </td>
               <td valign="top" style="width:215px;"><div class="form-group col-sm-12">
               <label for="dogum_il" class="control-label">Kütük ili</label>
               <?=$frm["kutuk_il"];?></div></td>
               <td valign="bottom" style="width:215px;"><div class="form-group col-sm-12" id="kutuk_ilce_container"><?=$frm["kutuk_ilce"];?></div></td>
                
 
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
                    <div class="form-group col-sm-3" id="is_semt_container"><?=$frm["is_semt"];?></div>
                    <div class="form-group col-sm-3" id="is_mahalle_container"><?=$frm["is_mahalle"];?></div>
                </td>
              </tr>
        
              <tr>
                    <td colspan="4"><hr color="red"><label for="isadresi">&nbsp;&nbsp;&nbsp;&nbsp;Ev adres bilgileri</label></td>
              </tr>
              <tr>
                <td colspan="4">
                        <div class="form-group col-sm-3"><?=$frm["ev_il"];?> </div>
                        <div class="form-group col-sm-3" id="ev_ilce_container"><?=$frm["ev_ilce"];?></div>
                        <div class="form-group col-sm-3" id="ev_semt_container"><?=$frm["ev_semt"];?></div>
                        <div class="form-group col-sm-3" id="ev_mahalle_container"><?=$frm["ev_mahalle"];?></div>
                </td>
              </tr>
              <tr>
                    <td colspan="4">
                        <div class="form-group col-lg"><label for="tcno" class="form-control-label">Görüntülenecek Alanlar</label><br>
                            
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="sube.sube_id as sube_id">Sube No</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="uye.uye_id as uye_id">Üye Id</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="uye.tc as tc">TC</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="uye.ad as ad" >Ad</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="uye.soyad as soyad" >Soyad</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="uye.baba_ad">Baba Ad</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="uye.anne_ad">Anne Ad</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="dogum_il.ad as dogum_il">Doğum il</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="dogum_ilce.ad as dogum_ilce">Doğum İlçe</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="kutuk_il.ad as kutuk_il">Kütük il</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="kutuk_ilce.ad as kutuk_ilce">Kütük ilçe</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="uye.kutuk_koy">Kütük Köy</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="uye.cinsiyet">Cinsiyet</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="uye.dogum_tarihi">Doğum Tarihi</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="uye.is_tel" >İş Tel</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="uye.cep_tel">Cep Tel</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="uye.kurum">Kurum</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="uye.meslek">Meslek</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="uye.email">email</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="uye.kan_gurubu">Kan Gurubu</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="is_il.ad as is_il">İş il</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="is_ilce.ad as is_ilce">İş ilçe</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="is_semt.ad as is_semt">İş Semt</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="is_mahalle.ad as is_mahalle">İş Mahalle</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="uye.is_adres as is_adres">İş Adres</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="ev_il.ad as ev_il">Ev il</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="ev_ilce.ad as ev_ilce">Ev ilçe</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="ev_semt.ad as ev_semt">Ev Semt</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="ev_mahalle.ad as ev_mahalle">Ev Mahalle</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="uye.ev_adres as ev_adres">Ev Adres</label></div>
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="sube.sube_ad as sube_ad">Şube Ad</label></div>
                            
                            <div class="checkbox-inline"><label><input type="checkbox" name="show[]" value="onerenler">Önerenler</label></div>
                          <input type="button" value="Tümünü Seç" id="togglecheckbox" />
                        </div>
                    </td>
              </tr> 
              <tr>
                  <td colspan="4">
                    <div class="form-group col-lg-12">
                       
                      
                       <div class="checkbox-inline"><label><input type="checkbox" name="excel" value="TRUE">Excel Çıktısı</label></div>
                      <br><br>
                       <button type="submit" class="btn btn-primary">Ara</button>
                       
                      
                    </div>
                  </td>
              </tr>
         
        </table>
    
    
    </form>
</div>

