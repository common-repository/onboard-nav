function copy_nav(element_id){
	
	var aux = document.createElement("div");
	aux.setAttribute("contentEditable", true);
	aux.innerHTML = document.getElementById(element_id).innerHTML;
	aux.setAttribute("onfocus", "document.execCommand('selectAll',false,null)"); 
	document.body.appendChild(aux);
	aux.focus();
	document.execCommand("copy");
	document.body.removeChild(aux);
	//var link = document.createElement("a");
	document.getElementById('copybtn').innerHTML ='Copied';
	return false;

}
jQuery(function(){
	
	if(jQuery('#report_widget').prop('checked')) {
		jQuery("div.hideControl").show("slow");
		jQuery("#widget_text").attr("disabled",false);
	}else{
		jQuery("div.hideControl").hide("slow");
		jQuery("#widget_text").attr("disabled",true);
	}
	
	jQuery('#report_widget').click(function(){
		
		if(jQuery(this).prop('checked')==true){
			jQuery("div.hideControl").show("slow");
			jQuery("#widget_text").attr("disabled",false);
		} else {
			jQuery("div.hideControl").hide("slow");
			jQuery("#widget_text").attr("disabled",true);
		}	
		
	});
	
});
