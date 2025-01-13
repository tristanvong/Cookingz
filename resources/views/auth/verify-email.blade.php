@extends('layouts.main')
@section('title', 'Verify Email')
@section('content')
   <div class="container mx-auto mt-8 mb-8 px-4 md:w-1/2 lg:w-1/3 bg-white p-6 rounded-lg shadow-md items-center">
        <div class="mb-4 text-sm text-black">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>
    
        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif
    
        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
    
                <div>
                    <button class="bg-amber-600 text-white rounded-md px-4 py-2 hover:bg-amber-700">
                    Resend Verification Email
                    </button>
                </div>
            </form>
    
            <form method="POST" action="{{ route('logout') }}">
                @csrf
    
                <button type="submit" class="underline text-sm text-amber-600 text-amber-500 hover:text-amber-600 rounded-md">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
   </div>
@endsection