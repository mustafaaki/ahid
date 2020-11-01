<div class="container-fluid">
<div class="alert alert-success" style="display: none;"></div>
<form id="searchForm" method="GET" action="<?=base_url("defter/liste/")?>" name="searchForm" >
        <table style="width:860px;">
          <tr>
            <td colspan="4"><div class="form-group col-lg-8"><h3>Alınan kararlar listesi</h3>
            <?php 
            if($error!=""){
                echo '<div class="alert alert-danger"><h5>'.$error.'</h5></div>';
            }
            ?>
            </div></td>
          </tr>
          <tr>
              <td colspan="2"  valign="bottom" width="600"> 
                 
                  <div class="form-group col-lg-2"><label for="tcno" class="form-control-label">No</label>
                  <input type="text" name="no" class="form-control" value="" >
                  
                  
                  </div>
                  
                   <div class="form-group col-lg-6"><label for="tcno" class="form-control-label">Konuda Ara</label>
                  <input type="text" name="key" class="form-control" value="" >
                  
                  
                  </div>
                   <div class="form-group col-lg-4"><?php if($userInfo["type"]==1 or $userInfo["type"]==3){ ?>
                   <label for="tcno" class="form-control-label">Şubede Ara</label>
                    <?php  echo $subeler;
                            }
                     ?>
                  
                   </div>
              </td>
              <td colspan="1" valign="bottom"><label for="tcno" class="form-control-label">Tarih Aralığı Seç*</label>
              <div class="input-group input-daterange form-group col-lg-12">
              
                    <input type="text" class="form-control" value="" name="tarihs">
                    <div class="input-group-addon">to</div>
                    <input type="text" class="form-control" value="" name="tarihe">
                </div>
              
              </td>
              <td colspan="1" valign="bottom">
            
                <div class="form-group col-lg-12">
                   
                   <button type="submit" class="btn btn-primary">Ara</button>
                </div>
              </td>
             
          </tr>
          
        
       </table>
 </form>

<table class = "table table-bordered" style="min-width: 840px">
<caption>Toplam <?=$countRow?> karar görüntüleniyor.</caption>
  <thead class="thead-inverse">
        <th>No</th>
       <th>Tarih</th>
      <th>Konu</th>
      <th>Şube</th>
      <th>Düzenleyen</th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  
        <?php 
        
        foreach ($def as $defInd=>$val){
            echo "<tr>".
                   "<td>".$val["no"]."</td>".
                   "<td>".date_formatchange("d-m-Y",$val["tarih"])."</td>".
                   "<td>".substr($val["konu"],0,60)."</td>".
                   "<td>".substr($val["sube_ad"],0,40)."</td>".
                   "<td>".$val["username"]."</td>";
                   echo '<td><a target="_blank" href="'.base_url('defter/print_word/'.$val["defter_id"]).'"><i class="fa fa-file-word-o fa-lg" aria-hidden="true"></i></td>';
            
                    echo "<td>";
                    if(($userInfo["type"]==1 ) or ($userInfo["type"]==2 and  $userInfo["sube_id"]==$val["sube_id"]))
                      echo '<a href="'.base_url('defter/create/'.$val["defter_id"]).'"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>';
                    echo "</td>";
                    
                      echo '<td><a target="_blank" href="'.base_url('defter/print_view/'.$val["defter_id"]).'"><i class="fa fa-search fa-lg" aria-hidden="true"></i></a></td>';

                      echo "<td>";
                    if(($userInfo["type"]==1 ) or ($userInfo["type"]==2 and  $userInfo["sube_id"]==$val["sube_id"]))
                      echo '<a  href="'.base_url('defter/delete/'.$val["defter_id"]).'"><i class="fa fa-close fa-lg" aria-hidden="true"></i></a>';
                      echo "</td>";
                   "</tr>";
                   
        }
        
        ?>
  </tbody>
  </table>
  <?=$pagination?>
  </div>