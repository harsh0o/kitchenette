<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Gardening Solution">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="This is a login page template based on Bootstrap 5">
	<title>Kitchenetee</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
						<!-- <img src="https://icon-library.com/images/patient-information-online-registration-hospital-document-512_107076.png" alt="logo" width="100"> -->
					</div>
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">Register</h1>
							<form  action="{{route('register.submit')}}" method="POST" class="needs-validation" novalidate="" autocomplete="off">
								{{ csrf_field() }}
								<div class="mb-3">
									<label class="mb-2 text-muted" for="name">Name</label>
									<input id="name" type="text" class="form-control" name="full_name" value="{{old('full_name')}}" required autofocus>
									@error('full_name')
									<p class="text-danger">{{$message}}</p>
								  @enderror
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" value="{{old('email')}}" required>
									@error('email')
									<p class="text-danger">{{$message}}</p>
								  @enderror
								</div>

                                <div class="mb-3">
									<label class="mb-2 text-muted" for="email">City</label>
									<select name="city_id" class="form-control show-trick ">
                                        <option value="">--Add/update City--</option>
                                        
                                        @foreach (\App\Models\City::get() as $city)
                                        <option value="{{ $city->id }}">{{ $city->name}}</option> 
                                        @endforeach
                                        
                                        
                                    </select>
									@error('city')
									<p class="text-danger">{{$message}}</p>
								  @enderror
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="password">Password</label>
									<input id="password" type="password" class="form-control" name="password" required>
								   @error('password')
									<p class="text-danger">{{$message}}</p>
								  @enderror
								</div>
								<div class="mb-3">
									<label class="mb-2 text-muted" for="password">Confirm Password</label>
									<input id="password" type="password" class="form-control" name="password_confirmation" required>
								  
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
								@if (Route::has('login'))
									Already have an account?  <a class="text-dark" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @endif
							</div>
						</div>
					</div>
					<div class="text-center mt-5 text-muted">
						Copyright &copy; 2017-2021 &mdash; Kitchenetee
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/login.js"></script>
</body>
</html>
