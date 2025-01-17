@extends('layouts.admin')
@section('title', 'Contact Forms')
@section('content')
<div class="container mx-auto mt-8 mb-8 px-4 md:w-4/5 lg:w-3/4">
    <h1 class="text-3xl font-semibold text-white mb-6">Contact Forms</h1>
    <x-error-message />
    <x-success-message />
    
    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Message</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contactForms as $form)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $form->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $form->email }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit($form->message, 100) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $form->status === 'replied' ? 'Replied' : 'Pending' }}</td>                        <td class="px-6 py-4 text-sm flex items-center space-x-2">
                            <a href="{{ route('admin.contactForms.show', $form->id) }}" class="inline-block text-blue-600 hover:text-blue-800">
                                View
                            </a>
                            @if($form->status === 'replied')
                                <form action="{{ route('admin.contactForms.destroy', $form->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this contact form?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor" class="w-5 h-5">
                                            <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"/>
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection