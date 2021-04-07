function resetButton(btn) {
    btn.removeClass('disabled');
    btn.removeAttr('disabled', true);
    btn.text(btn.attr('data-original-text'));
}

function showLoaderButton(btn) {
    btn.addClass('disabled');
    btn.attr('disabled', true);
    btn.text(btn.attr('data-loading-text'));
}

function sendAjaxRequest(formData, url, handleData, btn, type="POST") {
    $.ajax({
        url: url,
        type: type,
        dataType: "json",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            if (btn != undefined && btn != '') {
                // btn.button('loading');
                showLoaderButton(btn)
            }
        },
        success: function (data) {
            if (btn != undefined && btn != '') {
                // btn.button('reset');
                resetButton(btn)
            }
            handleData(data);
        },
        error: function (data) {
            if (data.status !== undefined && data.status === 405) {
                window.location.reload();
            }
            if (btn != undefined && btn != '') {
                // btn.button('reset');
                resetButton(btn)
            }
            handleData(data);
        }
    });
}

function appendFilterInquiryDatas() {
    if ($('.data_table_yajra').length !== undefined) {
        $('select[name="per_page"]').val($('.data_table_yajra').attr('data-length'));
        var filters = $('.data_table_yajra').attr('data-table-filter');
        if (filters.length > 0) {
            filtersObject = JSON.parse(filters);
            $('input[name="no_of_days"]').val(filtersObject.no_of_days);
            $('select[name="trashed"]').val(filtersObject.trashed);
        }
    }

}

function OpenModal(btn, url, formData, modal_name) {
    modal_name = modal_name || false;
    sendAjaxRequest(formData, url, function (data) {
        $('#adominoModalContent').html(data.responseText);
        $('#dateRangePicker').daterangepicker()
        // if (modal_name == 'get-filter-domain-modal') {
        //     $('select[name="is_deleted"]').val($('input[name="is_deleted"]').val());
        //     $('select[name="title"]').val($('input[name="title"]').val());
        //     $('select[name="info_en"]').val($('input[name="info_en"]').val());
        //     $('select[name="info_de"]').val($('input[name="info_de"]').val());
        // } else
        if (modal_name == 'get-filter-inquiry-modal') {
            appendFilterInquiryDatas();
        }
        // if ($('select[name="per_page"]').length !== undefined && $('.data_table_yajra').length !== undefined) {
        //     $('select[name="per_page"]').val($('.data_table_yajra').attr('data-length'));
        // }
        $('#adominoModal').modal();
    }, btn)
}

