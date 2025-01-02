@if (session('error'))
    <div class="mb-4 p-4 bg-red-200 text-red-800 rounded-lg">
        {{ session('error') }}
    </div>
@endif