


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Muhamad Nauval Azhar">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="This is a login page template based on Bootstrap 5">
	<title>Bootstrap 5 Login Page</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
						<img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo" width="100">
					</div>

                <div class="my-3">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') ?? '' }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') ?? '' }}</div>
                    @endif
                </div>
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">Register</h1>
							<form method="POST" class="needs-validation" novalidate="" action="{{ route('post.register') }}" enctype="multipart/form-data" autocomplete="off">
								@csrf
                                <div class="mb-3">
									<label class="mb-2 text-muted" for="name">Name</label>
									<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                    @error('name')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">E-Mail Address</label>
									<input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
								</div>
                                <div class="mb-3">
                                    <label for="av" class="form-label">Role</label>
                                    <select name="role" class="form-control" id="#roleid">
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" >{{ $role->libelle }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">Upload your avatar</label>
									<input id="avatar" type="file" class="form-control" name="avatar" value="{{ old('avatar') }}" required>
                                    @error('avatar')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="password">Password</label>
									<input id="password" type="password" class="form-control" name="password" required>
                                        @error('password')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
								</div>

								<p class="form-text text-muted mb-3">
									By registering you agree with our terms and condition.
								</p>

								<div class="align-items-center d-flex">
									<button type="submit" class="btn btn-primary ms-auto">
										Register
									</button>
								</div>
							</form>
						</div>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								Already have an account? <a href="{{ route('login') }}" class="text-dark">Login</a>
							</div>
						</div>
					</div>
					<div class="text-center mt-5 text-muted">
						Copyright &copy; 2017-2021 &mdash; Your Company
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/login.js"></script>
</body>
</html>
