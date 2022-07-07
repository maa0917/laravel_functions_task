<x-layout>

    <x-slot name="title">
        Log in
    </x-slot>

    <form action="{{ route('sessions.store') }}" accept-charset="UTF-8" method="post">
        @csrf

        <div class="field">
            <label for="session_email">Email</label>
            <input type="email" name="email" id="session_email">
        </div>

        <div class="field">
            <label for="session_password">Password</label>
            <input type="password" name="password" id="session_password">
        </div>

        <div class="actions">
            <input type="submit" value="Log in">
        </div>
    </form>

</x-layout>
