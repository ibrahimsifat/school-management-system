<x-layouts.app>
    <x-slot:styles>
        <link rel="stylesheet" href={{ url('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}>
    </x-slot:styles>

    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader title="Examination List" home='Home' url='examination/dashboard' pageTitle="Examination List" />
        @php
            $types = ['general', 'test', 'special', 'private', 'other'];
            $status = ['active', 'inactive', 'pending'];
        @endphp
        @include('utils._messages')
        <section class="content">
            <div class="container-fluid">
                <div class="row ">

                    <div class="md-col-6 ml-auto mr-3 mb-3"style="text-align: right;">
                        <a href="{{ route('examination.create') }}" class="btn btn-primary text-right">Create
                            Examination</a>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header row px-5 mt-2">
                                <div class="md-col-3">
                                    <h3>Total Examinations: {{ $examinations->total() }}</h3>
                                </div>


                            </div>
                            <div class="md-col-9 ml-auto">
                                <form class="form-group" action="" method="GET">
                                    <div class="input-group ">
                                        <input type="text" name="name" class="form-control " placeholder="name"
                                            value={{ Request::get('name') }}>


                                        <select class="form-control" id='type' name='type'>
                                            @foreach ($types as $typeOption)
                                                <option value={{ Request::get('type') }}
                                                    {{ Request::get('type') === $typeOption ? 'selected' : '' }}>
                                                    {{ ucfirst($typeOption) }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <select class="form-control" id='status' name='status'
                                            value={{ Request::get('status') }}>
                                            @foreach ($status as $statusOption)
                                                <option value="{{ $statusOption }}"
                                                    {{ Request::get('status') == $statusOption ? 'selected' : '' }}>
                                                    {{ ucfirst($statusOption) }}
                                                </option>
                                            @endforeach
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
                                            <a href="{{ route('examination.index') }}" class="btn  btn-warning">
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
                                        <th style="width: 10px">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="examination_all">
                                                <label for="examination_all">
                                                </label>
                                            </div>
                                        </th>
                                        <th>Name</th>
                                        <th>Note</th>
                                        <th>Status</th>
                                        <th>Type</th>
                                        <th>Created By</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($examinations as $examination)
                                        <tr>
                                            <th style="width: 10px">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" value={{ $examination->id }}
                                                        id="checkboxPrimary{{ $examination->id }}"
                                                        class="individual-checkbox" data-id="{{ $examination->id }}">
                                                    <label for="checkboxPrimary{{ $examination->id }}">
                                                    </label>
                                                </div>
                                            </th>
                                            <td>{{ $examination->name }}</td>
                                            <td>{{ $examination->note }} </td>
                                            <td>
                                                @if ($examination->status == 'active')
                                                    <span class="badge badge-success right">
                                                        {{ $examination->status }}</span>
                                                @else
                                                    <span class="badge badge-danger right">
                                                        {{ $examination->status }}</span>
                                                @endif
                                            </td>

                                            <td>{{ $examination->type }}

                                            </td>
                                            <td>{{ $examination->created_by_name }}:
                                                {{ $examination->created_by_role }}
                                            </td>

                                            <td>{{ date('d M Y h:i A', strtotime($examination->created_at)) }} </td>
                                            <td>
                                                <div class="">
                                                    <a href="{{ url('admin/examinations/edit/' . $examination->id) }}"
                                                        class="btn btn-warning"> Edit</a>
                                                    <a data-toggle="modal"
                                                        data-target="#exampleModalCenter{{ $examination->id }}"
                                                        class="btn btn-danger"> Delete</a>
                                                    {{-- delete confirmation Button --}}
                                                    <?php
                                                    $href = url('admin/examinations/destroy/' . $examination->id);
                                                    $id = $examination->id;
                                                    ?>
                                                    <!-- Modal -->
                                                    <x-delete-modal data='Examination' :href="$href"
                                                        :id="$id" />


                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-2 mx-auto text-center"> {{ $examinations->links() }}</div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>

        </section>

    </div>


</x-layouts.app>
