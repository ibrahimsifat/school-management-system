<x-layouts.guest>
    <div class="login-box">

        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ route('login') }}" class="h1"><b>Login</b>here</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start </p>
                @include('utils._messages')

                <form action="{{ url('login') }}" method="post">
                    {{ @csrf_field() }}
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="......" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" required name="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>

                </form>


                <p class="mb-1 mt-2 text-center">
                    <a href="{{ route('forgotPassword') }}">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p>
            </div>

        </div>

    </div>
</x-layouts.guest>
