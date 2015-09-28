<?php
/*
 `user_seq`, `user_uid`, `user_name`, `user_id`, `user_type`, `user_email`, `user_sign_up_date`, `user_sign_in_date_latest`, `user_status`, `user_etc`
 */
?>
<!-- Include one of jTable styles. -->
<link href="<?= $URL['core']['root']; ?>vendor/jtable/lib/themes/metro/blue/jtable.min.css" rel="stylesheet" type="text/css" />

<!-- Include jTable script file. -->
<script src="<?= $URL['core']['root']; ?>vendor/jtable/lib/jquery.jtable.min.js" type="text/javascript"></script>
 
<!-- Include jTable script file. -->
<script src="<?= $URL['core']['root']; ?>vendor/jtable/lib/localization/jquery.jtable.kr.js" type="text/javascript"></script>

<link href="<?= $URL['core']['root']; ?>vendor/jQuery-Validation-Engine/css/validationEngine.jquery.css" rel="stylesheet" type="text/css" />
<script src="<?= $URL['core']['root']; ?>vendor/jQuery-Validation-Engine/js/jquery.validationEngine.js"></script>
<script src="<?= $URL['core']['root']; ?>vendor/jQuery-Validation-Engine/js/languages/jquery.validationEngine-en.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#PersonTableContainer').jtable({
            title: '[ <?= $VIEW['body']['user_list']['title']; ?> ]',
            paging: true,
            pageSize: 10,
            sorting: true,
            defaultSorting: 'Name ASC',
            useBootstrap: true,
            actions: {
                listAction: "<?= $URL_ADMIN['user']['root']; ?>user-act/command/list/<?= $VIEW['body']['url_addtion']; ?>",
                createAction: "<?= $URL_ADMIN['user']['root']; ?>user-act/command/new/",
                updateAction: "<?= $URL_ADMIN['user']['root']; ?>user-act/command/edit/",
                deleteAction: "<?= $URL_ADMIN['user']['root']; ?>user-act/command/delete/"
            },
<?php
// #TODO 옵션에 따라 엑셀 출력옵션을 보여줄지 아닐지 결정.
if(false) {
?>
            toolbar: {
                items: [{
                    tooltip: '엑셀화일로 받으시려면 누르세요.',
                    text: '엑셀로 출력',
                    click: function () {
                      alert("준비중입니다.");
                    }
                }]
            },
<?php
}
?>
            fields: {
                // phones : H
                phones: {
                    title: '',
                    width: '1%',
                    sorting: false,
                    edit: false,
                    create: false,
                    listClass: 'child-opener-image-column',
                    display: function (userData) {
                        //Create an image that will be used to open child table
                        var $img = $('<img class="child-opener-image" src="<?= $URL['core']['root']; ?>vendor/jtable/lib/themes/metro/add.png" title="<?= _('전화번호수정'); ?>" />');
                        //Open child table when user clicks the image
                        $img.click(function () {
                            $('#PersonTableContainer').jtable('openChildTable',
                                    $img.closest('tr'),
                                    {
                                        title: userData.record.name + '님의 전화번호',
                                        actions: {
                                            listAction: "<?= $URL_ADMIN['user']['root']; ?>user-act/command/meta_list/user_id/" + userData.record.id + "/<?= $VIEW['body']['url_addtion']; ?>",
                                            createAction: "<?= $URL_ADMIN['user']['root']; ?>user-act/command/meta_new/user_id/" + userData.record.id + "/<?= $VIEW['body']['url_addtion']; ?>",
                                            updateAction: "<?= $URL_ADMIN['user']['root']; ?>user-act/command/meta_edit/<?= $VIEW['body']['url_addtion']; ?>",
                                            deleteAction: "<?= $URL_ADMIN['user']['root']; ?>user-act/command/meta_delete/<?= $VIEW['body']['url_addtion']; ?>"
                                        },
                                        fields: {
                                            m_seq: {
                                                key: true,
                                                create: false,
                                                edit: false,
                                                list: false
                                            },
                                            m_key: {
                                                title: '종류',
                                                width: '30%',
                                                options: { 'phone_cell': '핸드폰', 'phone_home': '집전화', 'phone_etc': '기타' }
                                            },
                                            m_value: {
                                                title: '전화번호',
                                                width: '30%',
                                                inputClass: 'validate[required]'
                                            },
                                            m_desc: {
                                                title: '메모',
                                                width: '20%'
                                            }
                                        },
                                        formCreated: function (event, data) {
                                            data.form.validationEngine();
                                        },
                                        formSubmitting: function (event, data) {
                                            return data.form.validationEngine('validate');
                                        },
                                        formClosed: function (event, data) {
                                            data.form.validationEngine('hide');
                                            data.form.validationEngine('detach');
                                        }
                                    }, function (data) { //opened handler
                                        data.childTable.jtable('load');
                                    });
                        });
                        //Return image to show on the person row
                        return $img;
                    }
                },
                // phones : T
                seq: {
                    key: true,
                    list: false
                },
                name: {
                    title: '<?= $VIEW['body']['user_list']['name']; ?>',
                    width: '20%'
                },
                id: {
                    title: '<?= $VIEW['body']['user_list']['id']; ?>',
                    edit: false,
                    width: '10%'
                },
                email: {
                    list:false,
                    title: '<?= $VIEW['body']['user_list']['email']; ?>',
                    width: '20%'
                },
                status: {
                    title: '<?= $VIEW['body']['user_list']['status']; ?>',
                    <?php
                        if(! empty($VIEW['body']['user_option']['status'])) {
                            echo 'options: ' . json_encode($VIEW['body']['user_option']['status']) . ',';
                        }
                    ?>
                    width: '10%'
                },
                sign_up_date: {
                    title: '<?= $VIEW['body']['user_list']['sign_up_date']; ?>',
                    type: 'date',
                    create: false,
                    edit: false,
                    width: '10%'
                },
                sign_in_date_latest: {
                    title: '<?= $VIEW['body']['user_list']['sign_in_date_latest']; ?>',
                    create: false,
                    edit: false,
                    list: false,
                    width: '10%'
                }
            }
        });

        //Re-load records when user click 'load records' button.
        $('#LoadRecordsButton').click(function (e) {
            e.preventDefault();
            $('#PersonTableContainer').jtable('load', {
                search_name: $('#search_name_gjhw').val(),
                search_date_from: $('#search_date_from_gjhw').val(),
                search_date_to: $('#search_date_to_gjhw').val(),
            });
        });
 
        //Load all records when page is first shown
        $('#LoadRecordsButton').click();

    });

$(function() {
    $("#search_date_type_gjhw").change(function() {
        var date_type = $( "#search_date_type_gjhw option:selected" ).val();
        switch(date_type) {
            case 'today':
                $( "#search_date_from_gjhw" ).datepicker('setDate', '<?= $VIEW['body']['today']; ?>');
                $( "#search_date_to_gjhw" ).datepicker('setDate', '<?= $VIEW['body']['today']; ?>');
                break;
            case 'yesterday':
                $( "#search_date_from_gjhw" ).datepicker('setDate', '<?= $VIEW['body']['yesterday']; ?>');
                $( "#search_date_to_gjhw" ).datepicker('setDate', '<?= $VIEW['body']['yesterday']; ?>');
                break;
            case 'this_month':
                $( "#search_date_from_gjhw" ).datepicker('setDate', '<?= $VIEW['body']['month_begin']; ?>');
                $( "#search_date_to_gjhw" ).datepicker('setDate', '<?= $VIEW['body']['month_end']; ?>');
                break;
            case 'last_month':
                $( "#search_date_from_gjhw" ).datepicker('setDate', '<?= $VIEW['body']['last_month_begin']; ?>');
                $( "#search_date_to_gjhw" ).datepicker('setDate', '<?= $VIEW['body']['last_month_end']; ?>');
                break;
            default:
                $( "#search_date_from_gjhw" ).datepicker('setDate', '');
                $( "#search_date_to_gjhw" ).datepicker('setDate', '');
                break;
        }
        
    })
    $( "#search_date_from_gjhw" ).datepicker({dateFormat: "yy-mm-dd"});
    $( "#search_date_to_gjhw" ).datepicker({dateFormat: "yy-mm-dd"});
    $('.AddRecordButton').click(function() {
        $('#PersonTableContainer').jtable("showCreateForm");
    });

});
</script>

<style>
    .filtering { margin-top : 10px; }
    .jtable-left-area select {
        color:#000 !important;
    }
</style>
