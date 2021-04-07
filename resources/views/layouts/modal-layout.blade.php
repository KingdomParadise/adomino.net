@if(isset($big_modal))
    <style>
        @media (min-width: 992px) {
            .modal-lg {
                max-width: 700px !important;
            }
        }
    </style>
@endif
<div class="modal fade" id="adominoModal"
     {{--     @if(isset($physical_close)) data-backdrop="static" data-keyboard="false" @endif--}}
     tabindex="-1" role="dialog" style="z-index: 99999999999;">
    <div class="modal-dialog @if(isset($big_modal)) modal-lg @endif" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">{{$ModalTitle}}</h4>
            </div>
            @yield('content')
        </div>
    </div>
</div>


