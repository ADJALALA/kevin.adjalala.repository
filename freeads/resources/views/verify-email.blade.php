@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Vérification d\'email nécessaire') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="alert alert-info">
                        <p>{{ __('Un lien de vérification a été envoyé à votre adresse email.') }}</p>
                        <p>{{ __('Avant de pouvoir accéder à votre compte, vous devez vérifier votre adresse email.') }}</p>
                    </div>

                    <p>{{ __('Si vous n\'avez pas reçu l\'email,') }}</p>
                    
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            {{ __('Renvoyer l\'email de vérification') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection