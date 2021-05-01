@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">

            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    {{--<div class="card-header">--}}
                    {{--<h3 class="card-title" style="margin-top: 5px;"></h3>--}}
                    {{--</div>--}}
                    <div class="card-body">
                        <form action="{{route('epp-domain-process')}}" method="post">
                            @csrf
                            <div class="form-group has-search input-group">
                                <span class="fa fa-search form-control-feedback"></span>
                                <input type="text" class="form-control" required name="domain_name"
                                       @if(isset($search))value="{{$search}}"
                                       @endif placeholder="domain.ch">
                                <span class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Suchen</button>
                                    </span>
                            </div>
                        </form>
                        <div class="domainInfo">
                            @if(isset($error) && !empty($error))
                                <p class="epp_error">{{$error}}</p>
                            @else
                                @if(isset($search) && !empty($search))
                                    <h3 class="EppInfoH3">Registrant</h3>
                                    <div class="domainInfoTexts">{{$registrant}}</div>
                                    <h3 class="EppInfoH3">Contacts</h3>
                                    <div class="domainInfoTexts">
                                        @foreach($contacts as $contact)
                                            {{ $contact['type'] }}: {{ $contact['handle'] }}
                                        @endforeach
                                    </div>
                                    <h3 class="EppInfoH3">Nameservers</h3>
                                    @foreach($nameservers as $nameserver)
                                        <div class="domainInfoTexts">
                                            {{ $nameserver }}
                                        </div>
                                    @endforeach
                                    @if(isset($expiration_date))
                                        <h3 class="EppInfoH3">Expiration Date</h3>
                                        <div class="domainInfoTexts">
                                            {{$expiration_date}}
                                        </div>
                                    @endif
                                    @if(isset($statuses))
                                        <h3 class="EppInfoH3">Status</h3>
                                        <ul>
                                            @foreach($statuses as $status)
                                                <li class="domainInfoTexts">{{ $status }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection