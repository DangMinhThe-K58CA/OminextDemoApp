<!-- resources/views/auth/register.blade.php -->

<form method="POST" action="/registerProcessing">
    {!! csrf_field() !!}

    <div>
        Name
        <input type="text" name="name" value="{{ old('name') }}">
    </div>

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password">
    </div>

    <div>
        Confirm Password
        <input type="password" name="password_confirmation">
    </div>
    <div>
        <p style="color:red;">{{$error}}</p>
    </div>
    <div>
        <button type="submit">Register</button>
    </div>
</form>
 <div>
    <button onclick = "window.location.href = '/show'">Cancel</button>
</div>