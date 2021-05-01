$(function () {
    $(".alert").delay(3000).slideUp(300);
    moment.tz.setDefault("Europe/Vienna");
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
                    // "type": "string-locale-mapped-int",
                    // "orderDataType": "string-locale-mapped-int"
                })
            } else {
                columnDefs.push({
                    "orderable": ($(this).attr('data-sort') == '1') ? true : false,
                    "targets": v,
                    "width": $(this).attr('data-width'),
                    // "type": "string-locale-mapped-int",
                    // "orderDataType": "string-locale-mapped-int"
                })
            }

        }
        var data = {data: $(this).attr('data-column'), name: $(this).attr('data-column')};
        columns.push(data)
    })

    function getInquirySearchFilers() {
        if ($('.data_table_yajra').attr('data-table-name') !== undefined && $('.data_table_yajra').attr('data-table-name') == 'inquiry-table') {
            // $('.data_table_yajra').attr('data-table-filter', '{"no_of_days":"' + $('input[name="no_of_days"]').val() + '","trashed":"' + $('select[name="trashed"]').val() + '"}');
            $('.data_table_yajra').attr('data-filter', '{"trashed":"' + $('select[name="trashed"]').val() + '"}');
        }
    }

    var yajraTable;
    var searchInputWidth;

    function yajraManual() {

        yajraTable = $('.data_table_yajra').DataTable({
            processing: true,
            bLengthChange: false,
            searching: false,
            fixedColumns: true,
            language: {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>'
            },
            oLanguage: getDataTableLanguage(),
            serverSide: true,
            destroy: true,
            ajax: function (data, callback) {
                data.filter = $('.data_table_yajra').attr('data-filter');
                data.search = {regex: false, value: $('#yajraSearch').val()};
                $.ajax({
                    url: $('.data_table_yajra').attr('data-url'),
                    data: data,
                    dataType: 'json',
                    beforeSend: function () {
                        $('.data_table_yajra > tbody').html("");
                    },
                    success: function (res) {
                        if ($('.data_table_yajra').attr('data-table-name') !== undefined && ($('.data_table_yajra').attr('data-table-name') == 'logo-table' || $('.data_table_yajra').attr('data-table-name') == 'not-found-domain-table')) {
                            $.each(res.data, function (key, value) {
                                // res.data[key].id = '<p style="text-align: right;margin: 0px">' + (key + 1) + '</p>';
                                res.data[key].consecutive = '<p style="text-align: right;margin: 0px">' + (key + 1) + '</p>';
                            })
                        }
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
            pageLength: parseInt($('.data_table_yajra').attr('data-length')),
            autoWidth: false
        });
        yajraTable.columns().iterator('column', function (ctx, idx) {
            if (!$(yajraTable.column(idx).header()).hasClass('no-sort')) {
                $(yajraTable.column(idx).header()).append('<span class="sort-icon"/>');
            }
        });
        // yajraTable.columns().iterator('column', function (ctx, idx) {
        //     $(yajraTable.column(idx).header()).append('<span class="sort-icon"/>');
        // });
    }

    // $('#datemask').inputmask('yyyy-mm-dd HH:mm', {'placeholder': 'yyyy-mm-dd HH:mm'})

    $(document).on('click', '.OpenModal', function () {
        var url = $(this).attr('data-href');
        var id = $(this).attr('data-id');
        var formData = new FormData();
        formData.append('id', id);
        var modal_name = $(this).attr('data-name');
        if (modal_name == 'get-multi-option-modal' && (id === undefined || id == '')) {
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


    $(document).on('change', 'select[name="domain_filter_info_de"]', function () {
        $('input[name="info_de"]').val($(this).val());
    })
    $(document).on('change', 'select[name="domain_filter_info_en"]', function () {
        $('input[name="info_en"]').val($(this).val());
    })
    $(document).on('change', 'select[name="domain_filter_title"]', function () {
        $('input[name="title"]').val($(this).val());
    })
    $(document).on('change', 'select[name="domain_filter_is_deleted"]', function () {
        $('input[name="is_deleted"]').val($(this).val());
    })


    $(document).on('click', '#filterDomainButton', function () {
        domainFilterSearch();
    })

    function domainFilterSearch() {
        var url = window.location.origin + window.location.pathname;
        var is_deleted = "";
        var title = "";
        var info_de = "";
        var info_en = "";
        var per_page = "";
        var search_params = "";
        var filterParams = new Object();
        if ($('input[name="is_deleted"]').val().length > 0) {
            filterParams.is_deleted = $('input[name="is_deleted"]').val();
        } else {
            filterParams.is_deleted = "";
        }
        if ($('input[name="title"]').val().length > 0) {
            filterParams.title = $('input[name="title"]').val();
        } else {
            filterParams.title = "";
        }
        if ($('input[name="info_de"]').val().length > 0) {
            filterParams.info_de = $('input[name="info_de"]').val();
        } else {
            filterParams.info_de = "";
        }
        if ($('input[name="info_en"]').val().length > 0) {
            filterParams.info_en = $('input[name="info_en"]').val();
        } else {
            filterParams.info_en = "";
        }
        if ($('#yajraSearch').val().length > 0) {
            filterParams.search_params = $('#yajraSearch').val();
        } else {
            filterParams.search_params = "";
        }
        if (!jQuery.isEmptyObject(filterParams)) {
            filterParams.is_filtered = true;
            window.location.replace(url + "?" + $.param(filterParams));
        } else {
            window.location.reload();
        }
    }

    if ($('#yajraSearch').length > 0) {
        var value = $('#yajraSearch').val();
        if (value.length > 0 && $('.data_table_yajra').length > 0) {
            $(document).ready(function () {
                yajraBtnSearch()
            })
        }
    }

    $(document).on('click', '#filterStatisticsButton', function () {
        var no_of_days = $('input[name="no_of_days"]').val();
        if (no_of_days < 0) {
            no_of_days = 1;
        }
        var searchVal = $('#yajraSearch').val();
        var from_date = "";
        if ($('.singleDatePicker').length > 0) {
            $('.data_table_yajra_manual').attr('data-from-date', $('.singleDatePicker').val())
        }

        if ($('.data_table_yajra_manual').attr('data-from-date') !== undefined) {
            from_date = $('.data_table_yajra_manual').attr('data-from-date');
        }
        // $('.data_table_yajra').attr('data-table-filter', '{"no_of_days":' + no_of_days + '}')
        // yajraManual();
        // $('#adominoModal').modal('toggle');
        // var startDate = $('#dateRangePicker').data('daterangepicker').startDate.format("YYYY-MM-DD");
        // var endDate = $('#dateRangePicker').data('daterangepicker').endDate.format("YYYY-MM-DD");
        // var per_page = $('select[name="per_page"]').val();
        var url = window.location.origin + window.location.pathname;
        // window.location.replace(url + "?from_date=" + startDate + "&to_date=" + endDate + "&per_page=" + per_page);
        window.location.replace(url + "?no_of_days=" + no_of_days + "&from_date=" + from_date + "&search=" + searchVal);
    })

    $(document).on('click', '#filterSubmitButton', function () {
        var perPage = $('select[name="per_page"]').val();
        $('.data_table_yajra').attr('data-length', perPage);
        getInquirySearchFilers();
        yajraManual();
        $('#adominoModal').modal('toggle');
        //     yajraTable.page.len(perPage).draw();
    })
    var manualTable;
    if ($('.data_table_yajra_manual').length > 0) {
        var dtOptions = {
            bLengthChange: false,
            searching: false,
            columnDefs: [{
                'searchable': true,
                "type": "string-locale-mapped-int",
                "orderDataType": "string-locale-mapped-int",
                "targets": [2]
            }],
            oLanguage: getDataTableLanguage(),
            pageLength: -1,
            paging: false,
            drawCallback: function (settings) {
                if ($('.data_table_yajra_manual').attr('data-table-name') == 'statistics-table') {
                    var tableSummary = JSON.parse($('.data_table_yajra_manual').attr('data-summen'));
                    var row = $('<tr>')
                        .append('<td colspan="2"></td>')
                        .append('<td style="display: none"></td>')
                        .append('<td style="text-align: end">Summen</td>')
                    $.each(tableSummary, function () {
                        if (this % 1 === 0) {
                            row.append('<td style="text-align:right"><b>' + this + '</b></td>')
                        } else {
                            row.append('<td style="text-align:right"><b>' + this.toFixed(1) + '</b></td>')
                        }
                    })
                    $('.data_table_yajra_manual tbody').prepend(row);
                }
            },
            destroy: true,
            order: ($('.data_table_yajra_manual').attr('data-custom-order') !== undefined) ? [parseInt($('.data_table_yajra_manual').attr('data-custom-order')), ($('.data_table_yajra_manual').attr('data-custom-sort-type') !== undefined) ? $('.data_table_yajra_manual').attr('data-custom-sort-type') : 'desc'] : [2, 'asc'],
            initComplete: function (settings, json) {
                if ($('.data_table_yajra_manual').attr('data-table-name') !== undefined && ($('.data_table_yajra_manual').attr('data-table-name') == 'statistics-table' || $('.data_table_yajra_manual').attr('data-table-name') == 'domains-table')) {
                    $('#selectedInfoSpan').text($('#DataTables_Table_0_info').text())
                    $('#DataTables_Table_0_info').text("")
                }
            },
            autoWidth: ($('.data_table_yajra_manual').attr('data-table-name') == 'statistics-table') ? false : true
        };
        if ($('.data_table_yajra_manual').attr('data-table-name') == 'statistics-table') {
            dtOptions.aaSorting = [];
            $("#statisticLoader").hide();
        }
        manualTable = $('.data_table_yajra_manual').DataTable(dtOptions);
        manualTable.columns().iterator('column', function (ctx, idx) {
            if (!$(manualTable.column(idx).header()).hasClass('no-sort')) {
                $(manualTable.column(idx).header()).append('<span class="sort-icon"/>');
            }
        });
    }

    $(document).on('click', '.data_table_yajra_manual thead th', function () {
        var tableData = [];
        $.each(manualTable.rows().data(), function (key, value) {
            var data = $(this);
            data[0] = '<p style="text-align: right;margin: 0px">' + (key + 1) + '</p>';
            tableData.push(data)
        })
        manualTable.clear();
        manualTable.rows.add(tableData).draw()
    })

    if ($('.data_table_yajra').length > 0) {
        if ($('.data_table_yajra').attr('data-table-show') !== undefined && $('.data_table_yajra').attr('data-table-show') == '1') {
            yajraManual();
        }
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
        yajraBtnSearch();
    })

    function yajraBtnSearch() {
        var inputVal = $('#yajraSearch').val();
        if ($('.data_table_yajra').length > 0 && $('.data_table_yajra').attr('data-table-name') !== undefined) {
            yajraManual();
        } else {
            domainFilterSearch()
        }
    }

    $('#yajraSearch,input[name="no_of_days"]').keypress(function (e) {
        if (e.which == 13) {
            if ($('#filterStatisticsButton').length > 0) {
                $('#filterStatisticsButton').click();
            } else {
                $('.yajraBtnSearch').click();
            }
        }
    });

    $('#deleteLogoButton').click(function () {
        $('#preview_logo').remove();
        $('#file_name').text('No file selected');
        $('#delete-confirmation-modal').modal('toggle')
    })

    if ($('#clock').length > 0) {
        setInterval(time, 500)
    }

    if ($('.created_at_inquiry').length > 0) {
        setInterval(function () {
            $('.created_at_inquiry').val(moment().format('YYYY-MM-DD HH:mm'))
        }, 500)
    }

    function time() {
        var clock = document.getElementById('clock');
        clock.innerHTML = moment().format('HH:mm:ss');
    }
})