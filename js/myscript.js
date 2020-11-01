/*date picker start*/
$(function(){
		window.prettyPrint && prettyPrint();
		$('#date_picker').datepicker({
			format: 'dd-mm-yyyy',
            todayBtn: 'linked',
            language: 'tr'
		});
});
/*date picker end*/

/*popup acma kapama butonlarini tetikler */
$('.popupOpener').click(function() {	
	$(".popup").show(500);	
	funcName = $(this).attr("func");
	unique = $(this).attr("unique-data");
	
	var fn = window[funcName](unique);// return degeri varsa fn ye atar ve fonksiyonu cagirir.
});

$('.popupCloser').click(function() {
	$(this).parent().hide(500);
});


/*pop up acma kapama sonu*/
$(document).ready(function() {
		
	/* select box ile gelen tipler il - ilce - semt - mahalle 
	 * html select id yapisi  secim için id="belirtecadi_tip for_getirilecetip"
	 * ör= id="dogum_il for_mahalle" il seçildikten sonra sırası ile il ilçe semt mahalle listeler
	 * select boxların ekran görüntülerinin basılacağı yapı id="belirtecadi_tip_container"
	 * ör: id="dogum_ilce_container"  içine  id="dogum_il for_mahalle" select yapısından gelen
	 * veri basılır.  
	 * */
	/*select destination degisiklik dinleme start*/
    $('body').on('change','select',function(){
    	
    	frmObject="";
    	frmObjectContent="";
    	selectOptionContent="";
    	destinationData={};
    	frmObject =$(this).attr('id');
    	frmObject=frmObject.split(" ");
    	frmObjectType = frmObject[0].split("_");
    	
    	if(frmObject[1]=="for_semtmahalle"){
	    	if(frmObjectType[1]=="il"){
	    		if(frmObject[1]=="for_il" || frmObject[1]==null){
	    			return false;
	    		}else{
	    			forSelect=" " + frmObject[1];
	    			selectSubName="ilce";
	    			$("#" + frmObjectType[0]+ "_ilce_container").html('');
	    			$("#" + frmObjectType[0]+ "_semtmahalle_container").html('');
	    		}
	    		urlval=base_url + "ajaxdestination/selectilce";
	    	}else if(frmObjectType[1]=="ilce"){
	    		
	    		if(frmObject[1]=="for_ilce" || frmObject[1]==null){	
	    			return false;
	    		}else{
	    			forSelect=" " + frmObject[1];
	    			selectSubName="semtmahalle";
	    			$("#" + frmObjectType[0]+ "_semtmahalle_container").html('');
	    		}
	    		urlval= base_url + "ajaxdestination/selectsemtmahalle";
	    	}else if(frmObjectType[1]=="semtmahalle"){
	    		if(frmObject[1]=="for_semtmahalle" || frmObject[1]==null){	return false;}
	    	}
    	}else{
    		if(frmObjectType[1]=="il"){
        		if(frmObject[1]=="for_il" || frmObject[1]==null){return false;
        		}else{
        			forSelect=" " + frmObject[1];
        			selectSubName="ilce";
        			$("#" + frmObjectType[0]+ "_ilce_container").html('');
        			$("#" + frmObjectType[0]+ "_semt_container").html('');
        			$("#" + frmObjectType[0]+ "_mahalle_container").html('');
        		}
        		urlval=base_url + "ajaxdestination/selectilce";
        	}else if(frmObjectType[1]=="ilce"){
        		if(frmObject[1]=="for_ilce" || frmObject[1]==null){	return false;
        		}else{
        			forSelect=" " + frmObject[1];
        			selectSubName="semt";
        			$("#" + frmObjectType[0]+ "_mahalle_container").html('');
        			$("#" + frmObjectType[0]+ "_semt_container").html('');
        		}
        		urlval= base_url + "ajaxdestination/selectsemt";
        	}else if(frmObjectType[1]=="semt"){
        		if(frmObject[1]=="for_semt" || frmObject[1]==null){	return false;
        		}else{
        			forSelect=" " + frmObject[1];
        			selectSubName="mahalle";
        		}
        		urlval= base_url + "ajaxdestination/selectmahalle";
        	}else if(frmObjectType[1]=="mahalle"){
        		if(frmObject[1]=="for_mahalle" || frmObject[1]==null){return false;}	
        	}
    		
    	}
    		
		destinationData={ "id" : $(this).val()};
		selectPrintId='#'+ frmObjectType[0] +"_" + selectSubName + "_" + "container";
    	
    	$.ajax({
    	    type: "POST",
    	    url : urlval,
    	    cache: true,
    	    data :  destinationData,
    	    dataType: 'json',
    	    success: function(data){
    	    	selectOptionContent='<option value="">Lütfen '+ selectSubName +' seçiniz.</option>'; 
    	    	
    	    	$.each(data, function(index, element) {
    	    		if(frmObject[1]=="for_semtmahalle" && frmObjectType[1]=="ilce" ){
    	    			
    	    			selectOptionContent = selectOptionContent + '<option value="' + element["semtId"]+ "-" + element["mahalleId"] + '">' + element["mahalleAd"] + "("+element["semtAd"] + ")" + '</option>';
    	    		}else{
    	    			selectOptionContent = selectOptionContent + '<option value="' + element["id"]+ '">' + element["ad"] +'</option>';
    	    		}
    	        });
    	    	$(selectPrintId).html($('<select class="form-control  selectpicker" data-show-subtext="true" data-live-search="true"  name="'+ frmObjectType[0]+'_'+selectSubName+'" id="'+ frmObjectType[0]+'_'+selectSubName + forSelect +'">'+ selectOptionContent+'</select>'));
    	    	$('.selectpicker').selectpicker('refresh');
    	     } 
    	});
    			
    });
    /**select destination end*/
    
    var timerId;
    /*defter uye olmayan cagirma*/
    $('#uye_olmayan').bind('keyup',function(){
    	
    	this.value = this.value.replace(/[^0-9\.]/g,'');
    	if(parseInt(this.value)>998){
    		this.value=998;
    	}
    	urlval=base_url + "ajaxdefter/uye_olmayan";
    	member = { "limit" : $('#uye_olmayan').val() };

    	$("#uye-olmayan-list").html('');
    	
    	$.ajax({
    	    type: "POST",
    	    url : urlval,
    	    cache: false,
    	    data :  member,
    	    dataType: 'json',
    	    success: function(data){
    	    	selectListMember="";
    	    	$.each(data, function(index,element ) {	  	    		
    	           selectListMember = selectListMember + '<div class="checkbox-inline" ><input name="uye_id[]" type="checkbox" value="' + element["uye_id"] + '" checked>' + element["ad"] + " " + element["soyad"] + ',</div>';
    	        });
    	    	$("#uye-olmayan-list").html(selectListMember);
    	    	data="";/*sakin silme cok sacma bir hata onceki verinin ustune ekliyor*/
    	     } 
    	});
    }); 
    /*defter uye olmayan cagirma sonu*/
    
    /*defter uye olmayan formunda form guncellemede kaydedilmişleri cagirma*/
    $('#call_defter_uye').on('click',function(){
    	$('#uye_olmayan').val( "");
    	defter_id= $('input[name="defter_id"]').val();
    	urlval=base_url + "ajaxdefter/update_uye_olmayan";
    	
    	member = { "defter_id" : defter_id };
    	selectListMember="";
    
    	$.ajax({
    	    type: "POST",
    	    url : urlval,
    	    cache: true,
    	    data :  member,
    	    dataType: 'json',
    	    success: function(data){
    	    	$.each(data, function(index,element ) {	
    	           selectListMember = selectListMember + '<div class="checkbox-inline" ><input name="uye_id[]" type="checkbox" value="' + element["uye_id"] + '" checked>' + element["ad"] + " " + element["soyad"] + ',</div>';
    	        });
    	    	$("#uye-olmayan-list").html(selectListMember);
    	     } 
    	});
    	
    });
    /*defter uye olmayan formunda form guncellemede kaydedilmişleri cagirma  sonu*/
    
    $("#checkaza").click(function(){
    	azaelement = document.getElementsByClassName("azaelement");
    	if($(this).val()=="Tümünü Bırak"){
    		azaValue=false;
    		$(this).val("Tümünü Seç");
    	}else if($(this).val()=="Tümünü Seç"){
    		azaValue=true;
    		$(this).val("Tümünü Bırak");
    	}
    	for(var i = 0, l = azaelement.length; i < l; ++i) {
    		azaelement[i].checked = azaValue;    	   
    	}
    });
    
    $("#checkimza").click(function(){
    	imzaelement = document.getElementsByClassName("imzaelement");
    	if($(this).val()=="Tümünü Bırak"){
    		imzaValue=false;
    		$(this).val("Tümünü Seç");
    	}else if($(this).val()=="Tümünü Seç"){
    		imzaValue=true;
    		$(this).val("Tümünü Bırak");
    	}
    	for(var i = 0, l = imzaelement.length; i < l; ++i) {
    		imzaelement[i].checked = imzaValue;    	   
    	}
    });
    
	$("#togglecheckbox").click(function(){
	  /*  var checkBox = $("input[name^=show]");
	    if($(this).val()!="Tümünü Bırak"){
	    $(this).val("Tümünü Bırak");
	    }else{
	    	$(this).val("Tümünü Seç");
	    }
	    
	    checkBox.trigger('click');
	    */
	    
	   secelement = document.getElementsByName("show[]");
    	if($(this).val()=="Tümünü Bırak"){
    		elementValue=false;
    		$(this).val("Tümünü Seç");
    	}else if($(this).val()=="Tümünü Seç"){
    		elementValue=true;
    		$(this).val("Tümünü Bırak");
    	}
    	for(var i = 0, l = secelement.length; i < l; ++i) {
    		secelement[i].checked = elementValue;    	   
    	}
	});
    
	$("#yonetim_sube_change").change(function(){
    	window.location.replace(base_url + "yonetim/create?sube_id="+$(this).val());
    });    
});

$('#listTable').DataTable({	
	    "responsive": true,
    	"language": {
            "lengthMenu": "1 sayfada _MENU_ adet içerik göster.",
            "zeroRecords": "Üzgünüz Kayıt Bulunamadı",
            "info": "_PAGES_ sayfada _PAGE_ . sayfa gösteriliyor ",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "next": "Sonraki",
            "search": "Tüm Sonuç Sayfalarında Ara:",
            "paginate": {
                "previous": "Önceki Sayfa",
                "next": "Sonraki Sayfa"
              }	            
        },
        "order": [[ 1, "asc" ]],
        "columnDefs": [
                     {
                         targets: [ 0, 1, 2 ],
                         className: 'mdl-data-table__cell--non-numeric'
                     }
                 ],
        "aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
        columnDefs: [
                     { width: '20%', targets: 0 }
                 ],
                 fixedColumns: true,
        buttons: ['copy', 'excel', 'pdf']
   } );



function call_member(id){
	urlval=base_url + "ajaxcall/call_member";
	
	$.ajax({
	    type: "POST",
	    url : urlval,
	    cache: true,
	    data :  "id="+id,
	    dataType: 'json',
	    success: function(data){
	    	
	    	printVal='';
	    	$.each(data, function(index,element ) {	
	    		//if(element!="" && element!=null){
	    		printVal+='<div class="member_info_list"><label>'+ index+ '</label>'+element+'</div>' ;
	    		//}
 	        });
	    	
	    	$(".popup div").html(printVal);
	    } 
	});
}

function call_yonetim(id){
	
	urlval=base_url + "ajaxcall/call_yonetim";
	$.ajax({
	    type: "POST",
	    url : urlval,
	    cache: true,
	    data :  "id="+id,
	    dataType: 'json',
	    success: function(data){
	    	printVal='';
	    	
	    	$.each(data, function(index,element ) {	
	    		//if(element!="" && element!=null){
	    		printVal+='<div class="member_info_list"><label>'+ index+ '</label>'+element+'</div>' ;
	    		//}
 	        });
	    	
	    	$(".popup div").html(printVal);
	    } 
	});
}
