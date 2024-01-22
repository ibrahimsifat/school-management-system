<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader :$title home='Home' url='parent/dashboard' pageTitle="Update Parent" />

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12 mx-auto">

                        <div class="card card-secondary">
                            @include('utils._messages')
                            <form action="" method="POST" enctype="multipart/form-data">
                                {{ @csrf_field() }}
                                <div class="card-body row">

                                    <div class="form-group col-md-6">
                                        <label for='name'>Name <x-form.required-icon /></label>
                                        <input type='text' class="form-control" id='name' name='name'
                                            required placeholder="Name" value="{{ old('name', $guardian->name) }}">
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='last_name'>Last Name </label>
                                        <input type='text' class="form-control" id='last_name' name='last_name'
                                            placeholder="Last Name"
                                            value="{{ old('last_name', $guardian->last_name) }}">
                                        <p class="text-danger">{{ $errors->first('last_name') }}</p>
                                    </div>



                                    <div class="form-group col-md-6">
                                        <label for='mobile_number'>Mobile Number <x-form.required-icon /></label>
                                        <input type='text' class="form-control" id='mobile_number'
                                            name='mobile_number' required placeholder="Mobile Number"
                                            value="{{ old('mobile_number', $guardian->mobile_number) }}">
                                        <p class="text-danger">{{ $errors->first('mobile_number') }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='gender'>Gender <x-form.required-icon /></label>
                                        <select type='gender' class="form-control" id='gender' name='gender'
                                            value={{ old('gender', $guardian->gender) }}>
                                            <option selected disabled value="">Select Gender</option>
                                            <option {{ old('gender', $guardian->gender) == 'male' ? 'selected' : '' }}
                                                value="male">Male
                                            </option>
                                            <option
                                                {{ old('gender', $guardian->gender) == 'female' ? 'selected' : '' }}
                                                value="Female">
                                                Female</option>
                                            <option {{ old('gender', $guardian->gender) == 'other' ? 'selected' : '' }}
                                                value="other">
                                                Other</option>
                                        </select>
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for='image'>Profile Picture </label>
                                        {{-- {{ dd($image) }} --}}
                                        <input type='file' class="form-control" id='image' name='image'
                                            placeholder="Profile Picture" value={{ old('image') }}>
                                        {{-- <img src={{ $image }} alt="sdf" style="width: 100px"> --}}
                                        <p class="text-danger">{{ $errors->first('image') }}</p>
                                    </div>
                                    {{-- {{ dd($image) }} --}}

                                    <div class="form-group col-md-6">
                                        <label for='occupation'>Occupation </label>

                                        <input type='text' class="form-control" id='occupation' name='occupation'
                                            placeholder="Occupation" value={{ old('occupation') }}>
                                        <p class="text-danger">{{ $errors->first('occupation') }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='address'>Address </label>

                                        <input type='text' class="form-control" id='address' name='address'
                                            placeholder="Address" value={{ old('address') }}>
                                        <p class="text-danger">{{ $errors->first('address') }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='Status'>Status <x-form.required-icon /></label>
                                        <select type='status' class="form-control" id='status' name='status'
                                            value={{ old('status', $guardian->status) }}>
                                            <option value="active"
                                                {{ old('status', $guardian->status) == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option
                                                {{ old('status', $guardian->status) == 'inactive' ? 'selected' : '' }}
                                                value="inactive">Inactive</option>
                                            <option
                                                {{ old('status', $guardian->status) == 'pending' ? 'selected' : '' }}
                                                value="pending">Pending</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for='email'>Email <x-form.required-icon /></label>
                                        <input type='email' class="form-control" id='email' name='email'
                                            required placeholder="Email" value={{ old('email', $guardian->email) }}>
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for='password'>Password </label>
                                        <input type='password' class="form-control" id='password' name='password'
                                            placeholder="Password" value={{ old('password') }}>

                                        <p>If you want to change password then you can</p>
                                        <p class="text-danger">{{ $errors->first('password') }}</p>
                                    </div>



                                </div>


                                <div class="card-footer">
                                    <x-button type='submit' label='Update Parent' class="btn-block" />
                                </div>
                            </form>
                        </div>



                    </div>

                </div>

            </div>
        </section>

    </div>
</x-layouts.app>
