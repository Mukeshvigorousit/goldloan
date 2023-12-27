<?php



$pending_orders = get_pending_order();





?>
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#debitcreditamount">
                        Recived / Payment
                    </button> -->


<!-- Button trigger modal -->


<div class="modal fade" id="debitcreditamount" tabindex="-1" role="dialog" aria-labelledby="debitcreditamountLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:800px !important">
            <div class="modal-header">
                <h5 class="modal-title" id="debitcreditamountLabel">Debit Credit Entry</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive m-t">
                    <table class="table invoice-table table-bordered solid">
                        <thead style="text-align: center;">
                            <tr>
                                <th>Select Order </th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td>

                                    <select class="form-control select form-control " name="order_id" id="order_id"  >

                                        <?php

                                        foreach ($pending_orders as $key => $pending) {


                                        ?>
                                            <option value="<?= $pending['order_id'] ?>"><?= $pending['order_id'] ?> <?= $pending['client_data']['client_name'] ?> (<?= $pending['client_data']['mobile'] ?>) <?= $pending['client_data']['address'] ?></option>
                                        <?php

                                        }

                                        ?>

                                    </select>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!--  id="closeButton" -->
                <button type="submit" class="btn btn-primary" onclick="open_order()">Save changes</button>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="loanclose" tabindex="-1" role="dialog" aria-labelledby="loanclose" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:800px !important">
            <div class="modal-header">
                <h5 class="modal-title" id="loanclose">Close Loan </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive m-t">
                    <table class="table invoice-table table-bordered solid">
                        <thead style="text-align: center;">
                            <tr>
                                <th>Select Order </th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td>

                                    <select class="form-control select form-control " name="order_id" id="order_id"  >

                                        <?php

                                        foreach ($pending_orders as $key => $pending) {


                                        ?>
                                            <option value="<?= $pending['order_id'] ?>"><?= $pending['order_id'] ?> <?= $pending['client_data']['client_name'] ?> (<?= $pending['client_data']['mobile'] ?>) <?= $pending['client_data']['address'] ?></option>
                                        <?php

                                        }

                                        ?>

                                    </select>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!--  id="closeButton" -->
                <button type="submit" class="btn btn-primary" onclick="close_order()">Save changes</button>
            </div>
        </div>
    </div>
</div>





<?php if (!isset($page_id)) { ?>
    <div class="footer">

        <div class="float-right">
            <?= strtoupper(($_SESSION['user_type'])); ?> <strong> v1.0.0</strong>
        </div>
        <div>
            <strong><?= site_name ?></strong> | Powered By Einfotech | Copyright © 2014-<?= date('Y') ?>
        </div>
    </div>
    </div>
    </div>
<?php } ?>


<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="js/plugins/dataTables/datatables.min.js"></script>
<script src="js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

<!-- Flot -->
<script src="js/plugins/flot/jquery.flot.js"></script>
<script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="js/plugins/flot/jquery.flot.spline.js"></script>
<script src="js/plugins/flot/jquery.flot.resize.js"></script>
<script src="js/plugins/flot/jquery.flot.pie.js"></script>
<script src="js/plugins/flot/jquery.flot.symbol.js"></script>
<script src="js/plugins/flot/jquery.flot.time.js"></script>

<!-- Peity -->
<script src="js/plugins/peity/jquery.peity.min.js"></script>
<script src="js/demo/peity-demo.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>

<!-- jQuery UI -->
<script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Jvectormap -->
<script src="js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<!-- EayPIE -->
<script src="js/plugins/easypiechart/jquery.easypiechart.js"></script>

<!-- Sparkline -->
<script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- Sparkline demo data  -->
<script src="js/demo/sparkline-demo.js"></script>
<!-- Toastr -->
<script src="js/plugins/toastr/toastr.min.js"></script>
<!-- Touch Punch - Touch Event Support for jQuery UI -->
<script src="js/plugins/touchpunch/jquery.ui.touch-punch.min.js"></script>

<!-- iCheck -->
<script src="js/plugins/iCheck/icheck.min.js"></script>

<!-- Peity d data  -->
<script src="js/demo/peity-demo.js"></script>

<script src="js/plugins/select2/select2.full.min.js"></script>
<script src="js/plugins/sweetalert/sweetalert.min.js"></script>

<script src="js/plugins/pace/pace.min.js"></script>
<script src="js/custom.js"></script>

<!-- Tinycon -->
<script src="js/plugins/tinycon/tinycon.min.js"></script>
<script src="js/plugins/jasny/jasny-bootstrap.min.js"></script>

<!-- Data picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- NouSlider -->
<script src="js/plugins/nouslider/jquery.nouislider.min.js"></script>

<!-- Switchery -->
<script src="js/plugins/switchery/switchery.js"></script>

<!-- IonRangeSlider -->
<script src="js/plugins/ionRangeSlider/ion.rangeSlider.min.js"></script>

<!-- iCheck -->
<script src="js/plugins/iCheck/icheck.min.js"></script>

<!-- MENU -->
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

<!-- Color picker -->
<script src="js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

<!-- Clock picker -->
<script src="js/plugins/clockpicker/clockpicker.js"></script>

<!-- Image cropper -->
<script src="js/plugins/cropper/cropper.min.js"></script>

<!-- Date range use moment.js same as full calendar plugin -->
<script src="js/plugins/fullcalendar/moment.min.js"></script>

<!-- Date range picker -->
<script src="js/plugins/daterangepicker/daterangepicker.js"></script>

<!-- Select2 -->
<script src="js/plugins/select2/select2.full.min.js"></script>

<!-- TouchSpin -->
<script src="js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

<!-- Tags Input -->
<script src="js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

<!-- Dual Listbox -->
<script src="js/plugins/dualListbox/jquery.bootstrap-duallistbox.js"></script>
<script>
    function check_prompt_password() {
        var password = prompt("Please enter your password", "Password");
        var pass_check = true;
        if (password == null || password == '') {
            pass_check = false;
            return false
        } else {
            sendData = {
                'password': password
            }
            data = sendAjax('ajax/check_password', sendData);
            if (data.status == 'error') {
                swal("Failed!", data.data.msg, "error");
                pass_check = false;
                return false;
            }

        }
        return pass_check
    }

    function update_id_array(update_obj) {
        $.each(update_obj, function(key, value) {
            if (value.is_value == true) {
                $('#' + key).val(value.value)
            } else {
                $('#' + key).html(value.value)
            }
        });
    }




    function notify($type, $msg) {

        setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                Position: 'Top Right',
                timeOut: 4000
            };
            if ($type == 'error') {
                toastr.error('' + $type + '', '' + $msg + '');
            } else {
                toastr.success('' + $type + '', '' + $msg + '');
            }

        }, 500);
    }
</script>

<script>
    $(document).ready(function() {
        $('.dataTables-example').DataTable({
            pageLength: 10,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [{
                    extend: 'csv'
                },
                {
                    extend: 'pdf',
                    title: 'ExampleFile'
                },
                {
                    extend: 'print',
                    customize: function(win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]
        });

    });
</script>


<script>
    $(document).ready(function() {

        /*$('.dataTables-example').DataTable( {
        pageLength: 25,
        "orderable": false,
        dom: 'Bfrtip',
        buttons: [
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
});*/

        $(".select2_demo_1").select2();
        $(".select2_demo_2").select2();
        $(".select2_demo_3").select2({
            placeholder: '',
            allowClear: true
        });



    });


    $('a').on('click', function(event) {
        if ($(this).attr('href') !== '#' && !$(this).attr('href').includes('action') && $(this).parent().has('ul').length === 0) {
            $(".loader").show();
        } else {
            $(".loader").hide();
        }
        if ($(this).attr('href').includes('action')) {
            $(".loader").hide();
        }
        if ($(this).attr('href').includes('print')) {
            $(".loader").hide();
        }
    });
</script>


<?php if (isset($_SESSION['notify'])) {

    $msg = $_SESSION['notify']['msg'];
    $type = $_SESSION['notify']['type'];
    unset($_SESSION['notify']);
    echo "<script>
        $(document).ready(function() {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    Position:'Top Right',
                    timeOut:4000
                };
                toastr." . $type . "('" . $type . "', '" . $msg . "');
            }, 500);
        });
    </script>";
}
?>




<script>
    function open_order() {
        // var order_id = $('#order_id').val();
        // alert(order_id);


        var order_id1 = $('#order_id :selected').val();
 
        window.location.replace("order_details1?order_id=" + order_id1 + "&page_name=order_details")
    }
    function close_order() {
        // var order_id = $('#order_id').val();
        // alert(order_id);


        var order_id1 = $('#order_id :selected').val();
 
        window.location.replace("loan_close?order_id=" + order_id1 + "&page_name=loan_close")
    }



 
</script>

</body>

</html>