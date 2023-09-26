<?php
require_once('include/MVC/View/views/view.list.php');
class AOR_ReportsViewList extends ViewList
{
    /**
     * @see ViewList::preDisplay()
     */
    public function preDisplay(){
        echo '<script>
		$(document).ready(function(){
			$(".oddListRowS1, .evenListRowS1").each(function(){
				var href = $(this).children().eq(2).find("a").attr("href");
				var custom_reports = {
					"end_year_cost_report" : "end_year_cost_report",
				};
				for(var key in custom_reports) {
					if(href.search(key)>0){
						href = href.replace("DetailView",custom_reports[key]);
						$(this).children().eq(2).find("a").attr("href",href);
					}
				}
			});
		});
		</script>';
        parent::preDisplay();
    }
}
