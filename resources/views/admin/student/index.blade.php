<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader title="Student List" home='Home' url='student/dashboard' pageTitle="Student List" />
        @include('utils._messages')
        <section class="content">
            <div class="container-fluid">
                <div class="row ">

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header row px-5 mt-2">
                                <div class="md-col-3">
                                    <h3>Total Students: {{ $students->total() }}</h3>
                                </div>
                                <div class="md-col-6 ml-auto mb-3"style="text-align: right;">
                                    <a href="{{ route('student.create') }}" class="btn btn-primary text-right">Create
                                        Student</a>
                                </div>
                            </div>
                            <div class="card-body row mx-auto">
                                <form class="" action="" method="GET">


                                    <div class="row g-2">
                                        <div class="form-group col-md-3">
                                            <label for="roll_number">Roll Number</label>
                                            <input type="text" name="roll_number" class="form-control"
                                                placeholder="Roll Number" value="{{ Request::get('roll_number') }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Name"
                                                value="{{ Request::get('name') }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" class="form-control"
                                                placeholder="Email" value="{{ Request::get('email') }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="course">Course</label>
                                            <select type="text" name="course" class="form-control"
                                                value="{{ Request::get('course') }}">
                                                <option selected disabled value="">Search Class</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}"
                                                        {{ Request::get('course') == $course->id ? 'selected' : '' }}>
                                                        {{ $course->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="status">Status</label>
                                            <select type="text" name="status" class="form-control"
                                                placeholder="Status" value="{{ Request::get('status') }}">
                                                <option selected disabled value="">Select Status</option>
                                                <option value="pending"
                                                    {{ Request::get('status') == 'pending' ? 'selected' : '' }}>
                                                    Pending</option>
                                                <option value="active"
                                                    {{ Request::get('status') == 'active' ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="inactive"
                                                    {{ Request::get('status') == 'inactive' ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="gender">Gender</label>
                                            <select type="text" name="gender" class="form-control"
                                                value="{{ Request::get('gender') }}">
                                                <option selected disabled value="">Select Gender</option>
                                                <option value="male"
                                                    {{ Request::get('gender') == 'male' ? 'selected' : '' }}>
                                                    Male</option>
                                                <option value="female"
                                                    {{ Request::get('gender') == 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                                <option value="other"
                                                    {{ Request::get('gender') == 'other' ? 'selected' : '' }}>
                                                    Other</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="religion">Religion</label>
                                            <input type="text" name="religion" class="form-control"
                                                placeholder="Religion" value="{{ Request::get('religion') }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="date">Admission Date</label>
                                            <input type="date" name="admission_date" class="form-control"
                                                value="{{ Request::get('date') }}">
                                        </div>


                                    </div>


                                    <div class="d-flex mt-3">
                                        <div class="mr-2">
                                            <button type="submit" class="btn  btn-primary">
                                                <i class="fa fa-search"></i>
                                                Search
                                            </button>
                                        </div>
                                        <div class="mr-2">
                                            <a href="{{ route('student.index') }}" class="btn  btn-warning">
                                                <i class="fa fa-cancel"></i>
                                                Clear
                                            </a>
                                        </div>
                                    </div>
                            </div>

                            </form>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0"style="overflow: auto">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Admission Number</th>
                                    <th>Roll Number</th>
                                    <th>Class</th>
                                    <th>Gender</th>
                                    <th>Date Of Birth</th>
                                    <th>Caste</th>
                                    <th>Religion</th>
                                    <th>Mobile Number</th>
                                    <th>Blood Group</th>
                                    <th>Height</th>
                                    <th>Weight</th>
                                    <th>Admission Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $student->id }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->last_name }}</td>
                                        <td>{{ $student->email }} </td>
                                        <td>
                                            @if ($student->status == 'active')
                                                <span class="badge badge-success right">
                                                    {{ $student->status }}</span>
                                            @else
                                                <span class="badge badge-danger right">
                                                    {{ $student->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $student->admission_number }} </td>
                                        <td>{{ $student->roll_number }} </td>
                                        <td>{{ $student->course_name }} </td>
                                        <td>{{ $student->gender }} </td>
                                        <td>{{ $student->date_of_birth }} </td>
                                        <td>{{ $student->caste }} </td>
                                        <td>{{ $student->religion }} </td>
                                        <td>{{ $student->mobile_number }} </td>
                                        <td>{{ $student->blood_group }} </td>
                                        <td>{{ $student->height }} </td>
                                        <td>{{ $student->weight }} </td>
                                        <td>{{ date('d M Y h:i A', strtotime($student->admission_date)) }}
                                        </td>
                                        <td>
                                            <div class="">
                                                <a href="{{ url('admin/students/edit/' . $student->id) }}"
                                                    class="btn btn-warning"> Edit</a>

                                                <a data-toggle="modal"
                                                    data-target="#exampleModalCenter{{ $student->id }}"
                                                    class="btn btn-danger"> Delete</a>
                                                {{-- delete confirmation Button --}}
                                                <?php
                                                $href = url('admin/students/destroy/' . $student->id);
                                                $id = $student->id;
                                                ?>
                                                <!-- Modal -->
                                                <x-delete-modal data='Student' :href="$href" :id="$id" />
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2 mx-auto text-center"> {{ $students->links() }}</div>

                    </div>
                </div>
            </div>
    </div>
    </div>



    </section>

    </div>

</x-layouts.app>
