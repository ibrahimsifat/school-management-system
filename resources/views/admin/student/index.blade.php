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
                    <div class="md-col-6 ml-auto mr-3 mb-3"style="text-align: right;">
                        <a href="{{ route('student.create') }}" class="btn btn-primary text-right">Create
                            Student</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header row px-5 mt-2">
                                <div class="md-col-3">
                                    <h3>Total Students: {{ $students->total() }}</h3>
                                </div>
                                <div class="md-col-9 ml-auto">
                                    <form class="form-group" action="" method="GET">
                                        <div class="input-group ">
                                            <input type="text" name="roll_number" class="form-control"
                                                placeholder="Roll Number" value={{ Request::get('roll_number') }}>

                                            <input type="text" name="name" class="form-control" placeholder="name"
                                                value={{ Request::get('name') }}>

                                            <input type="text" name="email" class="form-control"
                                                placeholder="Email" value={{ Request::get('email') }}>
                                            <input type="date" name="date" class="form-control"
                                                value={{ Request::get('date') }}>
                                            <div class="input-group-append">
                                                <button type="submit" class="btn  btn-primary">
                                                    <i class="fa fa-search"></i>
                                                    Search
                                                </button>
                                            </div>
                                            <div class="input-group-append">
                                                <a href="{{ route('student.index') }}" class="btn  btn-warning">
                                                    <i class="fa fa-cancel"></i>
                                                    Clear
                                                </a>
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
                                            <th>Role</th>
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
                                            <th>Width</th>
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
                                                <td>{{ $student->role }} </td>
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
                                                <td>{{ $student->width }} </td>
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
                                                        <x-delete-modal data='Student' :href="$href"
                                                            :id="$id" />
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
