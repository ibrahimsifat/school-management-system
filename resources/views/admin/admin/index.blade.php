<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader title="Admin List" home='Home' url='admin/dashboard' pageTitle="Admin List" />
        @include('utils._messages')
        <section class="content">
            <div class="container-fluid">
                <div class="row ">

                    <div class="md-col-6 ml-auto mr-3 mb-3"style="text-align: right;">
                        <a href="{{ route('admin.create') }}" class="btn btn-primary text-right">Create
                            Admin</a>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header row px-5 mt-2">
                                <div class="md-col-3">
                                    <h3>Total Admins: {{ $admins->total() }}</h3>
                                </div>
                                <div class="md-col-9 ml-auto">
                                    <form class="form-group" action="" method="GET">
                                        <div class="input-group ">
                                            <input type="text" name="name" class="form-control form-control-lg"
                                                placeholder="name" value={{ Request::get('name') }}>

                                            <input type="text" name="email" class="form-control form-control-lg"
                                                placeholder="Email" value={{ Request::get('email') }}>
                                            <input type="date" name="date" class="form-control form-control-lg"
                                                value={{ Request::get('date') }}>
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-lg btn-primary">
                                                    <i class="fa fa-search"></i>
                                                    Search
                                                </button>
                                            </div>
                                            <div class="input-group-append">
                                                <a href="{{ route('admin.index') }}" class="btn btn-lg btn-warning">
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
                                            <th>Email</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($admins as $admin)
                                            <tr>
                                                <td>{{ $admin->id }}</td>
                                                <td>{{ $admin->name }}</td>
                                                <td>{{ $admin->email }} </td>
                                                <td>{{ date('d M Y h:i A', strtotime($admin->created_at)) }} </td>
                                                <td>
                                                    <div class="">
                                                        <a href="{{ url('admin/dashboard/edit/' . $admin->id) }}"
                                                            class="btn btn-warning"> Edit</a>
                                                        <a data-toggle="modal"
                                                            data-target="#exampleModalCenter{{ $admin->id }}"
                                                            class="btn btn-danger"> Delete</a>
                                                        {{-- delete confirmation Button --}}
                                                        <?php
                                                        $href = url('admin/dashboard/destroy/' . $admin->id);
                                                        $id = $admin->id;
                                                        ?>
                                                        <!-- Modal -->
                                                        <x-delete-modal data='Admin' :href="$href"
                                                            :id="$id" />
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-2 mx-auto text-center"> {{ $admins->links() }}</div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

</x-layouts.app>
