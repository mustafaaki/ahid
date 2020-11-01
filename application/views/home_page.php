<div class="container-fluid">
<div class="alert alert-success" style="display: none;"></div>
<table style="min-width:860px;">
          <tr>
                <td>
                    <div class="form-group col-lg-12">
                        <h3><?=$frm["header"]?></h3>
                        <h5><?=$frm['error']?></h5>
                    </div>
                </td>
          </tr>
</table>
<a class="blockLink" href="<?=base_url("members/create")?>"><i class="hidden-xs glyphicon glyphicon-credit-card  fa-5x" aria-hidden="true"></i><br>YENİ ÜYE GİRİŞİ</a>
<a class="blockLink" href="<?=base_url("searchlist/tumu")?>"><i class="hidden-xs fa fa-list fa-5x" aria-hidden="true"></i><br>ÜYE LİSTESİ</a>
<a class="blockLink" href="<?=base_url("members/search")?>"><i class="hidden-xs fa fa-search fa-5x" aria-hidden="true"></i><br>ÜYE ARAMA</a><br>
<a class="blockLink" href="<?=base_url("defter/liste")?>"><i class="hidden-xs fa fa-book fa-5x" aria-hidden="true"></i><br>ALINAN KARARLAR</a>
<a class="blockLink" href="<?=base_url("defter/create")?>"><i class="hidden-xs fa fa-pencil-square-o fa-5x" aria-hidden="true"></i><br>YENİ KARAR</a>
<a class="blockLink" href="<?=base_url("defter/create")?>"><i class="hidden-xs glyphicon glyphicon-tower fa-5x" aria-hidden="true"></i><br>YÖNETİCİ LİSTESİ</a>

</div>

<style>
.blockLink{
	display:inline-block;
	width: 170px;
	text-align: center;
	font-weight:bold;
	margin:45px;
	color:#777;
}
 .blockLink:hover{color:#333;text-decoration: none; }

</style>