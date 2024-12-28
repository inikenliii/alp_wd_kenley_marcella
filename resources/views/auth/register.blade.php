<form method="POST" action="/register">
    @csrf
    <input type="text" name="username" placeholder="Username" required>
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="text" name="phone_number" placeholder="Phone Number" required>
    <input type="text" name="address" placeholder="Address" required>
    <input type="date" name="birth_date" placeholder="Birth Date" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
    <button type="submit">Register</button>
</form>