<section class="h-100">
    <div class="h-100 container">
        <div class="row justify-content-sm-center h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                <div class="my-5 text-center">
                    <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo"
                        width="100">
                </div>
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <h1 class="fs-4 card-title fw-bold mb-4">Register</h1>
                        <form method="POST" class="needs-validation" novalidate="" autocomplete="off">
                            <div class="mb-3">
                                <label class="text-muted mb-2" for="name">Name</label>
                                <input id="name" type="text" class="form-control" name="name" value=""
                                    required autofocus>
                                <div class="invalid-feedback">
                                    Name is required
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="text-muted mb-2" for="email">E-Mail Address</label>
                                <input id="email" type="email" class="form-control" name="email" value=""
                                    required>
                                <div class="invalid-feedback">
                                    Email is invalid
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="text-muted mb-2" for="password">Password</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                                <div class="invalid-feedback">
                                    Password is required
                                </div>
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
                    <div class="card-footer border-0 py-3">
                        <div class="text-center">
                            Already have an account? <a href="index.html" class="text-dark">Login</a>
                        </div>
                    </div>
                </div>
                <div class="text-muted mt-5 text-center">
                    Copyright &copy; 2017-2021 &mdash; Your Company
                </div>
            </div>
        </div>
    </div>
</section>
