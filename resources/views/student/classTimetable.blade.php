<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader title="Subject List" home='Home' url='admin/dashboard' pageTitle="Timetable List" />
        @include('utils._messages')
        <section class="content">


            <div class="row">
                @foreach ($classTimetables as $classTimetable)
                    <div class="col-md-12">
                        <div class="card my-3">
                            <div class="card-header">
                                <h3 class="card-title text-bold">{{ $classTimetable['name'] }}</h3>

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
                                        {{-- {{ dd($classTimetables) }} --}}
                                        @foreach ($classTimetable['weeks'] as $week)
                                            <tr>
                                                <td>{{ $week['week_name'] }}</td>
                                                <td>{{ $week['start_time'] ? date('h:i A', strtotime($week['start_time'])) : '' }}
                                                <td>{{ $week['end_time'] ? date('h:i A', strtotime($week['end_time'])) : '' }}
                                                </td>
                                                <td>{{ $week['room_number'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                @endforeach


            </div>


        </section>

    </div>
</x-layouts.app>
