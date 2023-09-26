$(document).ready(function(){
    //var random_folder_name = document.getElementById("ID_UNIQUE").value;
    if(action_sugar_grp1 == 'EditView'){
    	var module=document.EditView.elements['module'].value;
    }
    else if(action_sugar_grp1 == 'DetailView'){
    	var module=document.DetailView.elements['module'].value;
    }
	// else{
	// 	// var module=document.shared_cal.elements['module'].value;
	// 	alert(document.shared_cal);
	// }
	var documents_id = [];
	var documents_names = [];
	var documents_types = [];
	/* var module='MED_Media'; */
	/* var module_id=document.EditView.elements['record'].value;
	console.log(module_id); */
	setTimeout(function() {
        $("#filer_input2").filer({
		limit: null,
		maxSize: null,
		extensions: null,
		changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Drag&Drop files here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse Files</a></div></div>',
		showThumbs: true,
		theme: "dragdropbox",
		templates: {
			box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
			item: '<li class="jFiler-item">\
						<div class="jFiler-item-container">\
							<div class="jFiler-item-inner">\
								<div class="jFiler-item-thumb">\
									<div class="jFiler-item-status"></div>\
									<div class="jFiler-item-thumb-overlay">\
										<div class="jFiler-item-info">\
											<div style="display:table-cell;vertical-align: middle;">\
												<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
												<span class="jFiler-item-others">{{fi-size2}}</span>\
											</div>\
										</div>\
									</div>\
									{{fi-image}}\
								</div>\
								<div class="jFiler-item-assets jFiler-row">\
									<ul class="list-inline pull-left">\
										<li>{{fi-progressBar}}</li>\
									</ul>\
									<ul class="list-inline pull-right">\
										<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
									</ul>\
								</div>\
							</div>\
						</div>\
					</li>',
			itemAppend: '<li class="jFiler-item">\
							<div class="jFiler-item-container">\
								<div class="jFiler-item-inner">\
									<div class="jFiler-item-thumb">\
										<div class="jFiler-item-status"></div>\
										<div class="jFiler-item-thumb-overlay">\
											<div class="jFiler-item-info">\
												<div style="display:table-cell;vertical-align: middle;">\
													<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
													<span class="jFiler-item-others">{{fi-size2}}</span>\
												</div>\
											</div>\
										</div>\
										{{fi-image}}\
									</div>\
									<div class="jFiler-item-assets jFiler-row">\
										<ul class="list-inline pull-left">\
											<li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
										</ul>\
										<ul class="list-inline pull-right">\
											<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
										</ul>\
									</div>\
								</div>\
							</div>\
						</li>',
			progressBar: '<div class="bar"></div>',
			itemAppendToEnd: false,
			canvasImage: true,
			removeConfirmation: true,
			_selectors: {
				list: '.jFiler-items-list',
				item: '.jFiler-item',
				progressBar: '.bar',
				remove: '.jFiler-item-trash-action'
			}
		},
		dragDrop: {
			dragEnter: null,
			dragLeave: null,
			drop: null,
			dragContainer: null,
		},
		uploadFile: {
			url: 'index.php?entryPoint=AjaxFileUpload&module='+module,
			data: null,
			//data: {folders: random_folder_name},
			type: 'POST',
			enctype: 'multipart/form-data',
			synchron: true,
			beforeSend: function(){},
			success: function(data, itemEl, listEl, boxEl, newInputEl, inputEl, id){
				var parent = itemEl.find(".jFiler-jProgressBar").parent(),
					new_file_name = JSON.parse(data),
					filerKit = inputEl.prop("jFiler")
					console.log('new_file_name');
					console.log(new_file_name);
					documents_id.push(new_file_name.file_id);
					documents_names.push(new_file_name.file_name);
					documents_types.push(new_file_name.file_type);
					$("input[name='case_attachments_file_id[]']").val(documents_id);
					$("input[name='case_attachments_file_name[]']").val(documents_names);
					$("input[name='case_attachments_file_types[]']").val(documents_types);
					//SUGAR.ajaxUI.hideLoadingPanel();
					/* var module_id=document.EditView.elements['record'].value; */
					$("#note_attachment_preview").append('<tr><td id="'+new_file_name.file_id+'" style="padding-top: 20px;padding-right: 15px;">'+new_file_name.file_name+'</a><img src="themes/Suite7/images/2ndaryclose.png" style="width:12px; cursor:pointer; margin-left: 5px;" onclick="delete_attachment(\''+data+'\');"/></td></tr>');
        		   filerKit.files_list[id].name = new_file_name;
				itemEl.find(".jFiler-jProgressBar").fadeOut("slow", function(){
					$("<div class=\"jFiler-item-others text-success\"><i class=\"icon-jfi-check-circle\"></i> Success</div>").hide().appendTo(parent).fadeIn("slow");
				});
			},
			error: function(el){
				var parent = el.find(".jFiler-jProgressBar").parent();
				el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
					$("<div class=\"jFiler-item-others text-error\"><i class=\"icon-jfi-minus-circle\"></i> Error</div>").hide().appendTo(parent).fadeIn("slow");
				});
			},
			statusCode: null,
			onProgress: null,
			onComplete: null
		},
		files: null,
		addMore: false,
		allowDuplicates: true,
		clipBoardPaste: true,
		excludeName: null,
		beforeRender: null,
		afterRender: null,
		beforeShow: null,
		beforeSelect: null,
		onSelect: null,
		afterShow: null,
		onRemove: function(itemEl, file, id, listEl, boxEl, newInputEl, inputEl){
			var filerKit = inputEl.prop("jFiler"),
		        file_name = filerKit.files_list[id].name;

		    $.post('index.php?entryPoint=DeleteUploadedFile', {file: file_name/* ,folders: random_folder_name */});
		},
		onEmpty: null,
		options: null,
		dialogs: {
			alert: function(text) {
				return alert(text);
			},
			confirm: function (text, callback) {
				confirm(text) ? callback() : null;
			}
		},
		captions: {
			button: "Choose Files",
			feedback: "Choose files To Upload",
			feedback2: "files were chosen",
			drop: "Drop file here to Upload",
			removeConfirmation: "Are you sure you want to remove this file?",
			errors: {
				filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
				filesType: "Only Images are allowed to be uploaded.",
				filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
				filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
			}
		}
	});
// $(".jFiler-input-dragDrop").css("width","600px");
    }, 2000);

});
	function delete_attachment(path){
		console.log('path');
		console.log(path);
		//var module_id=document.EditView.elements['record'].value;
		$.post('index.php?entryPoint=DeleteUploadedFile', {file: path /* , record : module_id */});
		var x = document.getElementById(path);
		x.remove(x);
		console.log(case_attachments_file_id['value']);
		var str = case_attachments_file_id['value'];
		var res = str.split(",");
		var index = res.indexOf(path);
		if (index >= 0) {
		  res.splice( index, 1 );
		}
		case_attachments_file_id['value'] = " ";
		console.log(case_attachments_file_id['value']);

		case_attachments_file_id['value'] = res.toString();
		console.log(case_attachments_file_id['value']);
		console.log(res);
	}
