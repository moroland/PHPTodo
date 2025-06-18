<div class="container border">
    <h1>Login</h1>
    <form class="form-horizontal" target="_self" action="/login" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" placeholder="Username" required
                   class="form-control">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" placeholder="Password" required
                   class="form-control">
        </div>
        <div class="mb-3">
            <input type="submit" value="Login" class="btn btn-primary">
        </div>
    </form>
</div>