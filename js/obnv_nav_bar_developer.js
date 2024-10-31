jQuery(document).ready(function($){

	$('#publishNav').click(function(){
		var nav_address1 = $('#navbar_address1').val();
		var nav_address2 = $('#navbar_address2').val();
		var navbar_zip = $('#navbar_zip').val();
		var navbar_script = $('#navbar_script').val();

		var error = 0;
		
		if(nav_address1 == ""){
			$('#navbar_address1_err').text('This field is required');
			error++;
		}else if(nav_address1 !== ''){
			$('#navbar_address1_err').text('');
		}
		
		if(nav_address2 == ""){
			$('#navbar_address2_err').text('This field is required');
			error++;
		}else if(nav_address2 !== ''){
			$('#navbar_address2_err').text('');
		}
		
		if(navbar_zip == ""){
			$('#navbar_zip_err').text('This field is required');
			error++;
		}else if(navbar_zip !== ''){
			$('#navbar_zip_err').text('');
		}
		
		if(navbar_script == ""){
			$('#navbar_script_error').text('This field is required');
			error++;
		}else if(navbar_script !== ''){
			$('#navbar_script_error').text('');
		}
		
		if(error > 0){
			return false;
		}else{
			return true;
		}
		
	});

});
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