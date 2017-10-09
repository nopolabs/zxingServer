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
                                <pre>curl -F 'image=@resources/barcode.jpg' {{ env('APP_URL') }}/api -H 'Authorization: Bearer {{ $token }}'</pre>
                            @else
                                <a href="{{ route('createToken') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('createToken-form').submit();">
                                    Create API Token
                                </a>
                                <form id="createToken-form" action="{{ route('createToken') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
