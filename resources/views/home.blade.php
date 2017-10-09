@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">

                    @if (isset($path) || isset($barcode))
                        @if (isset($path))
                            <div>
                                <img width="200px" src="{{ Storage::disk('public')->url($path) }}"/>
                            </div>
                        @endif

                        @if (isset($barcode))
                            <div>
                                {{ $barcode }}
                            </div>
                        @endif
                    @else
                        Upload a barcode.
                    @endif
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="/" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input type="file" name="image"/>

                        <button type="submit">Scan Barcode</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
