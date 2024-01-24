<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader :$title home='Home' url='student/dashboard' pageTitle="Update Student" />

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
                                            required placeholder="Name" value="{{ old('name', $user->name) }}">
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='last_name'>Last Name </label>
                                        <input type='text' class="form-control" id='last_name' name='last_name'
                                            placeholder="Last Name" value="{{ old('last_name', $user->last_name) }}">
                                        <p class="text-danger">{{ $errors->first('last_name') }}</p>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for='Course'>Course <x-form.required-icon /></label>
                                        <select class="form-control" id='course' name='course_id'
                                            value="{{ old('course', $user->course_id) }}">

                                            @foreach ($courses as $course)
                                                <option value={{ $course->id }}
                                                    {{ $course->id == $user->course_id ? 'selected' : '' }}>
                                                    {{ $course->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for='roll_number'>Roll Number <x-form.required-icon /></label>
                                        <input type='number' class="form-control" id='roll_number' name='roll_number'
                                            required placeholder="Roll Number"
                                            value={{ old('roll_number', $user->roll_number) }}>
                                        <p class="text-danger">{{ $errors->first('roll_number') }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='mobile_number'>Mobile Number <x-form.required-icon /></label>
                                        <input type='text' class="form-control" id='mobile_number'
                                            name='mobile_number' required placeholder="Mobile Number"
                                            value="{{ old('mobile_number', $user->mobile_number) }}">
                                        <p class="text-danger">{{ $errors->first('mobile_number') }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='gender'>Gender <x-form.required-icon /></label>
                                        <select type='gender' class="form-control" id='gender' name='gender'
                                            required value={{ old('gender', $user->gender) }}>
                                            <option selected disabled value="">Select Gender</option>
                                            <option {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}
                                                value="male">Male
                                            </option>
                                            <option {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}
                                                value="Female">
                                                Female</option>
                                            <option {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}
                                                value="other">
                                                Other</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for='date_of_birth'>Date Of Birth <x-form.required-icon /></label>

                                        <input type='date' class="form-control" id='date_of_birth'
                                            name='date_of_birth' required placeholder="Date Of Birth"
                                            value={{ old('date_of_birth', $user->date_of_birth) }}>
                                        <p class="text-danger">{{ $errors->first('date_of_birth') }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='caste'>Caste </label>

                                        <input type='text' class="form-control" id='caste' name='caste_id'
                                            placeholder="Caste" value={{ old('caste', $user->caste) }}>
                                        <p class="text-danger">{{ $errors->first('caste') }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='religion'>Religion </label>

                                        <input type='text' class="form-control" id='religion' name='religion'
                                            placeholder="Religion" value={{ old('religion', $user->religion) }}>
                                        <p class="text-danger">{{ $errors->first('religion') }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='admission_number'>Admission Number <x-form.required-icon /></label>

                                        <input type='text' class="form-control" id='admission_number'
                                            name='admission_number' placeholder="Admission Number" required
                                            value={{ old('admission_number', $user->admission_number) }}>
                                        <p class="text-danger">{{ $errors->first('admission_number') }}</p>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='admission_date'>Admission Date <x-form.required-icon /></label>

                                        <input type='date' class="form-control" id='admission_date'
                                            name='admission_date' placeholder="Admission Date"
                                            value={{ old('admission_date', $user->admission_date) }}>
                                        <p class="text-danger">{{ $errors->first('admission_date') }}</p>

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
                                        <label for='blood_group'>Blood Group </label>

                                        <input type='text' class="form-control" id='blood_group'
                                            name='blood_group' placeholder="Blood Group"
                                            value={{ old('blood_group', $user->blood_group) }}>
                                        <p class="text-danger">{{ $errors->first('blood_group') }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='height'>Height </label>

                                        <input type='text' class="form-control" id='height' name='height'
                                            placeholder="Height" value={{ old('height', $user->height) }}>
                                        <p class="text-danger">{{ $errors->first('height') }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='weight'>Weight </label>

                                        <input type='text' class="form-control" id='weight' name='weight'
                                            placeholder="Weight" value={{ old('weight') }}>
                                        <p class="text-danger">{{ $errors->first('weight', $user->weight) }}</p>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for='Status'>Status <x-form.required-icon /></label>
                                        <select type='status' class="form-control" id='status' name='status'
                                            value={{ old('status', $user->status) }}>
                                            <option value="active"
                                                {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}
                                                value="inactive">Inactive</option>
                                            <option {{ old('status', $user->status) == 'pending' ? 'selected' : '' }}
                                                value="pending">Pending</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for='email'>Email <x-form.required-icon /></label>
                                        <input type='email' class="form-control" id='email' name='email'
                                            required placeholder="Email" value={{ old('email', $user->email) }}>
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
                                    <x-button type='submit' label='Update Student' class="btn-block" />
                                </div>
                            </form>
                        </div>



                    </div>

                </div>

            </div>
        </section>

    </div>
</x-layouts.app>
