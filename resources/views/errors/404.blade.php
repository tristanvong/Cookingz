@extends('layouts.main')
@section('title', '404 Not Found')
@section('content')
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    
    <div class="text-center p-6 bg-white rounded-lg shadow-lg">
        
        <div class="flex items-center justify-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-12 h-12 text-red-500 mr-2" fill="currentColor">
                <path d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480L40 480c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24l0 112c0 13.3 10.7 24 24 24s24-10.7 24-24l0-112c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"/>
            </svg>
            <h1 class="text-6xl font-bold text-red-500">
                Error {{ $exception->getStatusCode() }}
            </h1>
        </div>
        
        <p class="text-lg text-gray-700 mb-6">
            {{ $exception->getMessage() ?: 'Something was not found.' }}
        </p>
        <a href="{{ url('/') }}"
           class="inline-block px-6 py-3 text-white bg-blue-500 rounded-lg shadow hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">
            Go Back to Home
        </a>
    </div>
</body>
@endsection
