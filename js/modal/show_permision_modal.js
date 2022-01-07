$(document).ready(function () {

    let formData = {action: "GET_PERMISSION", sub_action: "GET_SELECT"};
    let dataRecords = $('#TablePermissionList').DataTable({
        'lengthMenu': [[5, 10, 20, 50, 100], [5, 10, 20, 50, 100]],
        'language': {
            search: 'ค้นหา', lengthMenu: 'แสดง _MENU_ รายการ',
            info: 'หน้าที่ _PAGE_ จาก _PAGES_',
            infoEmpty: 'ไม่มีข้อมูล',
            zeroRecords: "ไม่มีข้อมูลตามเงื่อนไข",
            infoFiltered: '(กรองข้อมูลจากทั้งหมด _MAX_ รายการ)',
            paginate: {
                previous: 'ก่อนหน้า',
                last: 'สุดท้าย',
                next: 'ต่อไป'
            }
        },
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': 'model/manage_permission.php',
            'data': formData
        },
        'columns': [
            {data: 'permission_id'},
            {data: 'permission_detail'},
            {data: 'select'}
        ]
    });
});

$("#TablePermissionList").on('click', '.select', function () {
    let data = this.id.split('@');
    $('#permission_id').val(data[0]);
    $('#permission_detail').val(data[1]);

    //document.getElementById("myDIV").innerHTML = "";


    let permission_id = data[0];
    let formData = {action: "LOAD_PERMISSION", permission_id: permission_id};
    $.ajax({
        type: "POST",
        url: 'model/manage_permission.php',
        dataType: "json",
        data: formData,
        success: function (response) {
            let len = response.length;
            for (let i = 0; i < len; i++) {
                let id = response[i].id;
                let main_menu = response[i].main_menu;
                let sub_menu = response[i].sub_menu;
                let dashboard_page = response[i].dashboard_page;

                $('#dashboard_page').val(dashboard_page);

                let main_menu_array = main_menu.split(",");
                let sub_menu_array = sub_menu.split(",");

                let main_list = document.getElementsByName("menu_main");
                let sub_list = document.getElementsByName("menu_sub");

                for (let i = 0; i < main_list.length ; i++) {
                    if (main_list[i].value === main_menu_array[i]) {
                        //alert(main_list[i].value + " Match = " + main_menu_array[i]);
                        document.getElementsByName("menu_main")[i].checked = true;
                    } else {
                        document.getElementsByName("menu_main")[i].checked = false;
                    }
                }

                for (let i = 0; i < sub_list.length ; i++) {
                    if (sub_list[i].value === sub_menu_array[i]) {
                        //alert(sub_list[i].value + " Match = " + sub_menu_array[i]);
                        document.getElementsByName("menu_sub")[i].checked = true;
                    } else {
                        document.getElementsByName("menu_sub")[i].checked = false;
                    }
                }

            }

        },
        error: function (response) {
            alertify.error("error : " + response);
        }
    });

    $('#SearchPermissionModal').modal('hide');
});
