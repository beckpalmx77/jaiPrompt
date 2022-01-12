<?php
include('includes/Header.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {

    ?>

    <!DOCTYPE html>
    <html lang="th">

    <body id="page-top">
    <div id="wrapper">


        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><span id="title"></span></h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
                            <li class="breadcrumb-item"><span id="main_menu"></li>
                            <li class="breadcrumb-item active"
                                aria-current="page"><span id="sub_menu"></li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-12">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                </div>
                                <div class="card-body">
                                    <section class="container-fluid">

                                        <form method="post" id="MainrecordForm">
                                            <input type="hidden" class="form-control" id="KeyAddData" name="KeyAddData"
                                                   value="">
                                            <div class="modal-body">
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <div class="col-sm-2">
                                                            <label for="doc_no"
                                                                   class="control-label">เลขที่เอกสาร</label>
                                                            <input type="text" class="form-control"
                                                                   id="doc_no" name="doc_no"
                                                                   readonly="true"
                                                                   placeholder="เลขที่เอกสาร">
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <label for="doc_date"
                                                                   class="control-label">วันที่</label>
                                                            <input type="text" class="form-control"
                                                                   id="doc_date"
                                                                   name="doc_date"
                                                                   required="required"
                                                                   readonly="true"
                                                                   placeholder="วันที่">
                                                            <div class="input-group-addon">
                                                                <span class="glyphicon glyphicon-th"></span>
                                                            </div>
                                                        </div>

                                                        <input type="hidden" class="form-control"
                                                               id="customer_id"
                                                               name="customer_id">
                                                        <div class="col-sm-6">
                                                            <label for="customer_name"
                                                                   class="control-label">ชื่อลูกค้า</label>
                                                            <input type="text" class="form-control"
                                                                   id="customer_name"
                                                                   name="customer_name"
                                                                   required="required"
                                                                   placeholder="ชื่อลูกค้า">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <label for="CusModal"
                                                                   class="control-label"> เลือกชื่อลูกค้า </label>
                                                            <a data-toggle="modal" href="#SearchCusModal"
                                                               class="btn btn-primary">
                                                                Click <i class="fa fa-search"
                                                                         aria-hidden="true"></i>
                                                            </a>

                                                        </div>
                                                    </div>

                                                    <button type='button' name='btnAdd' id='btnAdd'
                                                            class='btn btn-primary btn-xs'>Add เพิ่มรายการสินค้า
                                                        <i class="fa fa-plus"></i>
                                                    </button>

                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                           class="display"
                                                           id="TableOrderDetailList"
                                                           width="100%">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>สินค้า</th>
                                                            <th>จำนวน</th>
                                                            <th>หน่วยนับ</th>
                                                            <th>ราคา/หน่วย</th>
                                                            <th>รวมราคา</th>
                                                            <th>Action</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                    </table>

                                                    <div class="form-group">
                                                        <label for="status"
                                                               class="control-label">Status</label>
                                                        <select id="status" name="status"
                                                                class="form-control"
                                                                data-live-search="true"
                                                                title="Please select">
                                                            <option>Active</option>
                                                            <option>Inactive</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="id" id="id"/>
                                                <input type="hidden" name="save_status" id="save_status"/>
                                                <input type="hidden" name="action" id="action"
                                                       value=""/>
                                                <button type="button" class="btn btn-primary"
                                                        id="btnSave">Save <i
                                                            class="fa fa-check"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger"
                                                        id="btnClose">Close <i
                                                            class="fa fa-window-close"></i>
                                                </button>
                                            </div>
                                        </form>

                                        <div class="modal fade" id="recordModal">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modal title</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">×
                                                        </button>
                                                    </div>
                                                    <form method="post" id="recordForm">

                                                        <div class="form-group row">
                                                            <div class="col-sm-5">
                                                                <input type="hidden" class="form-control"
                                                                       id="KeyAddDetail"
                                                                       name="KeyAddDetail" value="">
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <input type="hidden" class="form-control"
                                                                       id="doc_no_detail"
                                                                       name="doc_no_detail" value="">
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <input type="hidden" class="form-control"
                                                                       id="doc_date_detail"
                                                                       name="doc_date_detail" value="">
                                                            </div>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="modal-body">

                                                                <div class="form-group row">
                                                                    <div class="col-sm-5">
                                                                        <label for="product_id"
                                                                               class="control-label">รหัสสินค้า/วัสดุ</label>
                                                                        <input type="product_id"
                                                                               class="form-control"
                                                                               id="product_id" name="product_id"
                                                                               required="required"
                                                                               readonly="true"
                                                                               placeholder="รหัสสินค้า/วัสดุ">
                                                                    </div>

                                                                    <div class="col-sm-5">
                                                                        <label for="name_t"
                                                                               class="control-label">ชื่อสินค้า/วัสดุ</label>
                                                                        <input type="text" class="form-control"
                                                                               id="name_t"
                                                                               name="name_t"
                                                                               required="required"
                                                                               readonly="true"
                                                                               placeholder="ชื่อสินค้า/วัสดุ">
                                                                    </div>

                                                                    <div class="col-sm-2">
                                                                        <label for="quantity"
                                                                               class="control-label">เลือก</label>

                                                                        <a data-toggle="modal"
                                                                           href="#SearchProductModal"
                                                                           class="btn btn-primary">
                                                                            Click <i class="fa fa-search"
                                                                                     aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <div class="col-sm-5">
                                                                        <label for="quantity"
                                                                               class="control-label">จำนวน</label>
                                                                        <input type="number" class="form-control"
                                                                               id="quantity"
                                                                               name="quantity"
                                                                               required="required"
                                                                               placeholder="จำนวน">
                                                                    </div>
                                                                    <input type="hidden" class="form-control"
                                                                           id="unit_id"
                                                                           name="unit_id">
                                                                    <div class="col-sm-5">
                                                                        <label for="unit_name"
                                                                               class="control-label">หน่วยนับ</label>
                                                                        <input type="text" class="form-control"
                                                                               id="unit_name"
                                                                               name="unit_name"
                                                                               required="required"
                                                                               readonly="true"
                                                                               placeholder="หน่วยนับ">
                                                                    </div>

                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-5">
                                                                        <label for="price"
                                                                               class="control-label">ราคา/หน่วย</label>
                                                                        <input type="number" class="form-control"
                                                                               id="price"
                                                                               name="price"
                                                                               required="required"
                                                                               placeholder="ราคา/หน่วย">
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <label for="total_price"
                                                                               class="control-label">ราคารวม</label>
                                                                        <input type="number" class="form-control"
                                                                               id="total_price"
                                                                               name="total_price"
                                                                               required="required"
                                                                               placeholder="ราคารวม">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <input type="hidden" name="id" id="id"/>
                                                            <input type="hidden" name="detail_id" id="detail_id"/>
                                                            <input type="hidden" name="action_detail"
                                                                   id="action_detail" value=""/>
                                                            <span class="icon-input-btn">
                                                                <i class="fa fa-check"></i>
                                                            <input type="submit" name="save" id="save"
                                                                   class="btn btn-primary" value="Save"/>
                                                            </span>
                                                            <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal">Close <i
                                                                        class="fa fa-window-close"></i>
                                                            </button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>

                                    </section>


                                </div>

                            </div>

                        </div>

                    </div>
                    <!--Row-->

                    <!-- Row -->

                </div>

                <!---Container Fluid-->

            </div>

            <?php
            include('includes/Modal-Logout.php');
            include('includes/Footer.php');
            ?>

        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Select2 -->
    <script src="vendor/select2/dist/js/select2.min.js"></script>


    <!-- Bootstrap Touchspin -->
    <script src="vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js"></script>
    <!-- ClockPicker -->

    <!-- RuangAdmin Javascript -->
    <script src="js/myadmin.min.js"></script>
    <script src="js/util.js"></script>
    <script src="js/Calculate.js"></script>

    <script src="js/modal/show_customer_modal.js"></script>
    <script src="js/modal/show_product_modal.js"></script>
    <script src="js/modal/show_unit_modal.js"></script>
    <!-- Javascript for this page -->

    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css"/>

    <script src="vendor/date-picker-1.9/js/bootstrap-datepicker.js"></script>
    <script src="vendor/date-picker-1.9/locales/bootstrap-datepicker.th.min.js"></script>
    <!--link href="vendor/date-picker-1.9/css/date_picker_style.css" rel="stylesheet"/-->
    <link href="vendor/date-picker-1.9/css/bootstrap-datepicker.css" rel="stylesheet"/>

    <style>

        .icon-input-btn {
            display: inline-block;
            position: relative;
        }

        .icon-input-btn input[type="submit"] {
            padding-left: 2em;
        }

        .icon-input-btn .fa {
            display: inline-block;
            position: absolute;
            left: 0.65em;
            top: 30%;
        }
    </style>

    <script>
        $(document).ready(function () {
            $('#doc_date').datepicker({
                format: "dd-mm-yyyy",
                todayHighlight: true,
                language: "th",
                autoclose: true
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $(".icon-input-btn").each(function () {
                let btnFont = $(this).find(".btn").css("font-size");
                let btnColor = $(this).find(".btn").css("color");
                $(this).find(".fa").css({'font-size': btnFont, 'color': btnColor});
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $("#btnClose").click(function () {
                window.opener = self;
                window.close();
            });
        });
    </script>

    <script type="text/javascript">
        let queryString = new Array();
        $(function () {
            if (queryString.length == 0) {
                if (window.location.search.split('?').length > 1) {
                    let params = window.location.search.split('?')[1].split('&');
                    for (let i = 0; i < params.length; i++) {
                        let key = params[i].split('=')[0];
                        let value = decodeURIComponent(params[i].split('=')[1]);
                        queryString[key] = value;
                    }
                }
            }

            let data = "<b>" + queryString["title"] + "</b>";
            $("#title").html(data);
            $("#main_menu").html(queryString["main_menu"]);
            $("#sub_menu").html(queryString["sub_menu"]);

            let img = queryString["img"].split(",");

            //let del_img = "A001_3.jpg";
            //alert("Array Before = " + img.length);
            //delete_image(img, del_img);

            $('#action').val(queryString["action"]);


        });
    </script>

    <script>
        function delete_image(img, del_img) {

            //alert("del_img = " + del_img);

            let index = img.indexOf(del_img);

            //alert("Del index = " + index);
            if (index > -1) {
                img.splice(index, 1);
            }
            //alert("After Del Array = " + img.length);
            //alert(img);
        }

    </script>


    </body>

    </html>

<?php } ?>


