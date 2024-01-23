<x-layouts.app>
    <link rel="stylesheet" href="{{ url('public/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader :$title home='Home' url='parent/dashboard' pageTitle="Create Parent" />

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    @include('utils._messages')

                    <div class="col-md-12 mx-auto">

                        {{-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <p><strong>Opps Something went wrong</strong></p>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}
                        <div class="card card-secondary">
                            <form action="" method="POST" enctype="multipart/form-data">
                                {{ @csrf_field() }}
                                <div class="card-body row ">

                                    <div class="form-group col-md-6">
                                        <label for='name'>Name <x-form.required-icon /></label>
                                        <input type='text' class="form-control" id='name' name='name'
                                            required placeholder="Name" value="{{ old('name') }}">
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='last_name'>Last Name </label>
                                        <input type='text' class="form-control" id='last_name' name='last_name'
                                            placeholder="Last Name" value="{{ old('last_name') }}">
                                        <p class="text-danger">{{ $errors->first('last_name') }}</p>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for='mobile_number'>Mobile Number <x-form.required-icon /></label>
                                        <input type='text' class="form-control" id='mobile_number'
                                            name='mobile_number' required placeholder="Mobile Number"
                                            value="{{ old('mobile_number') }}">
                                        <p class="text-danger">{{ $errors->first('mobile_number') }}</p>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for='joining_date'>Joining Date <x-form.required-icon /></label>
                                        <input type='date' class="form-control" id='joining_date' name='joining_date'
                                            required placeholder="Joining Date" value="{{ old('joining_date') }}">
                                        <p class="text-danger">{{ $errors->first('joining_date') }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='martial_status'>Martial Status </label>
                                        <input type='text' class="form-control" id='martial_status'
                                            name='martial_status' placeholder="Martial Status"
                                            value="{{ old('martial_status') }}">
                                        <p class="text-danger">{{ $errors->first('martial_status') }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='qualification'>Qualification </label>
                                        <input type='text' class="form-control" id='qualification'
                                            name='qualification' placeholder="Qualification"
                                            value="{{ old('qualification') }}">
                                        <p class="text-danger">{{ $errors->first('qualification') }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='work_experience'>Work Experience </label>
                                        <input type='text' class="form-control" id='work_experience'
                                            name='work_experience' placeholder="Work Experience"
                                            value="{{ old('work_experience') }}">
                                        <p class="text-danger">{{ $errors->first('work_experience') }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='note'>Note </label>
                                        <input type='text' class="form-control" id='note' name='note'
                                            placeholder="Note" value="{{ old('note') }}">
                                        <p class="text-danger">{{ $errors->first('note') }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='gender'>Gender <x-form.required-icon /></label>
                                        <select type='gender' class="form-control" id='gender' name='gender'
                                            value={{ old('gender') }}>
                                            <option selected disabled value="">Select Gender</option>
                                            <option {{ old('gender') == 'male' ? 'selected' : '' }} value="male">
                                                Male
                                            </option>
                                            <option {{ old('gender') == 'female' ? 'selected' : '' }} value="Female">
                                                Female</option>
                                            <option {{ old('gender') == 'other' ? 'selected' : '' }} value="other">
                                                Other</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for='image'>Profile Picture </label>

                                        <input type='file' class="form-control" id='image' name='image'
                                            placeholder="Profile Picture" value={{ old('image') }}>

                                        <p class="text-danger">{{ $errors->first('image') }}</p>
                                    </div>
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
                                            value={{ old('status') }}>
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option {{ old('status') == 'inactive' ? 'selected' : '' }}
                                                value="inactive">
                                                Inactive</option>
                                            <option {{ old('status') == 'pending' ? 'selected' : '' }}
                                                value="pending">
                                                Pending</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for='email'>Email <x-form.required-icon /></label>
                                        <input type='email' class="form-control" id='email' name='email'
                                            required placeholder="Email" value={{ old('email') }}>
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for='password'>Password <x-form.required-icon /></label>
                                        <input type='password' class="form-control" id='password' name='password'
                                            required placeholder="Password" value={{ old('password') }}>
                                        <p class="text-danger">{{ $errors->first('password') }}</p>
                                    </div>



                                </div>


                                <div class="card-footer">
                                    <x-button type='submit' label='Create Parent' class="btn-block" />
                                </div>
                            </form>
                        </div>



                    </div>

                </div>

            </div>
        </section>

    </div>
    <x-slot:scripts>
        <script src="{{ url('public/plugins/jquery/jquery.min.js') }}"></script>

        <script src="{{ url('public/plugins/select2/js/select2.full.min.js') }}"></script>

        <script>
            $(function() {
                //Initialize Select2 Elements
                $('.select2').select2()
            })
        </script>
    </x-slot:scripts>
</x-layouts.app>
