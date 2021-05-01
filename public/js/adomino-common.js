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
        var filters = $('.data_table_yajra').attr('data-filter');
        if (filters.length > 0) {
            filtersObject = JSON.parse(filters);
            $('input[name="no_of_days"]').val(filtersObject.no_of_days);
            $('select[name="trashed"]').val(filtersObject.trashed);
        }
    }
}

function appendFilterDomainDatas() {
    $('select[name="domain_filter_is_deleted"]').val($('input[name="is_deleted"]').val());
    $('select[name="domain_filter_title"]').val($('input[name="title"]').val());
    $('select[name="domain_filter_info_en"]').val($('input[name="info_en"]').val());
    $('select[name="domain_filter_info_de"]').val($('input[name="info_de"]').val());
}

function getDataTableLanguage() {
    var language = {
        "sEmptyTable": "Keine Daten in der Tabelle vorhanden",
        "sInfoEmpty": "0 bis 0 von 0 Einträgen",
        "sInfoFiltered": "(gefiltert von _MAX_ Einträgen)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        "sLengthMenu": "anzeigen _MENU_ Einträge",
        "sLoadingRecords": "Wird geladen...",
        "sProcessing": "Bitte warten...",
        "sSearch": "Suchen",
        "sZeroRecords": "Keine Einträge vorhanden.",
        "oPaginate": {
            "sFirst": "Erste",
            "sPrevious": "Zurück",
            "sNext": "Nächste",
            "sLast": "Letzte"
        },
        "oAria": {
            "sSortAscending": ": aktivieren, um Spalte aufsteigend zu sortieren",
            "sSortDescending": ": aktivieren, um Spalte absteigend zu sortieren"
        }
    };
    if ($('.data_table_yajra_manual').attr('data-total-count') !== undefined || $('.data_table_yajra').attr('data-total-count') !== undefined) {
        if ($('.data_table_yajra_manual').attr('data-total-count') !== undefined)
            language.sInfo = 'Ausgewählt: _TOTAL_ von ' + $('.data_table_yajra_manual').attr('data-total-count') + ' Domains';
        else if ($('.data_table_yajra').attr('data-total-count') !== undefined)
            language.sInfo = 'Ausgewählt: _TOTAL_ von ' + $('.data_table_yajra').attr('data-total-count') + ' Domains';
    } else {
        language.sInfo = "_START_ bis _END_ von _TOTAL_ Einträgen";
    }

    return language;
}

function OpenModal(btn, url, formData, modal_name) {
    modal_name = modal_name || false;
    sendAjaxRequest(formData, url, function (data) {
        $('#adominoModalContent').html(data.responseText);
        $('#dateRangePicker').daterangepicker()
        $('.singleDatePicker').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format('YYYY'), 10),
            autoApply: true,
            locale: {
                format: 'DD.MM.YYYY'
            },
            minDate: moment().year() - 10,
            maxDate: moment(),//.subtract(1, "days")
            maxYear: moment().year() + 10,
            // autoUpdateInput: false
        }, function (start, end, label) {
            // $('.singleDatePicker').val(start.format('YYYY/MM/DD'));
        });
        if (modal_name == 'get-filter-inquiry-modal') {
            appendFilterInquiryDatas();
        } else if (modal_name == 'get-filter-domain-modal') {
            appendFilterDomainDatas();
        }
        // if ($('select[name="per_page"]').length !== undefined && $('.data_table_yajra').length !== undefined) {
        //     $('select[name="per_page"]').val($('.data_table_yajra').attr('data-length'));
        // }
        $('#adominoModal').modal();
    }, btn)
}

