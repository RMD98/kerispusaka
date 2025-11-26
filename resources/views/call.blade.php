<form method="POST" action="call">
  @csrf
  <label for="name">Your Name:</label>
  <input type="text" name="name" required>
  <button type="submit">Call Now</button>
</form>
