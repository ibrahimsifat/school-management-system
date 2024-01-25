<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader title="Class TimeTable List" home='Home' url='admin/dashboard'
            pageTitle="Class TimeTable List" />
        @include('utils._messages')
        <section class="content">
            <?php
            $href = '';
            ?>
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

                                        <select type="text" name="course_id" required class="form-control getClass"
                                            placeholder="Status" value={{ Request::get('course_id') }}>
                                            <option selected disabled value="">Select Class</option>
                                            @foreach ($courses as $course)
                                                <option value={{ $course->id }}
                                                    {{ Request::get('course_id') == $course->id ? 'selected' : '' }}>
                                                    {{ $course->name }}</option>
                                            @endforeach
                                        </select>
                                        <select type="text" name="subject_id" class="form-control getSubject"
                                            placeholder="Status" required>
                                            <option selected disabled value="">Select Subject</option>
                                            @if (!empty($subjects))

                                                @foreach ($subjects as $subject)
                                                    <option value={{ $subject->subject_id }}
                                                        {{ Request::get('subject_id') == $subject->subject_id ? 'selected' : '' }}>
                                                        {{ $subject->subject_name }}</option>
                                                @endforeach

                                            @endif

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

                            @if (Request::get('course_id') && Request::get('subject_id'))
                                <form action="" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="course_id" value="{{ Request::get('course_id') }}">
                                    <input type="hidden" name="subject_id" value="{{ Request::get('subject_id') }}">
                                    <div class="card-body p-0">

                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Week</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                    <th>Room Number</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = 1;
                                                @endphp
                                                @foreach ($weeks as $week)
                                                    <tr>
                                                        <th>
                                                            <input type="hidden"
                                                                name="timetable[{{ $i }}][week_id]"
                                                                value="{{ $week['week_id'] }}">
                                                            {{ $week['week_name'] }}
                                                        </th>
                                                        <th>
                                                            <input type="time"
                                                                name="timetable[{{ $i }}][start_time]"
                                                                id="" class="form-control"
                                                                value="{{ $week['start_time'] }}">
                                                        </th>
                                                        <th>
                                                            <input type="time"
                                                                name="timetable[{{ $i }}][end_time]"
                                                                id="" class="form-control"
                                                                value="{{ $week['end_time'] }}">
                                                        </th>
                                                        <th>
                                                            <input type="text"
                                                                name="timetable[{{ $i }}][room_number]"
                                                                id="" class="form-control"
                                                                value="{{ $week['room_number'] }}">
                                                        </th>
                                                    </tr>
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @endforeach

                                                {{-- {{ dd($weeks) }} --}}
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
    <x-slot:scripts>
        <x-slot:scripts>
            <script type="text/javascript">
                $('.getClass').change(function() {
                    var class_id = $(this).val();
                    $.ajax({
                        url: "{{ url('admin/class_time_tables/get_subjects') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            class_id: class_id,
                        },
                        dataType: "json",
                        success: function(response) {
                            $('.getSubject').html(response.html)
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                });
            </script>
        </x-slot:scripts>
</x-layouts.app>
