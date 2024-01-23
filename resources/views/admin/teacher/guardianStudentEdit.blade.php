<x-layouts.app>
    <link rel="stylesheet" href="{{ url('public/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader :$title home='Home' url='parent/dashboard' pageTitle="Update Parent" />

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            @include('utils._messages')

                            <div class="card-body mx-auto">
                                <form class="row " action="" method="GET">



                                    <div class="form-group col-md-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Name"
                                            value="{{ Request::get('name') }}">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" class="form-control" placeholder="Email"
                                            value="{{ Request::get('email') }}">
                                    </div>



                                    <div class="form-group col-md-3">
                                        <label for="date">Created Date</label>
                                        <input type="date" name="created_at" class="form-control"
                                            value="{{ Request::get('created_at') }}">
                                    </div>


                                    <div style="margin-top: 32px" class="form-group col-md-3 ">
                                        <button type="submit" class="btn  btn-primary">
                                            <i class="fa fa-search"></i>
                                            Search
                                        </button>


                                        <a href="{{ route('teacher.index') }}" class="btn  btn-warning">
                                            <i class="fa fa-cancel"></i>
                                            Clear
                                        </a>
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($teacherStudents) > 0)

                                        @foreach ($teacherStudents as $teacherStudent)
                                            <tr>
                                                <td>{{ $teacherStudent->id }}</td>
                                                <td>{{ $teacherStudent->name }}</td>
                                                <td>{{ $teacherStudent->last_name }}</td>
                                                <td>{{ $teacherStudent->email }}</td>

                                                <td>
                                                    <form
                                                        action={{ url('admin/teachers/students/remove/' . $teacherId . '/' . $teacherStudent->id) }}
                                                        method="get">

                                                        <button type="submit"
                                                            class="btn btn-danger swalDefaultSuccess">

                                                            Remove Student
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach

                                    @endif

                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $student->id }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->last_name }}</td>
                                            <td>{{ $student->email }}</td>

                                            <td>
                                                <form
                                                    action={{ url('admin/teachers/students/add/' . $teacherId . '/' . $student->id) }}
                                                    method="get">
                                                    {{ @csrf_field() }}
                                                    <button type="submit" class="btn btn-success swalDefaultSuccess">

                                                        Add Student
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="mt-2 mx-auto text-center"> {{ $teachers->links() }}</div> --}}

                        </div>
                    </div>

                </div>

            </div>
        </section>

    </div>
    <script src="{{ url('public/plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ url('public/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>
    {{-- </x-slot-scripts> --}}
</x-layouts.app>
