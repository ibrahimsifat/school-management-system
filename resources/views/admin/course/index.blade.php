<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader title="Course List" home='Home' url='admin/dashboard' pageTitle="Course List" />
        @include('utils._messages')
        <section class="content">
            <div class="container-fluid">
                <div class="row ">

                    <div class="md-col-6 ml-auto mr-3 mb-3"style="text-align: right;">
                        <a href="{{ route('course.create') }}" class="btn btn-primary text-right">Create
                            Course</a>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header row px-5 mt-2">
                                <div class="md-col-3">
                                    <h3>Total Courses: {{ $courses->total() }}</h3>
                                </div>
                                <div class="md-col-9 ml-auto">
                                    <form class="form-group" action="" method="GET">
                                        <div class="input-group ">
                                            <input type="text" name="name" class="form-control form-control-lg"
                                                placeholder="name" value={{ Request::get('name') }}>

                                            <input type="text" name="status" class="form-control form-control-lg"
                                                placeholder="Status" value={{ Request::get('status') }}>
                                            <input type="date" name="date" class="form-control form-control-lg"
                                                value={{ Request::get('date') }}>
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-lg btn-primary">
                                                    <i class="fa fa-search"></i>
                                                    Search
                                                </button>
                                            </div>
                                            <div class="input-group-append">
                                                <a href="{{ route('course.index') }}" class="btn btn-lg btn-warning">
                                                    <i class="fa fa-cancel"></i>
                                                    Clear
                                                </a>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Name</th>
                                            <th>Created By</th>
                                            <th>Created Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($courses as $course)
                                            <tr>
                                                <td>{{ $course->id }}</td>
                                                <td>{{ $course->name }}</td>
                                                <td>{{ $course->created_by }} </td>
                                                <td>
                                                    @if ($course->status == 'active')
                                                        <span class="badge badge-success right">
                                                            {{ $course->status }}</span>
                                                    @else
                                                        <span class="badge badge-danger right">
                                                            {{ $course->status }}</span>
                                                    @endif

                                                </td>
                                                <td>{{ date('d M Y h:i A', strtotime($course->created_at)) }} </td>
                                                <td>
                                                    <div class="">
                                                        <a href="{{ url('admin/courses/edit/' . $course->id) }}"
                                                            class="btn btn-warning"> Edit</a>
                                                        <a data-toggle="modal"
                                                            data-target="#exampleModalCenter{{ $course->id }}"
                                                            class="btn btn-danger"> Delete</a>
                                                        {{-- delete confirmation Button --}}
                                                        <?php
                                                        $href = url('admin/courses/destroy/' . $course->id);
                                                        $id = $course->id;
                                                        ?>
                                                        <!-- Modal -->
                                                        <x-delete-modal data='Course' :href="$href"
                                                            :id="$id" />
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-2 mx-auto text-center"> {{ $courses->links() }}</div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

</x-layouts.app>
