<div class="container-fluid">

    <form id="defterForm" method="POST" action="<?=base_url("defter/save")?>" name="defterForm" >
        <table style="min-width:860px;">
          <tr>
                <td>
                    <div class="form-group col-lg-12">
                        <h3><?=$frm["header"]?>&nbsp; <a class="btn btn-primary" href="<?=base_url("defter/create");?>" role="button">Formu Yenile</a></h3>
                       <?php 
                        if($error!=""){
                       ?>
                      
                       <div class="alert alert-danger"> <h5><?=$error?></h5></div>
                        <?php  }?>
                    </div>
                </td>
          </tr>
          <tr>
                <td>
                  <div class="form-group col-lg-3">
                    <label for="tcno" class="form-control-label">No</label>
                    <?=$frm["no"];?>
                  </div>
                 
                  <div class="form-group col-sm-6" id="dogum_ilce_container"><label for="Cinsiyet" class="control-label">Konu*</label><?=$frm["konu"];?></div>
                 
                  <div class="form-group col-sm-3">
                        <label for="Cinsiyet" class="control-label">Tarih*</label>
                        <?=$frm["tarih"];?>
                  </div>
               </td>  
          </tr>
          <tr>     
               <td  valign="bottom">
                    <div class="form-group col-sm-12" id="dogum_ilce_container">
                        <label for="Cinsiyet" class="control-label">Başkan - Yada vekil-leri*</label>
                        <?=$frm["baskan"];?>
                    </div>
               </td>  
           </tr>
          <tr>     
               <td  valign="bottom">
                    <div class="form-group col-sm-12" id="dogum_ilce_container">
                        <label for="Cinsiyet" class="control-label">İçerik*</label>
                        <?=$frm["icerik"];?>
                    </div>
               </td>  
           </tr>
    
           
           <tr>     
               <td  valign="bottom">
                    <table>
                        <td>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deftere  kaydolmayan&nbsp;
                        </td>
                        <td>
                            <input id="uye_olmayan" name="uye_olmayan" value="" class="form-control" style="width: 100px;">
                        </td>
                        <td>&nbsp;üyenin isimlerini ekle.(Max:999) 
                            <b><span id="call_defter_uye" >Eklediklerimi geri getir</span></b>
                        </td>
                    </table> 
               </td>
          </tr>
          <tr>   
               <td  valign="bottom">
                  <div id="uye-olmayan-list" class="form-group col-sm-12">
                  <?php 
                    foreach($uyeler  as  $uyeInd=>$uyeVal){
                        echo '<div class="checkbox-inline" ><input name="uye_id[]" type="checkbox" value="' . $uyeVal["uye_id"] . '" checked>' . $uyeVal["ad"] . " " . $uyeVal["soyad"] . ',</div>';   
                    }
                  ?>
                  
                  </div>
               </td>
              
          </tr>
          <tr>     
               <td  valign="bottom"><hr><h4>Azalar</h4><hr><div class="form-group col-sm-12">
                    
                  <?php 
                  $azalar= explode(";",$azalar);
                    foreach($yonetim as $yonInd=>$yonVal){
                        if(in_array($yonVal["isim"], $azalar)){
                            $checkedAzalar='checked="checked"';
                        }else{
                            $checkedAzalar="";
                        }
                        echo '<div class="checkbox-inline">
                            <input class="azaelement" type="checkbox" name="azalar[]" value="'.$yonVal["isim"].'" '.$checkedAzalar.'/>'.$yonVal["isim"].'
                            </div>';
                    }
                    
                  ?>
                    <input type="button" id="checkaza" value="Tümünü Seç" />
              
                  
                  </div>
               </td>
          </tr>
          <tr>     
               <td  valign="bottom"><hr><h4>İmza Atacaklar Listesi</h4><hr><div class="form-group col-sm-12">
                  <?php 
                  $imza= explode(";",$imza);
                    foreach($yonetim as $yonInd=>$yonVal){
                        if(in_array($yonVal["isim"], $imza)){
                            $checkedImza='checked="checked"';
                        }else{
                            $checkedImza="";
                        }
                        echo '<div class="checkbox-inline">
                            <input class="imzaelement" type="checkbox" name="imza[]" value="'.$yonVal["isim"].'" '.$checkedImza.'>'.$yonVal["isim"].'
                            </div>';
                    }
                  
                  ?> <input type="button" id="checkimza" value="Tümünü Seç" />
                  </div>
               </td>
          </tr>
          <tr>   
               <td  valign="bottom">
                  <div id="imza-list" class="form-group col-sm-12"></div>
               </td>
              
          </tr>
     
          <tr>
              <td colspan="4">
                <div class="form-group col-lg-12">
                   <?=$frm["defter_id"]?>
                   <button type="submit" class="btn btn-primary">Kaydet</button>
                </div>
              </td>
          </tr>
        </table>
    </form>
</div>

 <script>
    $('.textarea').wysihtml5({
        "font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
        "emphasis": true, //Italics, bold, etc. Default true
        "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
        "html": false, //Button which allows you to edit the generated HTML. Default false
        "link": false, //Button to insert a link. Default true
        "image": false, //Button to insert an image. Default true,
        "color": false, //Button to change color of font  
        "blockquote": false, //Blockquote
    });
</script>
	


			
		

