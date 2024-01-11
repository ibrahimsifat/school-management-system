<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader title="Subject List" home='Home' url='admin/dashboard' pageTitle="Subject List" />
        @include('utils._messages')
        <section class="content">
            <div class="container-fluid">
                <div class="row ">

                    <div class="md-col-6 ml-auto mr-3 mb-3"style="text-align: right;">
                        <a href="{{ route('subject.create') }}" class="btn btn-primary text-right">Create
                            Subject</a>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header row px-5 mt-2">
                                <div class="md-col-3">
                                    <h3>Total Subjects: {{ $subjects->total() }}</h3>
                                </div>
                                <div class="md-col-9 ml-auto">
                                    <form class="form-group" action="" method="GET">
                                        <div class="input-group ">
                                            <input type="text" name="name" class="form-control "
                                                placeholder="name" value={{ Request::get('name') }}>

                                            <input type="text" name="status" class="form-control "
                                                placeholder="Status" value={{ Request::get('status') }}>


                                            <select id="Types" class="form-control" id='types' name='type'
                                                value={{ Request::get('status') }}>
                                                <option value="practical">Practical</option>
                                                <option value="ًworkshop">Workshop</option>
                                                <option value="theory">Theory</option>
                                            </select>


                                            <input type="date" name="date" class="form-control "
                                                value={{ Request::get('date') }}>
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-search"></i>
                                                    Search
                                                </button>
                                            </div>
                                            <div class="input-group-append">
                                                <a href="{{ route('subject.index') }}" class="btn btn-warning">
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
                                            <th>Types</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($subjects as $subject)
                                            <tr>
                                                <td>{{ $subject->id }}</td>
                                                <td>{{ $subject->name }}</td>
                                                <td>{{ $subject->created_by }} </td>
                                                <td>
                                                    @if ($subject->status == 'active')
                                                        <span class="badge badge-success right">
                                                            {{ $subject->status }}</span>
                                                    @else
                                                        <span class="badge badge-danger right">
                                                            {{ $subject->status }}</span>
                                                    @endif

                                                <td>{{ $subject->type }} </td>
                                                </td>
                                                <td>{{ date('d M Y h:i A', strtotime($subject->created_at)) }} </td>
                                                <td>
                                                    <div class="">
                                                        <a href="{{ url('admin/subjects/edit/' . $subject->id) }}"
                                                            class="btn btn-warning"> Edit</a>
                                                        <a href="{{ url('admin/subjects/destroy/' . $subject->id) }}"
                                                            class="btn btn-danger"> Delete</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-2 mx-auto text-center"> {{ $subjects->links() }}</div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</x-layouts.app>
