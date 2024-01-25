<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader title="Subject List" home='Home' url='admin/dashboard' pageTitle="Classes and Subjects" />
        @include('utils._messages')
        <section class="content">
            <div class="container-fluid">


                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Class Name</th>
                                            <th>Subject Name</th>
                                            <th>Subject Type</th>
                                            <th>Class Timetable</th>
                                            <th>Duration</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($getClassesSubjects as $getClassesSubject)
                                            <tr>
                                                @php
                                                    $classSubject = $getClassesSubject->getTeacherTimetable($getClassesSubject->course_id, $getClassesSubject->subject_id);
                                                @endphp
                                                {{-- {{ $getClassesSubject }} --}}
                                                <td>{{ $getClassesSubject->id }}</td>
                                                <td>{{ $getClassesSubject->course_name }}</td>
                                                <td>{{ $getClassesSubject->subject_name }} </td>
                                                <td>{{ $getClassesSubject->subject_type }} </td>
                                                <td>

                                                    @if ($classSubject)
                                                        {{ $classSubject->start_time }} to {{ $classSubject->end_time }}
                                                        <br>
                                                        Room-Number: <strong>{{ $classSubject->room_number }}</strong>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($classSubject)
                                                        {{ $classSubject->duration }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('teacher/classes/timetables/' . $getClassesSubject->course_id . '/' . $getClassesSubject->subject_id) }}"
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
