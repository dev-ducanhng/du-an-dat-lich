<form action="" method="POST">
    @csrf
    <input type="text" name="email">
    @error('email')
    <p class="text-danger">{{$message}}</p>
@enderror
    <input type="password" name="password">
    @error('password')
    <p class="text-danger">{{$message}}</p>
@enderror
    <button type="submit">OK</button>
</form>