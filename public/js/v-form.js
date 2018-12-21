$.fn.vf = function(options){
	var defaults = {
		Error : 'This field is required',
		InvalidError : 'Enter Valid value',
		InvalidEmail : 'Enter valid email Id',
		InvalidPhone : 'Enter valid phone number',
		FormProcessing : 'Processing...',
		KeyupValidate : false,
		errorShow : true,
		errorList : {},
		onValid : function(){}
	}
	
	
	var FormV = {};
	var formKey = randomString(9);
	$(this).attr('validationkey',formKey);
	var FormsToValidate = "form[validationkey="+ formKey +"]";
	FormV.setting = $.extend({}, defaults, options);
	if(FormV.setting){
		$(document).on("submit",FormsToValidate,function(e){
			e.preventDefault();
			ce='';
			v='';
			fe='';
			ef=false;
			/*fv = "#" + $(this).attr('id');
			if(fv == '#' || fv == '#undefined'){
				fv = "." + $(this).attr('class');
			}
			if(fv == '.'){
				fv = e.target.nodeName;
			}*/
			$(".vf-error").remove();
			$(".vf-invalid").removeClass("vf-invalid");
			$(".vf-valid").removeClass("vf-valid");
			$(this).find("input.vf-required, select.vf-required, textarea.vf-required").each(function(input){
				v=$(this).val(); // getting input value				
				ce=$(this); // getting current selector
				er=false;
				et = ce[0].type;
				if(et == "checkbox" || et == "radio"){
					var i =0;
					var en = $(this)[0].name; // Element Name
					var rc =  $("input[name='"+ en +"']"); // Radios and Checkboxs
					var rce = true; // Radio Checkbox Error
					while(rce && i < rc.length){
						if(rc[i].checked){
							rce = false;
						}
						i++; 
					}
					er = rce;
					if(rce){
						if(FormV.setting.errorShow){
							errKey=ce.attr('name');
							if(errKey in FormV.setting.errorList){
								addError(ce,FormV.setting.errorList[errKey]);
							}else{
								addError(ce,FormV.setting.Error);
							}
						}
						if(!fe){fe= $(this);}
					}
				}else{
					var mn = ce.attr('vf-min');
					if (typeof mn !== typeof undefined && mn !== false) {
						mn=parseInt(mn);
					}else{
						mn=0;
					}
					
					var mx = ce.attr('vf-max');
					if (typeof mx !== typeof undefined && mx !== false) {
						mx=parseInt(mx);
					}else{
						mx=0;
					}

					var mtw=ce.attr('vf-match');
					if (typeof mtw !== typeof undefined && mtw !== false && mtw != '' && ( $('.' + mtw).val()!= '')){
						mt=true;
						mter=ce.attr('vf-match-error');
						if ((typeof mter !== typeof undefined && mter !== false ) || mter == ''){
							mter=mter;
						}else{
							mter='Values should match.';
						}
					}else{
						mt=false;
					}

					if(!v){
						if(FormV.setting.errorShow){
							errKey=ce.attr('name');
							if(errKey in FormV.setting.errorList){
								addError(ce,FormV.setting.errorList[errKey]);
							}else{
								addError(ce,FormV.setting.Error);
							}
						}
						er=true; 
						if(!fe){fe= $(this);} // setting element to focus
					}else if(($(this).hasClass("vf-phone")) && (!pv(v,$(this)))){
						if(FormV.setting.errorShow){
							addError(ce,FormV.setting.InvalidPhone);
						}
						er=true;
						if(!fe){fe= $(this);} // setting element to focus
					}else if(($(this).hasClass("vf-email")) && (!ev(v))){
						if(FormV.setting.errorShow){
							addError(ce,FormV.setting.InvalidEmail);
						}
						er=true;
						if(!fe){fe= $(this);} // setting element to focus
					}else if(mt){
						if(v != $('.' + mtw).val()){
							if(FormV.setting.errorShow){
								addError(ce,mter);
							}
							er=true;
							if(!fe){fe= $(this);} // setting element to focus					
						}
					}else if(mn && mx){
						if(v.length < mn ||  v.length > mx ){
							if(FormV.setting.errorShow){
								addError(ce,FormV.setting.InvalidError + ' (' + mn + '-' + mx + ' charactors)');
							}
							er=true;
							if(!fe){fe= $(this);} // setting element to focus
						}
					}else if(mn){
						if(v.length < mn ){
							if(FormV.setting.errorShow){
								addError(ce,FormV.setting.InvalidError + ' (' + mn + ' charactors)');
							}
							er=true;
							if(!fe){fe= $(this);} // setting element to focus
						}				
					}else if(mx){
						if(v.length > mx ){
							if(FormV.setting.errorShow){
								addError(ce,FormV.setting.InvalidError + ' (0-' + mx + ' charactors)');
							}
							er=true;
							if(!fe){fe= $(this);} // setting element to focus
						}				
					}
				}
				if(er){
					ef = true;
					ce.parents(".error-heading").children('label:not(.btn)').addClass('vf-invalid');
					ce.parents(".error-heading").addClass('vf-invalid');
					ce.addClass('vf-invalid');
					fe.focus();
				}else{
					ce.parents(".error-heading").children('label').addClass('vf-valid');
					ce.parents(".error-heading").addClass('vf-valid');
					ce.addClass('vf-valid');
				}
			});
			if(ef){
				return false;
			}else{
				FormV.setting.onValid.call(this);
				return true;
			}
		});
}
/* Appends an error to document */
function addError(cEl,err){
	cEl.siblings("label:first-child").after('<span class="vf-error">'+ err +'</span>');
}
/* EMAIL VALIDATOR START */
function ev(em) {
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(em);
}
/* EMAIL VALIDATOR END */
/* PHONE NUMBER VALIDATOR START */
function pv(ph,obj){
	var pmn = obj.attr('vf-min');
	if (typeof pmn !== typeof undefined && pmn !== false) {
		pmn=parseInt(pmn);
	}else{
		pmn=0;
	}
	var pmx = obj.attr('vf-max');
	if (typeof pmx !== typeof undefined && pmx !== false) {
		pmx=parseInt(pmx);
	}else{
		pmx=999;
	}
	if(($.isNumeric(ph)) && (ph.length >= pmn ) && (ph.length <= pmx) ) {return true;}
	else {return false;}
}
/* PHONE NUMBER VALIDATOR END */
}

function randomString(length) {
	return Math.round((Math.pow(36, length + 1) - Math.random() * Math.pow(36, length))).toString(36).slice(1);
}