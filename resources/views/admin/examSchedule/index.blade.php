<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader title="Class TimeTable List" home='Home' url='admin/dashboard'
            pageTitle="Class TimeTable List" />
        @include('utils._messages')
        <section class="content">

            <div class="container-fluid">
                <div class="row ">

                    <div class="md-col-6 ml-auto mr-3 mb-3"style="text-align: right;">
                        <a href="{{ route('subject.create') }}" class="btn btn-primary text-right">Create
                            Class TimeTable</a>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header row px-5 mt-2">
                                <div class="md-col-3">
                                    <h5>Class Time Table</h5>
                                </div>
                                <form class="form-group md-col-12 ml-auto" action="" method="GET">
                                    <div class="input-group md-col-6">
                                        <select name="examination_id" required class="form-control getClass"
                                            value={{ Request::get('examination_id') }}>
                                            <option selected disabled value="">Select Exam</option>
                                            @foreach ($examinations as $examination)
                                                <option value={{ $examination->id }}
                                                    {{ Request::get('examination_id') == $examination->id ? 'selected' : '' }}>
                                                    {{ $examination->name }}</option>
                                            @endforeach
                                        </select>

                                        <select name="course_id" required class="form-control getClass"
                                            value={{ Request::get('course_id') }}>
                                            <option selected disabled value="">Select Class</option>
                                            @foreach ($courses as $course)
                                                <option value={{ $course->id }}
                                                    {{ Request::get('course_id') == $course->id ? 'selected' : '' }}>
                                                    {{ $course->name }}</option>
                                            @endforeach
                                        </select>



                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-search"></i>
                                                Search
                                            </button>
                                        </div>
                                        <div class="input-group-append">
                                            <a href="{{ route('classTimeTable.index') }}" class="btn btn-warning">
                                                <i class="fa fa-cancel"></i>
                                                Clear
                                            </a>
                                        </div>
                                    </div>

                                </form>

                            </div>
                            <!-- /.card-header -->

                            @if (Request::get('course_id') && Request::get('examination_id'))
                                <form action="{{ url('admin/exam_schedules/create') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="course_id" value="{{ Request::get('course_id') }}">
                                    <input type="hidden" name="examination_id"
                                        value="{{ Request::get('examination_id') }}">
                                    <div class="card-body p-0">

                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Week</th>
                                                    <th>Exam Date</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                    <th>Full Marks</th>
                                                    <th>Passing Marks</th>
                                                    <th>Room Number</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = 1;
                                                @endphp
                                                @foreach ($results as $value)
                                                    <tr>
                                                        <td>
                                                            <input type="hidden"
                                                                name="schedule[{{ $i }}][subject_id]"
                                                                value={{ $value['subject_id'] }}>
                                                            {{ $value['subject_name'] }}
                                                        </td>
                                                        <td>
                                                            <input type="date"
                                                                name="schedule[{{ $i }}][exam_date]"
                                                                id="" class="form-control"
                                                                value="{{ $value['exam_date'] }}">
                                                        </td>
                                                        <td>
                                                            <input type="time"
                                                                name="schedule[{{ $i }}][start_time]"
                                                                id="" class="form-control"
                                                                value="{{ $value['start_time'] }}">
                                                        </td>
                                                        <td>
                                                            <input type="time"
                                                                name="schedule[{{ $i }}][end_time]"
                                                                id="" class="form-control"
                                                                value="{{ $value['end_time'] }}">
                                                        </td>

                                                        <td>
                                                            <input type="text"
                                                                name="schedule[{{ $i }}][full_marks]"
                                                                id="" class="form-control"
                                                                value="{{ $value['full_marks'] }}">
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                name="schedule[{{ $i }}][pass_marks]"
                                                                id="" class="form-control"
                                                                value="{{ $value['pass_marks'] }}">
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                name="schedule[{{ $i }}][room_number]"
                                                                id="" class="form-control"
                                                                value="{{ $value['room_number'] }}">
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @endforeach

                                            </tbody>
                                        </table>
                                        <button type="submit" class="btn btn-primary btn-block mt-3">Add</button>


                                    </div>
                                </form>
                            @endif
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>


        </section>

    </div>

</x-layouts.app>
