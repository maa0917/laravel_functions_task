<x-layout>
    <x-slot name="title">
    </x-slot>

    <p>
        <strong>Name:</strong>
        {{ $user->name }}
    </p>

    <p>
        <strong>Email:</strong>
        {{ $user->email }}
    </p>
</x-layout>
