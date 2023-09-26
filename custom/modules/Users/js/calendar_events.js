$(document).ready(function() {
    $('#google_calender_events').click(function () {
        let check_val = $("input[type=checkbox][name=google_calender_events]:checked").val()
            $.ajax({
                url: "index.php?module=Users&action=activateCalenderSchedular",
                type: "post",
                async: false,
                data: {search_data: check_val},
                success: function (response) {
                    if(check_val == 1){
                        let timerInterval
                        Swal.fire({
                            title: 'Sync Calendar Events Scheduler is now Active!',
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
                        }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                console.log('I was closed by the timer')
                            }
                        })
                    }
                }
            });
    });
});