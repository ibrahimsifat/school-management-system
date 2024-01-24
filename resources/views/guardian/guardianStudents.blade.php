<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader title="Subject List" home='Home' url='admin/dashboard' pageTitle="Subject List" />
        @include('utils._messages')

        <div class="container-fluid">

            {{-- {{ dd($students) }} --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-body p-0" style="overflow: auto">
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
                                                <a href="{{ url('guardians/students/subjects/' . $student->id) }}"
                                                    class="btn btn-primary"> Student Subjects</a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>


                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>


        </section>

    </div>
</x-layouts.app>
