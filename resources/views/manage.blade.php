@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        Manage
                    </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div>
                            @if (isset($token))
                                <label for="token">API token</label>
                                <input id="token" value="{{ $token }}">
                                <button class="copy-btn" data-clipboard-target="#token">
                                    <img src="assets/images/clippy.svg" alt="Copy to clipboard" width="13">
                                </button>
                                <br/>
                                <label for="curl-example">Curl example</label>
                                <textarea id="curl-example" style="width: 690px; height: 400px;">curl -F 'image=@resources/barcode.jpg' {{ env('APP_URL') }}/api -H 'Authorization: Bearer {{ $token }}'</textarea>
                                <button class="copy-btn" data-clipboard-target="#curl-example">
                                    <img src="assets/images/clippy.svg" alt="Copy to clipboard" width="13">
                                </button>
                            @else
                                <a href="{{ route('createToken') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('createToken-form').submit();">
                                    Create API Token
                                </a>
                                <form id="createToken-form" action="{{ route('manage') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    <input name="createToken" type="hidden" value="true">
                                </form>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
