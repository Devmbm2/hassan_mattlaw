function undelete(module, record){ 

		$.ajax({
		   type: "POST",
		   url: 'index.php?module=ht_recycle_bin&selected_module='+module+'&action=undelete&view=detail&uid='+record,
		  //data: {pwd: pass},
		  async: false,
		   success: function(response){
			  window.open('index.php?module='+module+'&action=DetailView&record='+record ,'_blank');
			  parent.location.reload();
				
		    }
		});
}

function delete_permanent(module, record){ 

		$.ajax({
		   type: "POST",
		   url: 'index.php?module=ht_recycle_bin&selected_module='+module+'&action=delete_permanent&uid='+record,
		  async: false,
		   success: function(response){
			  parent.location.reload();
				
		    }
		});
}

		