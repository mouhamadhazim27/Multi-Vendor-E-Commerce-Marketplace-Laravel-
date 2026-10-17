<x-auth.layout title="Register">

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-8 col-lg-6">

                <div class="card shadow">
                    <div class="card-body p-4">

                        <h3 class="text-center mb-4">Create Account <img src="/assets/image/plathaz.png" alt="Logo"
                                height="40" class="me-2"></h3>

                        <form action="{{ route('register.action') }}" method="POST" >
                            @csrf

                            <!-- Name Row -->

                            <div class=" mb-3">
                                <label class="form-label">Company Name or Individual Name </label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Company Name or Individual Name..." >
                                @error('name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>



                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control " placeholder="Enter email">
                                @error('email')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" name="phone" class="form-control "
                                    placeholder="Enter phone number">
                                @error('phone')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>



                            <!-- Password Row -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control "
                                        placeholder="Enter password" >
                                    @error('password')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control "
                                        placeholder="Confirm password" >
                                </div>
                            </div>

                            <!-- Terms -->
                            <div class="form-check mb-3">
                                <input class="form-check-input " name="policy" type="checkbox" >
                                <label class="form-check-label">
                                    I agree to the Terms & Conditions
                                </label>
                                @error('policy')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-dark">Register</button>
                            </div>

                            <!-- Login Link -->
                            <p class="text-center mb-0">
                                Already have an account?
                                <a href="{{ route('login.page') }}" class="text-decoration-none">Login</a>
                            </p>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>



</x-auth.layout>
