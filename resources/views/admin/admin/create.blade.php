<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader :$title home='Home' url='admin/dashboard' pageTitle="Create Admin" />

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
                                        <label for='name'>Name </label>
                                        <input type='name' class="form-control" id='name' name='name'
                                            required placeholder="Name"value={{ old('name') }}>
                                    </div>

                                    <div class="form-group">
                                        <label for='email'>Email </label>
                                        <input type='email' class="form-control" id='email' name='email'
                                            required placeholder="Email"value={{ old('email') }}>
                                    </div>

                                    <x-form.group label='Email' htmlFor='email' name='email' type='email'
                                        placeholder='Email' required='true' value={{ old('email') }} />
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                    <x-form.group label='Password' htmlFor='password' name='password' type='password'
                                        placeholder='Password' required='true' />



                                </div>


                                <div class="card-footer">
                                    <x-button type='submit' label='Add Admin' class="btn-block" />
                                </div>
                            </form>
                        </div>



                    </div>

                </div>

            </div>
        </section>

    </div>
</x-layouts.app>
