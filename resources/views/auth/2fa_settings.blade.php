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
                    <div class="card-header"><strong>Zwei-Faktor-Authentifizierung</strong></div>
                    <div class="card-body">
                        <p>Die Zwei-Faktor-Authentifizierung (2FA) erhöht die Zugriffssicherheit, indem (auch) zwei
                            Methoden erforderlich sind
                            bezeichnet als Faktoren), um Ihre Identität zu überprüfen. Zwei-Faktor-Authentifizierung
                            schützt vor
                            Phishing, Social Engineering und Passwort Brute Force greifen an und schützen Ihre Logins
                            vor
                            Angreifer, die schwache oder gestohlene Anmeldeinformationen ausnutzen.</p>

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($data['user']->loginSecurity == null)
                            <form class="form-horizontal" method="POST" action="{{ route('generate2faSecret') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Generieren Sie einen geheimen Schlüssel, um 2FA zu aktivieren
                                    </button>
                                </div>
                            </form>
                        @elseif(!$data['user']->loginSecurity->google2fa_enable)
                            1. Scannen Sie diesen QR-Code mit Ihrer Google Authenticator App. Alternativ können Sie die
                            verwenden
                            Code: <code>{{ $data['secret'] }}</code><br/>
                            <img src="{{$data['google2fa_url'] }}" alt="">
                            <br/><br/>
                            2. Geben Sie die PIN über die Google Authenticator-App ein:<br/><br/>
                            <form class="form-horizontal" method="POST" action="{{ route('enable2fa') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('verify-code') ? ' has-error' : '' }}">
                                    <label for="secret" class="control-label">Authentifizierungscode</label>
                                    <input id="secret" type="password" class="form-control col-md-4" name="secret"
                                           required>
                                    @if ($errors->has('verify-code'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('verify-code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Aktivieren Sie 2FA
                                </button>
                            </form>
                        @elseif($data['user']->loginSecurity->google2fa_enable)
                            <div class="alert alert-success">
                                2FA ist derzeit <strong>aktiviert</strong> Auf deinem Konto.
                            </div>
                            <p>Wenn Sie die Zwei-Faktor-Authentifizierung deaktivieren möchten. Bitte bestätigen Sie Ihr Passwort und
                                Klicken Sie auf die Schaltfläche 2FA deaktivieren.</p>
                            <form class="form-horizontal" method="POST" action="{{ route('disable2fa') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                    <label for="change-password" class="control-label">Jetziges Passwort</label>
                                    <input id="current-password" type="password" class="form-control col-md-4"
                                           name="current-password" required>
                                    @if ($errors->has('current-password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary ">Deaktivieren Sie 2FA</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection