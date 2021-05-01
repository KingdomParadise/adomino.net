@extends('layouts.auth')
@section('content')
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <img src="{{url('img/logo.png')}}" style="width: 60%; margin-left:12px;"/>
            </div>
            <div class="card-body">
                <p>Die Zwei-Faktor-Authentifizierung (2FA) erhöht die Zugriffssicherheit, indem zwei Methoden
                    (auch als Faktoren bezeichnet) zur Überprüfung Ihrer Identität erforderlich sind. Die
                    Zwei-Faktor-Authentifizierung schützt vor Phishing-, Social Engineering- und
                    Passwort-Brute-Force-Angriffen und schützt Ihre Anmeldungen vor Angreifern, die schwache
                    oder gestohlene Anmeldeinformationen ausnutzen.</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                Geben Sie die PIN über die Google Authenticator-App ein:<br/><br/>
                <form class="form-horizontal" action="{{ route('2faVerify') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('one_time_password-code') ? ' has-error' : '' }}">
                        <label for="one_time_password" class="control-label">Einmaliges Passwort</label>
                        <input id="one_time_password" name="one_time_password" class="form-control"
                               type="text" required/>
                    </div>
                    <button class="btn btn-primary float-right" type="submit">Authentifizieren</button>
                </form>
            </div>
        </div>
    </div>
    {{--<div class="container">--}}
        {{--<div class="row justify-content-md-center">--}}
            {{--<div class="col-md-8 ">--}}
                {{--<div class="card">--}}
                    {{--<div class="card-header">Zwei-Faktor-Authentifizierung</div>--}}
                    {{--<div class="card-body">--}}
                        {{----}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection