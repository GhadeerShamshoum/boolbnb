@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Benvenuto, {{Auth::user()->name}}.
                    <div>                        
                        <a href="{{route('admin.apartments.index')}}">Visualizza i tuoi appartamenti</a>
                    </div>
                    <div>
                        <a href="{{route('admin.apartments.create')}}">Aggiungi un nuovo appartamento</a>                  
                    </div>
                    <div>
                        <a href="{{route('admin.home')}}">Vedi il tuo profilo</a>                                  
                    </div>
                    <div>
                        <a href="{{ url('/') }}">Torna alla Home</a>                                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
