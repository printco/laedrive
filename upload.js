function _(e) {
    return document.getElementById(e);
}
function uploadFileHandler() {
    var file = _("uploadingfile").files[0];
	if( file == undefined  ){
		_("status").innerHTML = "<div>Please select file<div>";
		return false;
	}
    var formdata = new FormData();
    formdata.append("uploadingfile", file);
    var ajax = new XMLHttpRequest();
    ajax.upload.addEventListener("progress", progressHandler, false);
    ajax.addEventListener("load", completeHandler, false);
    ajax.addEventListener("error", errorHandler, false);
    ajax.addEventListener("abort", abortHandler, false);
    ajax.open("POST", "upload.php", true);
    ajax.send(formdata);
	return false;
}
function progressHandler(event) {
    var loaded = new Number((event.loaded / 1048576));//Make loaded a "number" and divide bytes to get Megabytes
    var total = new Number((event.total / 1048576));//Make total file size a "number" and divide bytes to get Megabytes
    _("uploaded_progress").innerHTML = "Uploaded " + loaded.toPrecision(5) + " Megabytes of " + total.toPrecision(5);//String output
    var percent = (event.loaded / event.total) * 100;//Get percentage of upload progress
    _("progressBar").value = Math.round(percent);//Round value to solid
    _("status").innerHTML = Math.round(percent) + "% uploaded";//String output
}
function completeHandler(event) {
    _("status").innerHTML = event.target.responseText;//Build and show response text
    //_("progressBar").value = 0;//Set progress bar to 0
    //document.getElementById('progressDiv').style.display = 'none';//Hide progress bar
	list();
}
function errorHandler(event) {
    _("status").innerHTML = "Upload Failed";//Switch status to upload failed
}
function abortHandler(event) {
    _("status").innerHTML = "Upload Aborted";//Switch status to aborted
}

function list(){
	$.ajax({
		url: "list.php",
		success: function(li){
			$("#filelist").html(li);
		}
	});
}