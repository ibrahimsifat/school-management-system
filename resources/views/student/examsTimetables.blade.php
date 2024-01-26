<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader title="Subject List" home='Home' url='admin/dashboard' pageTitle="Timetable List" />
        @include('utils._messages')
        <section class="content">


            <div class="row">
                @foreach ($examTimetables as $examTimetable)
                    <div class="col-md-12">
                        <div class="card my-3">
                            <div class="card-header">
                                <h3 class="card-title text-bold">Exam Name: {{ $examTimetable['name'] }}</h3>

                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Subject Name </th>
                                            <th>Subject Type </th>
                                            <th>Exam Date</th>
                                            <th>Day</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Pass Marks</th>
                                            <th>Full Marks</th>
                                            <th>Room Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- {{ dd($classTimetables) }} --}}
                                        @foreach ($examTimetable['exams'] as $exam)
                                            <tr>
                                                <td> {{ $exam['subject_name'] }}</td>
                                                <td> {{ $exam['subject_type'] }}</td>
                                                <td> {{ date('d M Y', strtotime($exam['exam_date'])) }}</td>
                                                <td> {{ date('l', strtotime($exam['exam_date'])) }}</td>
                                                <td> {{ date('h:i A', strtotime($exam['start_time'])) }}</td>
                                                <td> {{ date('h:i A', strtotime($exam['end_time'])) }}</td>
                                                <td> {{ $exam['pass_marks'] }}</td>
                                                <td> {{ $exam['full_marks'] }}</td>
                                                <td> {{ $exam['room_number'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                @endforeach

                {{-- 
    
      "subject_name" => "Math"
        "subject_type" => "theory"
        "exam_date" => "2024-01-12"
        "start_time" => "04:01"
        "end_time" => "04:02"
        "pass_marks" => 3
        "full_marks" => 3213213
        "room_number" => "2131321" 
    --}}
            </div>


        </section>

    </div>
</x-layouts.app>
