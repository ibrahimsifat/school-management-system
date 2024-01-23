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
                                            required placeholder="Name" value="{{ old('name', $teacher->name) }}">
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='last_name'>Last Name </label>
                                        <input type='text' class="form-control" id='last_name' name='last_name'
                                            placeholder="Last Name" value="{{ old('last_name', $teacher->last_name) }}">
                                        <p class="text-danger">{{ $errors->first('last_name') }}</p>
                                    </div>



                                    <div class="form-group col-md-6">
                                        <label for='mobile_number'>Mobile Number <x-form.required-icon /></label>
                                        <input type='text' class="form-control" id='mobile_number'
                                            name='mobile_number' required placeholder="Mobile Number"
                                            value="{{ old('mobile_number', $teacher->mobile_number) }}">
                                        <p class="text-danger">{{ $errors->first('mobile_number') }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='joining_date'>Joining Date <x-form.required-icon /></label>
                                        <input type='date' class="form-control" id='joining_date' name='joining_date'
                                            required placeholder="Joining Date"
                                            value="{{ old('joining_date', $teacher->joining_date) }}">
                                        <p class="text-danger">{{ $errors->first('joining_date') }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='martial_status'>Martial Status </label>
                                        <input type='text' class="form-control" id='martial_status'
                                            name='martial_status' placeholder="Martial Status"
                                            value="{{ old('martial_status') }}">
                                        <p class="text-danger">
                                            {{ $errors->first('martial_status', $teacher->martial_status) }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='qualification'>Qualification </label>
                                        <input type='text' class="form-control" id='qualification'
                                            name='qualification' placeholder="Qualification"
                                            value="{{ old('qualification', $teacher->qualification) }}">
                                        <p class="text-danger">{{ $errors->first('qualification') }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='work_experience'>Work Experience </label>
                                        <input type='text' class="form-control" id='work_experience'
                                            name='work_experience' placeholder="Work Experience"
                                            value="{{ old('work_experience', $teacher->work_experience) }}">
                                        <p class="text-danger">{{ $errors->first('work_experience') }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='note'>Note </label>
                                        <input type='text' class="form-control" id='note' name='note'
                                            placeholder="Note" value="{{ old('note', $teacher->note) }}">
                                        <p class="text-danger">{{ $errors->first('note') }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='gender'>Gender <x-form.required-icon /></label>
                                        <select type='gender' class="form-control" id='gender' name='gender'
                                            value={{ old('gender', $teacher->gender) }}>
                                            <option selected disabled value="">Select Gender</option>
                                            <option {{ old('gender', $teacher->gender) == 'male' ? 'selected' : '' }}
                                                value="male">Male
                                            </option>
                                            <option {{ old('gender', $teacher->gender) == 'female' ? 'selected' : '' }}
                                                value="Female">
                                                Female</option>
                                            <option {{ old('gender', $teacher->gender) == 'other' ? 'selected' : '' }}
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
                                            value={{ old('status', $teacher->status) }}>
                                            <option value="active"
                                                {{ old('status', $teacher->status) == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option
                                                {{ old('status', $teacher->status) == 'inactive' ? 'selected' : '' }}
                                                value="inactive">Inactive</option>
                                            <option
                                                {{ old('status', $teacher->status) == 'pending' ? 'selected' : '' }}
                                                value="pending">Pending</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for='email'>Email <x-form.required-icon /></label>
                                        <input type='email' class="form-control" id='email' name='email'
                                            required placeholder="Email" value={{ old('email', $teacher->email) }}>
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
                                    <x-button type='submit' label='Update Teacher' class="btn-block" />
                                </div>
                            </form>
                        </div>



                    </div>

                </div>

            </div>
        </section>

    </div>
</x-layouts.app>
