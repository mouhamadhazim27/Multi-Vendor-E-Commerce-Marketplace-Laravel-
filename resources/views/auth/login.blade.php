<x-auth.layout title="Login">
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-5 col-lg-4">

                <div class="card shadow">
                    <div class="card-body p-4">

                        <h3 class="text-center mb-4">Login to HazimPlat Marketplace <img src="/assets/image/plathaz.png"
                                alt="Logo" height="40" class="me-2"></h3>

                        <form action="{{ route('login.action') }}" method="POST">
                            @csrf

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label">Email address or Phone number</label>
                                <input type="text" name="login" class="form-control"
                                    placeholder="Enter email or phone number" required>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter password"
                                    required>
                            </div>

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif



                            <!-- Remember & Forgot -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label">Remember me</label>
                                </div>
                                <a href="#" class="text-decoration-none">Forgot password?</a>
                            </div>



                            <!-- Login Button -->
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-dark">Login</button>
                            </div>

                            <!-- Register Link -->
                            <p class="text-center mb-0">
                                Don’t have an account?
                                <a href="{{ route('register.page') }}" class="text-decoration-none">Register</a>
                            </p>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</x-auth.layout>
