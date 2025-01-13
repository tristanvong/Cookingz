@extends('layouts.main')
@section('title', 'Food Types')
@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-4xl font-bold text-white">Food Types</h1>
        <a href="{{ route('foodtypes.create') }}"
           class="py-2 px-4 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
            Create Food Type
        </a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-left py-2 px-4 font-semibold text-gray-700">#</th>
                    <th class="text-left py-2 px-4 font-semibold text-gray-700">Name</th>
                    <th class="text-left py-2 px-4 font-semibold text-gray-700">Description</th>
                    <th class="text-left py-2 px-4 font-semibold text-gray-700 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($foodTypes as $foodType)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-2 px-4">{{ $loop->iteration }}</td>
                        <td class="py-2 px-4">{{ $foodType->name }}</td>
                        <td class="py-2 px-4">{{ $foodType->description }}</td>
                        <td class="py-2 px-4 flex space-x-4">
                            <a href="{{ route('foodtypes.edit', $foodType->id) }}"
                               class="py-2 px-4 bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition">
                                Edit
                            </a>

                            <form action="{{ route('foodtypes.destroy', $foodType->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                        class="py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-600">No food types found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection