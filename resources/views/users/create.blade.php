<x-layout>
    <x-slot name="title">
        Sign up
    </x-slot>

    <form action="/users" accept-charset="UTF-8" method="post">
        @csrf

        @if ($errors->any())
            <div id="error_explanation">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="field">
            <label for="user_name">Name</label>
            <input type="text" name="name" id="user_name" value="{{ old('name') }}">
        </div>

        <div class="field">
            <label for="user_email">Email</label>
            <input type="email" name="email" id="user_email" value="{{ old('email') }}">
        </div>

        <div class="field">
            <label for="user_password">Password</label>
            <input type="password" name="password" id="user_password">
        </div>

        <div class="field">
            <label for="user_password_confirmation">Password confirmation</label>
            <input type="password" name="password_confirmation" id="user_password_confirmation">
        </div>

        <div class="actions">
            <input type="submit" value="Create my account" id="submit">
        </div>
    </form>

</x-layout>
