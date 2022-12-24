


import './bootstrap';

import Alpine from 'alpinejs';
import { get } from 'lodash';

window.Alpine = Alpine;

Alpine.start();

// custom js
$(document).ready(function () {
    $('#myTable').DataTable();
});


$(document).ready(function () {
    $('#supplierTable').DataTable();
});

$(document).ready(function () {
    $('#purcheseTable').DataTable();
});

$(document).ready(function () {
    $('#paymentTable').DataTable();
});

$(document).ready(function () {
    $('#localTable').DataTable({
        responsive:true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                title: 'Local Report',
                customize: function (win) {
                }
            },
        ],

    });
    
});



let table;
$(document).ready(function () {
   table= $('#pReportTable').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                title: 'Purchese Report',
                customize: function (win) {
                 
                   



                }
            },
            {
                extend: 'print',
                title: 'Purchese Report',
                customize: function (win) {
                    $(win.document.body).append($('#printHeader').css('display','flex'));
                    $(win.document.body).addClass('bg-indigo-100');
                    $(win.document.body).css('font-size', '20px').css('margin', '40px');
                    $(win.document.body).find('table')
                        .addClass('text-gray-900')
                        .css('font-size', '16px').css('margin-left', '10px').css('margin-right', '10px');
               


                }
            },
        ],

    });
});

$(document).ready(function () {
    $('#sReportTable').DataTable({

        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                title: 'Sales Report',
                customize: function (win) {

                }
            },

            {
                extend: 'print',
                title: 'Sales Report',
                customize: function (win) {
                    $(win.document.body).append($('#printHeader').css('display', 'flex'));
                    $(win.document.body).addClass('bg-indigo-100');
                    $(win.document.body).css('font-size', '20px').css('margin', '40px');
                    $(win.document.body).find('table')
                        .addClass('text-gray-900')
                        .css('font-size', '16px').css('margin-left', '10px').css('margin-right', '10px');


                }
            }
        ],
    });
});



$(document).ready(function () {
    $('#supplierPaymentReportTable').DataTable({

        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                title: 'Supplier Payment Report',
                customize: function (win) {

                }
            },

            {
                extend: 'print',
                title: 'Supplier Payment Report',
                customize: function (win) {
                    $(win.document.body).append($('#supplierInfo'));
                    $(win.document.body).append($('#printHeader').css('display','flex'));
                    $(win.document.body).addClass('bg-indigo-100');
                    $(win.document.body).css('font-size', '20px').css('margin', '40px');
                    $(win.document.body).find('table')
                        .addClass('text-gray-900')
                        .css('font-size', '16px').css('margin-left', '10px').css('margin-right', '10px');


                }
            },

        ],
    });
});




$(document).ready(function () {
    $('#customerPaymentReportTable').DataTable({

        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                title: 'Customer Payment Report',
                customize: function (win) {

                }
            },

            {
                extend: 'print',
                title: 'Customer Payment Report',
                customize: function (win) {
                    $(win.document.body).append($('#customerInfo'));
                    $(win.document.body).append($('#printHeader').css('display', 'flex'));

                    $(win.document.body).addClass('bg-indigo-100');
                    $(win.document.body).css('font-size', '20px').css('margin', '40px');
                    $(win.document.body).find('table')
                        .addClass('text-gray-900')
                        .css('font-size', '16px').css('margin-left', '10px').css('margin-right', '10px');


                }
            }
        ],
    });
});













