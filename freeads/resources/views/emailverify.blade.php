@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-xl font-bold mb-4">Verify Your Email</h1>
    <p>Please check your email and click the verification link to activate your account.</p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Resend Verification Email
        </button>
    </form>
</div>
@endsection
