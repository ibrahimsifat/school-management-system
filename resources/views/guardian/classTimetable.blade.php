<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader title="Subject List" home='Home' url='admin/dashboard' pageTitle="Class Timetable List" />
        @include('utils._messages')
        <section class="content">

            <div class="row">
                <div class="col-md-12">
                    <div class="card my-3">
                        <div class="card-header">
                            <h3 class="card-title text-bold">{{ $course->name }} -
                                {{ $subject->name }}
                            </h3>

                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Week </th>
                                        <th>Class Name</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($classTimetables as $classTimetable)
                                        {{-- {{ dd($classTimetables) }} --}}
                                        <tr>
                                            <td>{{ $classTimetable['week_name'] }}</td>
                                            <td>{{ $classTimetable['start_time'] ? date('h:i A', strtotime($classTimetable['start_time'])) : '' }}
                                            <td>{{ $classTimetable['end_time'] ? date('h:i A', strtotime($classTimetable['end_time'])) : '' }}
                                            </td>
                                            <td>{{ $classTimetable['room_number'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>



                </div>


        </section>

    </div>
</x-layouts.app>
