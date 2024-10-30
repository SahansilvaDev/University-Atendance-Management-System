!function ($) {
    "use strict";

    var SweetAlert = function () {
    };

    //examples
    SweetAlert.prototype.init = function () {

     

        //Success Message
        $('#sa-success').click(function () {
            swal(
                {
                    title: 'Good job!',
                    text: 'Scan Your Fingerprint',
                    type: 'success',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger'
                }
            )
        });


        




        //Danger
        $('#dynamic-alert').click(function () {
            swal.queue([{
                title: 'Your public IP',
                confirmButtonText: 'Show my public IP',
                text: 'Your public IP will be received ' +
                'via AJAX request',
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return new Promise(function (resolve) {
                        $.get('https://api.ipify.org?format=json')
                            .done(function (data) {
                                swal.insertQueueStep(data.ip)
                                resolve()
                            })
                    })
                }
            }])
        });


    },
        //init
        $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
}(window.jQuery),

//initializing
    function ($) {
        "use strict";
        $.SweetAlert.init()
    }(window.jQuery);