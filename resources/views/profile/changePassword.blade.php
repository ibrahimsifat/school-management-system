<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader :$title home='Home' url='admin/dashboard' pageTitle="Change Password" />

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
                                        <label for='name'>Old Password </label>
                                        <input type='password' class="form-control" id='password' name='old_password'
                                            required placeholder="Old password"value={{ old('password') }}>
                                    </div>
                                    <div class="form-group">
                                        <label for='new_password'>New Password </label>
                                        <input type='new_password' class="form-control" id='new_password'
                                            name='new_password' required
                                            placeholder="New Password"value={{ old('new_password') }}>
                                    </div>

                                </div>


                                <div class="card-footer">
                                    <x-button type='submit' label='Change Password' class="btn-block" />
                                </div>
                            </form>
                        </div>



                    </div>

                </div>

            </div>
        </section>

    </div>
</x-layouts.app>
