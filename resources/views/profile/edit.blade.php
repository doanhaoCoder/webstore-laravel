<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>Edit Profile</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('profile.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name"><strong>Name:</strong></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email"><strong>Email:</strong></label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="username"><strong>Username:</strong></label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
                    </div>
                    <div class="form-group">
                        <label for="phone"><strong>Phone:</strong></label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                    </div>
                    <div class="form-group">
                        <label for="address"><strong>Address:</strong></label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
                    </div>
                    <div class="form-group">
                        <label for="password"><strong>New Password:</strong></label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation"><strong>Confirm Password:</strong></label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
