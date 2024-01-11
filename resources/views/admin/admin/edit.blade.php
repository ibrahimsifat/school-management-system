<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader :$title home='Home' url='admin/dashboard' pageTitle="Update Admin" />

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-10 mx-auto">

                        <div class="card card-secondary">
                            @include('utils._messages')
                            <form action="" method="POST">
                                {{ @csrf_field() }}
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="name">Name </label>
                                        <input type="name" class="form-control" placeholder="Name" name="name"
                                            value={{ old('name'), $user->name }} required>

                                    </div>

                                    <div class="form-group">
                                        <label for="Email">Email </label>
                                        <input type="email" class="form-control" placeholder="Email" name="email"
                                            id="Email" value={{ old('email'), $user->email }} required>
                                        <p class="text-danger">{{ $errors->first('email') }}
                                    </div>
                                    <div class="form-group">
                                        <label for="password"> New Password </label>
                                        <input type="password" class="form-control" placeholder="Password"
                                            name="password">
                                        <p class="text-warning mt-1"> If you want change password also then you can
                                            password</p>
                                    </div>



                                </div>


                                <div class="card-footer">
                                    <x-button type='submit' label='Update Admin' class="btn-block" />
                                </div>
                            </form>
                        </div>



                    </div>

                </div>

            </div>
        </section>

    </div>
</x-layouts.app>
