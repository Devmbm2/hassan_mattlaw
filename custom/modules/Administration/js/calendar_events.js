 $('.save_scheduler_settings').click(function () {
        let check_val = $("input[type=checkbox][name=sync_events]:checked").val();
            $.ajax({
                url: "index.php?module=Administration&action=sync_calendar",
                type: "post",
                async: false,
                data: {
                    search_data: check_val,
                    action_overview: 'save_settings'
                },
                success: function (response) {
                    let return_response = $(response).find(".sync_events_response").text();
                    if(return_response == 'checked'){
                        let message = 'You have Successfully Activate Sync Calendar Events Scheduler!';
                        sweetAlertFunction(message);
                    }else{
                       let message = 'You have Successfully Deactivate Sync Calendar Events Scheduler!';
                        sweetAlertFunction(message);
                    }
                }
            });
    });
 function sweetAlertFunction(title){
     let timerInterval
     Swal.fire({
         title: title,
         html: 'I will close in <b></b> milliseconds.',
         timer: 2000,
         timerProgressBar: true,
         didOpen: () => {
             Swal.showLoading()
             const b = Swal.getHtmlContainer().querySelector('b')
             timerInterval = setInterval(() => {
                 b.textContent = Swal.getTimerLeft()
             }, 100)
         },
         willClose: () => {
             clearInterval(timerInterval)
         }
     });
     let origin   = window.location.href;
     let url = origin.replace("sync_calendar", "index");
     window.location = url;
 }