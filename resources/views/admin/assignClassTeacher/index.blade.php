<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader title="AssignClassTeacher List" home='Home' url='admin/dashboard'
            pageTitle="AssignClassTeacher List" />
        @include('utils._messages')
        <section class="content">
            <div class="container-fluid">
                <div class="row ">

                    <div class="md-col-6 ml-auto mr-3 mb-3"style="text-align: right;">
                        <a href="{{ route('assignClassTeacher.create') }}" class="btn btn-primary text-right">Create
                            AssignClassTeacher</a>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header row px-5 mt-2">
                                <div class="md-col-3">
                                    <h3>Total: {{ $assignTeachers->total() }}</h3>
                                </div>
                                <div class="md-col-9 ml-auto">
                                    <form class="form-group" action="" method="GET">
                                        <div class="input-group ">
                                            <input type="text" name="course" class="form-control "
                                                placeholder="Course Name" value={{ Request::get('course') }}>
                                            <input type="text" name="teacher" class="form-control "
                                                placeholder="Teacher Name" value={{ Request::get('teacher') }}>

                                            <select type="text" name="status" class="form-control "
                                                placeholder="Status" value={{ Request::get('status') }}>
                                                <option selected disabled value="">Search Status</option>
                                                <option value="pending"
                                                    {{ Request::get('status') === 'pending' ? 'selected' : '' }}>
                                                    Pending</option>
                                                <option value="active"
                                                    {{ Request::get('status') === 'active' ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="inactive"
                                                    {{ Request::get('status') === 'inactive' ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                            <input type="date" name="date" class="form-control "
                                                value={{ Request::get('date') }}>
                                            <div class="input-group-append">
                                                <button type="submit" class="btn  btn-primary">
                                                    <i class="fa fa-search"></i>
                                                    Search
                                                </button>
                                            </div>
                                            <div class="input-group-append">
                                                <a href="{{ route('assignClassTeacher.index') }}"
                                                    class="btn  btn-warning">
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
                                            <th>Course Name</th>
                                            <th>Teachers Name</th>
                                            <th>Created By</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($assignTeachers as $assignClassTeacher)
                                            <tr>
                                                <td>{{ $assignClassTeacher->id }}</td>
                                                <td>{{ $assignClassTeacher->course_name }}</td>
                                                <td>{{ $assignClassTeacher->teacher_name }}</td>
                                                <td>{{ $assignClassTeacher->created_by }} </td>
                                                <td>
                                                    @if ($assignClassTeacher->status == 'active')
                                                        <span class="badge badge-success right">
                                                            {{ $assignClassTeacher->status }}</span>
                                                    @else
                                                        <span class="badge badge-danger right">
                                                            {{ $assignClassTeacher->status }}</span>
                                                    @endif

                                                </td>
                                                <td>{{ date('d M Y h:i A', strtotime($assignClassTeacher->created_at)) }}
                                                </td>
                                                <td>
                                                    <div class="">
                                                        <a href="{{ url('admin/assign_class_teachers/edit/' . $assignClassTeacher->id) }}"
                                                            class="btn btn-warning"> Edit</a>
                                                        <a href="{{ url('admin/assign_class_teachers/edit_single/' . $assignClassTeacher->id) }}"
                                                            class="btn btn-warning"> Edit Single</a>

                                                        <a data-toggle="modal"
                                                            data-target="#exampleModalCenter{{ $assignClassTeacher->id }}"
                                                            class="btn btn-danger"> Delete</a>
                                                        {{-- delete confirmation Button --}}
                                                        <?php
                                                        $href = url('admin/assign_class_teachers/destroy/' . $assignClassTeacher->id);
                                                        $id = $assignClassTeacher->id;
                                                        ?>
                                                        <!-- Modal -->
                                                        <x-delete-modal data='Assign Teacher' :href="$href"
                                                            :id="$id" />
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-2 mx-auto text-center"> {{ $assignTeachers->links() }}</div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

</x-layouts.app>
