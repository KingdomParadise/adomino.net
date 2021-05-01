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

                    <div class="card-body">
                        <h3 class="EppInfoH3">Messages</h3>
                        <div class="domainInfoTexts">
                            There are {{ $poll['count'] }} message(s) in the queue.
                        </div>

                        <h3 class="EppInfoH3">
                            Message ID : {{ $poll['message_id'] }}
                        </h3>

                        @if(isset($poll['date']))
                            <div class="domainInfoTexts">
                                Date: {{ $poll['date'] }}
                            </div>
                        @endif

                        <div class="domainInfoTexts">{{ $poll['msg'] }}</div>
                        @if(!empty($poll['message_id']))
                            <form action="{{route('poll-ack')}}"
                                  method="post">
                                @csrf
                                <input type="hidden" name="message_id" value="{{ $poll['message_id'] }}"/>
                                <div>
                                    <button type="submit"
                                            class="btn btn-secondary btn-sm poll-button">
                                        Delete
                                    </button>
                                </div>
                            </form>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection