<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader title="Subject List" home='Home' url='admin/dashboard' pageTitle="Subject List" />
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
                                            <th>Subject Name</th>
                                            <th>Class Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($subjects as $subject)
                                            <tr>
                                                <td>{{ $subject->id }}</td>
                                                <td>{{ $subject->subject_name }}</td>
                                                <td>{{ $subject->course_name }} </td>
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
