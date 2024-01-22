<x-layouts.app>
    <x-slot:styles>
        <link rel="stylesheet" href={{ url('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}>
    </x-slot:styles>

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

                                <div class="md-col-6 mt-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="bulkAction">Bulk Action</label>
                                        </div>
                                        <select class="custom-select" id="bulkAction">
                                            <option selected>Select Action</option>
                                            <option value="delete">Delete Selected</option>
                                            <!-- Add more options as needed -->
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-danger" id="executeBulkAction">Execute</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="md-col-9 ml-auto">
                                <form class="form-group" action="" method="GET">
                                    <div class="input-group ">
                                        <input type="text" name="name" class="form-control " placeholder="name"
                                            value={{ Request::get('name') }}>

                                        <input type="text" name="email" class="form-control " placeholder="Email"
                                            value={{ Request::get('email') }}>
                                        <input type="date" name="date" class="form-control "
                                            value={{ Request::get('date') }}>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn  btn-primary">
                                                <i class="fa fa-search"></i>
                                                Search
                                            </button>
                                        </div>
                                        <div class="input-group-append">
                                            <a href="{{ route('admin.index') }}" class="btn  btn-warning">
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
                                                <input type="checkbox" id="admin_all">
                                                <label for="admin_all">
                                                </label>
                                            </div>
                                        </th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($admins as $admin)
                                        <tr>
                                            <th style="width: 10px">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" value={{ $admin->id }}
                                                        id="checkboxPrimary{{ $admin->id }}"
                                                        class="individual-checkbox" data-id="{{ $admin->id }}">
                                                    <label for="checkboxPrimary{{ $admin->id }}">
                                                    </label>
                                                </div>
                                            </th>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }} </td>
                                            <td>
                                                <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch
                                                    data-off-color="danger" data-on-color="success">
                                                <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch>
                                            </td>
                                            <td>{{ date('d M Y h:i A', strtotime($admin->created_at)) }} </td>
                                            <td>
                                                <div class="">
                                                    <a href="{{ url('admin/edit/' . $admin->id) }}"
                                                        class="btn btn-warning"> Edit</a>
                                                    <a data-toggle="modal"
                                                        data-target="#exampleModalCenter{{ $admin->id }}"
                                                        class="btn btn-danger"> Delete</a>
                                                    {{-- delete confirmation Button --}}
                                                    <?php
                                                    $href = url('admin/destroy/' . $admin->id);
                                                    $id = $admin->id;
                                                    ?>
                                                    <!-- Modal -->
                                                    <x-delete-modal data='Admin' :href="$href"
                                                        :id="$id" />

                                                    <button id="deleteSelectedBtn" class="btn btn-danger">Delete
                                                        Selected</button>

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

        </section>

    </div>
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog"
        aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the selected admins?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <x-slot:scripts>
        <!-- ... your other scripts ... -->
        <!-- Add this line in the head or at the end of the body section -->
        <script src="{{ url('public/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ url('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('public/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>


        <script>
            $(document).ready(function() {
                // Handle "admin_all" checkbox change event
                $('#admin_all').change(function() {
                    // Select or deselect all individual checkboxes based on "admin_all" state
                    $('.individual-checkbox').prop('checked', $(this).prop('checked'));
                });

                // Handle individual checkbox change event
                $('.individual-checkbox').change(function() {
                    // Uncheck "admin_all" if any individual checkbox is unchecked
                    if (!$(this).prop('checked')) {
                        $('#admin_all').prop('checked', false);
                    }
                });

                // Function to get selected admin IDs
                function getSelectedAdminIds() {
                    var selectedIds = [];
                    $('.individual-checkbox:checked').each(function() {
                        selectedIds.push($(this).data('id'));
                    });
                    return selectedIds;
                }

                // Handle "Delete Selected" button click event
                $('#deleteSelectedBtn').click(function() {
                    var selectedIds = getSelectedAdminIds();

                    if (selectedIds.length > 0) {
                        // Open the delete confirmation modal
                        $('#deleteConfirmationModal').modal('show');
                    } else {
                        alert('Please select at least one admin to delete.');
                    }
                });

                // Handle "Confirm Delete" button click event
                $('#confirmDeleteBtn').click(function() {
                    // Get the selected admin IDs
                    var selectedIds = getSelectedAdminIds();

                    // Send a request to your delete route with the selected IDs
                    $.ajax({
                        url: '{{ route('admin.bulkDelete') }}', // Replace with your actual route
                        method: 'POST',
                        data: {
                            ids: selectedIds,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            // Handle success, e.g., refresh the page
                            location.reload();
                        },
                        error: function(error) {
                            console.error(error);
                            // Handle error, e.g., show a message to the user
                        }
                    });

                    // Close the delete confirmation modal
                    $('#deleteConfirmationModal').modal('hide');
                });
            });
        </script>
    </x-slot:scripts>

</x-layouts.app>
