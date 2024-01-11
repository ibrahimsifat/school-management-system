<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader title="Admin List" home='Home' url='admin/dashboard' pageTitle="Admin List" />
        @include('utils._messages')
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header ">
                                <h3 class="card-title">Striped Full Width Table</h3>
                                <div class="md-col-6"style="text-align: right;">
                                    <a href="{{ route('admin.create') }}" class="btn btn-primary text-right">Create
                                        Admin</a>
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
                                                <td>{{ $admin->created_at }} </td>
                                                <td>
                                                    <div class="">
                                                        <a href="{{ url('admin/dashboard/edit/' . $admin->id) }}"
                                                            class="btn btn-warning"> Edit</a>
                                                        <a href="{{ url('admin/dashboard/destroy/' . $admin->id) }}"
                                                            class="btn btn-danger"> Delete</a>
                                                    </div>
                                                </td>
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
