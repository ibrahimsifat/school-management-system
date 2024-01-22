<x-layouts.app>

    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader title="Guardian List" home='Home' url='guardian/dashboard' pageTitle="Guardian List" />
        @include('utils._messages')
        <section class="content">
            <div class="container-fluid">
                <div class="row ">

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header row px-5 mt-2">
                                <div class="md-col-3">
                                    {{-- <h3>Total Guardians: {{ $guardians->total() }}</h3> --}}
                                </div>
                                <div class="md-col-6 ml-auto mb-3"style="text-align: right;">
                                    <a href="{{ route('guardian.create') }}" class="btn btn-primary text-right">Create
                                        Guardian</a>
                                </div>
                            </div>
                            <div class="card-body row mx-auto">
                                <form class="" action="" method="GET">


                                    <div class="row g-2">

                                        <div class="form-group col-md-3">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Name"
                                                value="{{ Request::get('name') }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" class="form-control"
                                                placeholder="Email" value="{{ Request::get('email') }}">
                                        </div>


                                        <div class="form-group col-md-3">
                                            <label for="status">Status</label>
                                            <select type="text" name="status" class="form-control"
                                                placeholder="Status" value="{{ Request::get('status') }}">
                                                <option selected disabled value="">Select Status</option>
                                                <option value="pending"
                                                    {{ Request::get('status') == 'pending' ? 'selected' : '' }}>
                                                    Pending</option>
                                                <option value="active"
                                                    {{ Request::get('status') == 'active' ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="inactive"
                                                    {{ Request::get('status') == 'inactive' ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="gender">Gender</label>
                                            <select type="text" name="gender" class="form-control"
                                                value="{{ Request::get('gender') }}">
                                                <option selected disabled value="">Select Gender</option>
                                                <option value="male"
                                                    {{ Request::get('gender') == 'male' ? 'selected' : '' }}>
                                                    Male</option>
                                                <option value="female"
                                                    {{ Request::get('gender') == 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                                <option value="other"
                                                    {{ Request::get('gender') == 'other' ? 'selected' : '' }}>
                                                    Other</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="date">Created Date</label>
                                            <input type="date" name="created_at" class="form-control"
                                                value="{{ Request::get('created_at') }}">
                                        </div>



                                        <div class="d-flex mt-4">
                                            <div class="mr-2">
                                                <button type="submit" class="btn  btn-primary">
                                                    <i class="fa fa-search"></i>
                                                    Search
                                                </button>
                                            </div>
                                            <div class="mr-2">
                                                <a href="{{ route('guardian.index') }}" class="btn  btn-warning">
                                                    <i class="fa fa-cancel"></i>
                                                    Clear
                                                </a>
                                            </div>
                                        </div>
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
                                        <th>Status</th>
                                        <th>Gender</th>
                                        <th>Mobile Number</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($guardians as $guardian)
                                        <tr>
                                            <td>{{ $guardian->id }}</td>
                                            <td>{{ $guardian->name }}</td>
                                            <td>{{ $guardian->last_name }}</td>
                                            <td>{{ $guardian->email }} </td>
                                            <td>
                                                @if ($guardian->status == 'active')
                                                    <span class="badge badge-success right">
                                                        {{ $guardian->status }}</span>
                                                @else
                                                    <span class="badge badge-danger right">
                                                        {{ $guardian->status }}</span>
                                                @endif
                                            </td>

                                            <td>{{ $guardian->gender }} </td>
                                            <td>{{ $guardian->mobile_number }} </td>

                                            <td>
                                                <div class="">
                                                    <a href="{{ url('admin/guardians/edit/' . $guardian->id) }}"
                                                        class="btn btn-warning"> Edit</a>

                                                    <a href="{{ url('admin/guardians/students/edit/' . $guardian->id) }}"
                                                        class="btn btn-primary"> Add/Edit Students</a>

                                                    <a data-toggle="modal"
                                                        data-target="#exampleModalCenter{{ $guardian->id }}"
                                                        class="btn btn-danger"> Delete</a>

                                                    <?php
                                                    $href = url('admin/guardians/destroy/' . $guardian->id);
                                                    $id = $guardian->id;
                                                    ?>

                                                    <x-delete-modal data='Guardian' :href="$href"
                                                        :id="$id" />
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="mt-2 mx-auto text-center"> {{ $guardians->links() }}</div> --}}

                        </div>
                    </div>
                </div>
            </div>
    </div>



    </section>

    </div>

</x-layouts.app>
