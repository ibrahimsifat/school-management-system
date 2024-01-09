<x-layouts.guest>
    <div class="login-box">

        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ route('forgotPassword') }}" class="h1"><b>Forgot </b>Password</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Type your Email Here </p>
                @include('utils._messages')
                <form action="{{ url('forgot-password') }}" method="post">
                    {{ @csrf_field() }}
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary btn-block">Submit</button>

                </form>


                <p class="mb-1 mt-2">
                    <a href="{{ route('login') }}">Login</a>
                </p>
            </div>

        </div>

    </div>
</x-layouts.guest>
