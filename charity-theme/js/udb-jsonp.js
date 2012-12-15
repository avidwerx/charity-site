var udb_objects = new Array();
var udb_types = new Array();
var udb_urls = new Array();
var udb_ids = new Array();
var udb_idx = 0;
/*var udb_baseurl = (function() {
	var re = new RegExp('js/udb-jsonp(\.min)?\.js.*'),
	scripts = document.getElementsByTagName('script');
	for (var i = 0, ii = scripts.length; i < ii; i++) {
		var path = scripts[i].getAttribute('src');
		if(re.test(path)) return path.replace(re, '');
	}
})();*/
var udb_baseurl = "http://avidwerx.com/charity/donation-box/";

jQuery(document).ready(function() {
	var udb_boxes = jQuery("div.udb-box");
	jQuery.each(udb_boxes, function() {
		var rel = jQuery(this).attr("data-rel");
		udb_types[udb_idx] = rel;
		var url = jQuery(this).attr("data-url");
		udb_urls[udb_idx] = url;
		var id = jQuery(this).attr("data-id");
		udb_ids[udb_idx] = id;
		udb_objects[udb_idx] = this;
		udb_idx++;
	});
	if (udb_idx > 0) udb_getbox(0);
});

function udb_getbox(idx) {
	var action = udb_baseurl + "ajax.php";
	jQuery.ajax({
		url: action, 
		data: {
			udb_rel: udb_types[idx],
			udb_url: udb_urls[idx],
			udb_id: udb_ids[idx],
			action: "udb_getbox"
		},
		dataType: "jsonp",
		success: function(data) {
			var html_data = data.html;
			if(html_data.match("udb_container") != null) {
				jQuery(udb_objects[idx]).css("display", "none");
				jQuery(udb_objects[idx]).append(html_data);
				jQuery(udb_objects[idx]).slideDown(600);
			}
			if (idx+1 < udb_idx) {
				udb_getbox(idx+1);
			}
		}
	});
}

var udb_suffix = "";
var udb_busy = false;
function udb_clickhandler(suffix, active_method, return_url) {
	if (udb_busy == true) return;
	udb_busy = true;
	udb_suffix = suffix;
	jQuery("#submit"+suffix).attr("disabled","disabled").after("<im"+"g src='"+udb_baseurl+"img/ajax-loader.gif' class='udb_loader' width='16' height='16'/>");
	jQuery("#message"+suffix).slideUp("slow");
	var method = active_method;
	if (jQuery("#method_paypal_"+suffix).attr("checked")) method = "paypal";
	else if (jQuery("#method_payza_"+suffix).attr("checked")) method = "payza";
	else if (jQuery("#method_interkassa_"+suffix).attr("checked")) method = "interkassa";
	else if (jQuery("#method_authnet_"+suffix).attr("checked")) method = "authnet";
	else if (jQuery("#method_egopay_"+suffix).attr("checked")) method = "egopay";
	else if (jQuery("#method_liberty_"+suffix).attr("checked")) method = "liberty";
	else if (jQuery("#method_skrill_"+suffix).attr("checked")) method = "skrill";
	else if (jQuery("#method_paysius_"+suffix).attr("checked")) method = "paysius";
	jQuery.ajax({
		url: udb_baseurl+"ajax.php", 
		data: {
			udb_name: jQuery("#name"+suffix).val(),
			udb_email: jQuery("#email"+suffix).val(),
			udb_url: jQuery("#url"+suffix).val(),
			udb_amount: jQuery("#amount"+suffix).val(),
			udb_id: jQuery("#campaign"+suffix).val(),
			udb_method: method,
			udb_suffix: suffix,
			udb_return: return_url,
			action: "udb_submit"
		},
		dataType: "jsonp",
		success: function(data) {
			var html_data = data.html;
			jQuery("#udb"+udb_suffix+" img.udb_loader").fadeOut("fast",function(){jQuery(this).remove()});
			jQuery("#submit"+udb_suffix).removeAttr("disabled");
			if(html_data.match("udb_confirmation_info") != null) {
				jQuery("#udb_signup_form"+udb_suffix).fadeOut(500, function() {
					jQuery("#udb_confirmation_container"+udb_suffix).html(html_data);
					jQuery("#udb_confirmation_container"+udb_suffix).fadeIn(500, function() {});
				});
			} else {
				jQuery("#message"+udb_suffix).html(html_data);
				jQuery("#message"+udb_suffix).slideDown("slow");
			}
			udb_busy = false;
		}
	});
}
function udb_edit(suffix) {
	if (udb_busy == true) return;
	udb_suffix = suffix;
	jQuery("#udb_confirmation_container"+udb_suffix).fadeOut(500, function() {
		jQuery("#udb_signup_form"+udb_suffix).fadeIn(500, function() {});
	});
}
function udb_getbitcoinaddress(donor_id, suffix) {
	if (udb_busy == true) return;
	udb_busy = true;
	udb_suffix = suffix;
	jQuery("#udb_getlink"+suffix).attr("disabled","disabled");
	jQuery("#udb_getlink_edit"+suffix).attr("disabled","disabled").after("<im"+"g src='"+udb_baseurl+"img/ajax-loader.gif' class='udb_loader' width='16' height='16'/>");
	jQuery.ajax({
		url: udb_baseurl+"ajax.php", 
		data: {
			udb_id: donor_id,
			udb_suffix: suffix,
			action: "udb_getbitcoinaddress"
		},
		dataType: "jsonp",
		success: function(data) {
			var html_data = data.html;
			jQuery("#udb"+udb_suffix+" img.udb_loader").fadeOut("fast",function(){jQuery(this).remove()});
			jQuery("#udb_getlink"+udb_suffix).removeAttr("disabled");
			jQuery("#udb_getlink_edit"+udb_suffix).removeAttr("disabled");
			if(html_data.match("udb_confirmation_info") != null) {
				jQuery("#udb_confirmation_container"+udb_suffix).fadeOut(500, function() {
					jQuery("#udb_confirmation_container"+udb_suffix).html(html_data);
					jQuery("#udb_confirmation_container"+udb_suffix).fadeIn(500, function() {});
				});
			}
			udb_busy = false;
		}
	});
}