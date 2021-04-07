$(function () {
    var baseUrl = $('meta[name="base-url"]').attr('content');
    var csrfToken = $('meta[name="csrf-token"]').attr('content')
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });

    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
    if ($('.js-select2-ajax').length > 0 && $('#select2_id').length !== undefined && $('#select2_text').length !== undefined) {
        var newOption = new Option($('#select2_text').val(), $('#select2_id').val(), true, true);
        $('.js-select2-ajax').append(newOption).trigger('change');
    }
    $('.js-select2-ajax').select2({
        theme: 'bootstrap4',
        ajax: {
            url: $('.js-select2-ajax').attr('data-url'),
            data: function (params) {
                var query = {
                    search: params.term,
                    type: 'public',
                }
                query.page = params.page || 1;
                return query;
            }
        }
    });

    $('.js-select2-ajax').on("select2:selecting", function (e) {
        $('#select2_id').val(e.params.args.data.id);
        $('#select2_text').val(e.params.args.data.text);
    })

    var columns = [];
    var columnDefs = [];
    $('.data_table_yajra th').each(function (v, a) {
        if ($(this).attr('data-sort') === undefined) {
            columnDefs.push({"orderable": true, "targets": v})
        } else {
            if ($(this).attr('data-width') === undefined) {
                columnDefs.push({
                    "orderable": ($(this).attr('data-sort') == '1') ? true : false,
                    "targets": v,
                })
            } else {
                columnDefs.push({
                    "orderable": ($(this).attr('data-sort') == '1') ? true : false,
                    "targets": v,
                    "width": $(this).attr('data-width'),
                })
            }

        }
        var data = {data: $(this).attr('data-column'), name: $(this).attr('data-column')};
        columns.push(data)
    })

    function getInquirySearchFilers() {
        if ($('.data_table_yajra').attr('data-table-name') !== undefined && $('.data_table_yajra').attr('data-table-name') == 'inquiry-table') {
            $('.data_table_yajra').attr('data-table-filter', '{"no_of_days":"' + $('input[name="no_of_days"]').val() + '","trashed":"' + $('select[name="trashed"]').val() + '"}');
        }
    }

    var yajraTable;

    function yajraManual() {
        yajraTable = $('.data_table_yajra').DataTable({
            processing: true,
            // responsive: true,
            bLengthChange: false,
            searching: false,
            fixedColumns: true,
            language: {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>wird bearbeitet...'
            },
            "oLanguage": {
                "sEmptyTable": "Keine Daten in der Tabelle vorhanden",
                "sInfo": "_START_ bis _END_ von _TOTAL_ Einträgen",
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
            },
            serverSide: true,
            destroy: true,
            ajax: function (data, callback) {
                // if ($('.data_table_yajra').attr('data-table-name') !== undefined && $('.data_table_yajra').attr('data-table-name') == 'domain-table') {
                //     $('input[name="is_deleted"]').val(urlParams.get('is_deleted'));
                //     $('input[name="title"]').val(urlParams.get('title'));
                //     $('input[name="info_en"]').val(urlParams.get('info_en'));
                //     $('input[name="info_de"]').val(urlParams.get('info_de'));
                //     data.filter = '{"info_de": "' + urlParams.get('info_de') + '","info_en": "' + urlParams.get('info_en') + '","title": "' + urlParams.get('title') + '","is_deleted": "' + urlParams.get('is_deleted') + '"}';
                // } else if ($('.data_table_yajra').attr('data-table-name') !== undefined && $('.data_table_yajra').attr('data-table-name') == 'statistics-table') {
                //     $('input[name="is_deleted"]').val(urlParams.get('is_deleted'));
                //     $('input[name="title"]').val(urlParams.get('title'));
                //     $('input[name="info_en"]').val(urlParams.get('info_en'));
                //     $('input[name="info_de"]').val(urlParams.get('info_de'));
                //     data.filter = '{"from_date": "' + urlParams.get('from_date') + '","to_date": "' + urlParams.get('to_date') + '"}';
                // }
                data.filter = $('.data_table_yajra').attr('data-table-filter');
                data.search = {regex: false, value: $('#yajraSearch').val()};
                $.ajax({
                    url: $('.data_table_yajra').attr('data-url'),
                    data: data,
                    dataType: 'json',
                    beforeSend: function () {
                        $('.data_table_yajra > tbody').html("");
                    },
                    success: function (res) {
                        $('.data_table_yajra').show();
                        callback(res);
                    }
                });
            },
            columns: columns,
            columnDefs: columnDefs,
            order: ($('.data_table_yajra').attr('data-custom-order') !== undefined) ? [parseInt($('.data_table_yajra').attr('data-custom-order')), ($('.data_table_yajra').attr('data-custom-sort-type') !== undefined) ? $('.data_table_yajra').attr('data-custom-sort-type') : 'desc'] : [1, 'desc'],
            sScrollX: ($('.data_table_yajra').attr('data-scrollable') !== undefined) ? "100%" : false,
            sScrollXInner: ($('.data_table_yajra').attr('data-scrollable') !== undefined) ? "110%" : false,
            // "lengthMenu": [
            //     [10, 25, 50, 100, -1],
            //     [10, 25, 50, 100, 'All']
            // ],
            // pageLength: (urlParams.get('per_page') !== undefined) ? parseInt(urlParams.get('per_page')) : parseInt($('.data_table_yajra').attr('data-length')),
            pageLength: parseInt($('.data_table_yajra').attr('data-length')),
            // responsive: true
        });

    }

    $(document).on('click', '.OpenModal', function () {
        var url = $(this).attr('data-href');
        var id = $(this).attr('data-id');
        var formData = new FormData();
        formData.append('id', id);
        var modal_name = $(this).attr('data-name');
        if (modal_name == 'get-multi-option-modal') {
            if ($(".selectCheckBox:checked").length == 0) {
                alert('Bitte wählen Sie mindestens 1 Zeile');
                return false;
            }
            var rowId = [];
            $(".selectCheckBox:checked").each(function () {
                rowId.push($(this).attr('data-row-id'));
            })
            formData.append('id', rowId.join(','));
        }
        OpenModal($(this), url, formData, modal_name);
    })

    $(document).on('change', "#selectAllCheckbox", function () { //"select all" change
        $(".selectCheckBox").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
        if ($(this).prop("checked") === true)
            $('.filterButton').removeClass('invisible').addClass('visible');
        else
            $('.filterButton').removeClass('visible').addClass('invisible');
    });
    $(document).on('change', '.selectCheckBox', function () {

        if (false == $(this).prop("checked")) {
            $("#selectAllCheckbox").prop('checked', false);
        } else {
            $('.filterButton').removeClass('invisible').addClass('visible');
        }

        if ($('.selectCheckBox:checked').length === 0)
            $('.filterButton').removeClass('visible').addClass('invisible');

        if ($('.selectCheckBox:checked').length == $('.selectCheckBox').length) {
            $("#selectAllCheckbox").prop('checked', true);
        }

    });

    $(document).on('click', '#filterDomainButton', function () {
        var url = window.location.origin + window.location.pathname;
        var is_deleted = "";
        var title = "";
        var info_de = "";
        var info_en = "";
        var per_page = "";
        var filterParams = new Object();
        if ($('select[name="is_deleted"]').val().length > 0) {
            filterParams.is_deleted = $('select[name="is_deleted"]').val();
        }
        if ($('select[name="title"]').val().length > 0) {
            filterParams.title = $('select[name="title"]').val();
        }
        if ($('select[name="info_de"]').val().length > 0) {
            filterParams.info_de = $('select[name="info_de"]').val();
        }
        if ($('select[name="info_en"]').val().length > 0) {
            filterParams.info_en = $('select[name="info_en"]').val();
        }
        if ($('select[name="per_page"]').val().length > 0) {
            filterParams.per_page = $('select[name="per_page"]').val();
        }
        if (!jQuery.isEmptyObject(filterParams)) {
            window.location.replace(url + "?" + $.param(filterParams));
        } else {
            window.location.reload();
        }
    })

    $(document).on('click', '#filterStatisticsButton', function () {
        var startDate = $('#dateRangePicker').data('daterangepicker').startDate.format("YYYY-MM-DD");
        var endDate = $('#dateRangePicker').data('daterangepicker').endDate.format("YYYY-MM-DD");
        var per_page = $('select[name="per_page"]').val();
        var url = window.location.origin + window.location.pathname;
        window.location.replace(url + "?from_date=" + startDate + "&to_date=" + endDate + "&per_page=" + per_page);
    })

    $(document).on('click', '#filterSubmitButton', function () {
        var perPage = $('select[name="per_page"]').val();
        $('.data_table_yajra').attr('data-length', perPage);
        getInquirySearchFilers();
        yajraManual();
        $('#adominoModal').modal('toggle');
        //     yajraTable.page.len(perPage).draw();
    })

    if ($('.data_table_yajra_manual').length > 0) {
        $('.data_table_yajra_manual').DataTable({
            bLengthChange: false,
            searching: false,
            "oLanguage": {
                "sEmptyTable": "Keine Daten in der Tabelle vorhanden",
                "sInfo": "_START_ bis _END_ von _TOTAL_ Einträgen",
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
            },
            pageLength: -1,
            paging: false,
        });
    }

    $(document).on('click', '.sort', function () {
        var mode = $(this).attr('data-mode');
        var id = $(this).attr('data-id');
        var url = $(this).attr('data-url');
        var formdata = new FormData();
        formdata.append('mode', mode);
        formdata.append('id', id);
        sendAjaxRequest(formdata, url, function (data) {
            yajraTable.ajax.reload();
        }, $(this))
    })

    $('.chooseFileButton').click(function () {
        $(this).closest('.form-group').find('input[type="file"]').click();
        $('#logoFile').change(function () {
            var file = $(this)[0].files[0]
            if (file) {
                $(this).closest('.form-group').find('#file_name').html(file.name);
            } else {
                $(this).closest('.form-group').find('#file_name').html('Keine Datei ausgewählt');
            }
        });
    })

    if ($('#dateTimePicker').length > 0) {
        $('#dateTimePicker').datetimepicker({
            date: $('#dateTimePicker').val(),
            icons: {time: 'far fa-clock'}
        });
    }
    // $('#yajraSearch').on('keyup', function () {
    //     yajraTable.ajax.reload();
    // })

    $('.yajraBtnSearch').on('click', function () {
        var inputVal = $('#yajraSearch').val();
        // if (inputVal.length > 0) {
        yajraManual();
        // yajraTable.ajax.reload();
        // }
    })

    $('#deleteLogoButton').click(function () {
        $('#preview_logo').remove();
    })
})