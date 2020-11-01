<div class="container-fluid">
<div class="alert alert-success" style="display: none;"></div>
<form id="searchForm" method="GET" action="<?=base_url("searchlist/".$searchPage)?>" name="searchForm" >
        <table style="width:860px;">
          <tr>
            <td colspan="4"><div class="form-group col-lg-8"><h3>TC,ÜYE NO,AD,SOYAD arama formu</h3>
            <?php if($error!=""){
            echo '<div class="alert alert-warning"><h5>'.$error.'</h5></div>';
            }
            ?>
            </div></td>
          </tr>
          <tr>
              <td colspan="3"  valign="bottom"> 
                    <?php if($searchPage=="tumsubeuyeleri"){?>
                  <div class="form-group col-lg-8"><label for="key" class="form-control-label">Anahtar Kelime,Numara*</label>
                  <?php }else if($searchPage=="tumu"){?>
                  <div class="form-group col-lg-12"><label for="key" class="form-control-label">Anahtar Kelime,Numara*</label>
                  <?php }?>
                  <input type="text" name="key" class="form-control" value="" ></div>
                  <?php if($searchPage=="tumsubeuyeleri"){?>
                  <div class="form-group col-lg-4">
                  <label for="key" class="form-control-label">Aranacak Şube</label>
                  <?=$subeler?></div>
                  <?php }?>
                  
              </td>
              <td colspan="1" valign="bottom">
                <div class="form-group col-lg-4">
                   
                   <button type="submit" class="btn btn-primary">Ara</button>
                </div>
              </td>
              
             
          </tr>
       </table>
 </form>

<table class = "table table-bordered" style="min-width: 840px">
<caption>Toplam <?=$all_row?> üye görüntüleniyor.</caption>
  <thead class="thead-inverse">
    <tr>
      <?php 
        foreach($result[0] as $g=>$gg){
            $count++;
            if($shortHeader[$g]){
                echo '<th>'.$shortHeader[$g].'</th>';
            }else{
                echo '<th>'.$g.'</th>';
            }
        }
      ?>
      <th></th>
      <th></th>
      <th></th>
     
    </tr>
  </thead>
  <tbody>
  <?php 
  
  foreach($result as $i=>$v){
      echo "<tr>";
       foreach($v as $h=>$text){
           if($h=="sube_ad"){
               $text =substr($text, 0,5);
           }
           echo "<td>".$text."</td>";
           
        } 
        
        echo '<td><a title="İncele & Yazdır" target="_blank" href="'.base_url('searchlist/print_page/'.$v["tc"]).'"><i class="fa fa-search fa-lg" aria-hidden="true"></i></a></td>';
        echo "<td>";
        if(($v["sube_id"]==$userInfo["sube_id"] or $userInfo["type"]==1) and ($userInfo["type"]!=3))
            echo '<a title="Düzenle" href="'.base_url('members/create/'.$v["tc"]).'"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>';
        echo "</td>";
        echo "<td>";
        if(($v["sube_id"]==$userInfo["sube_id"] and $userInfo["type"]==2 ) or ($userInfo["type"]==1))
            echo '<a title="Sil" href="'.base_url('members/delete/'.$v["uye_id"].'/'.$lastPage.'/'.($pageStart-1)).'"><i class="fa fa-close fa-lg" aria-hidden="true"></i></a>';
        echo "</td>";
      echo "</tr>";
  }
  
  
  ?>
  
  </tbody>
  </table>
  <?=$pagination?>
  </div>