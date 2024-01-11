<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader :$title home='Home' url='admin/dashboard' pageTitle="Update Course" />

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-10 mx-auto">

                        <div class="card card-secondary">
                            @include('utils._messages')
                            <form action="" method="POST">
                                {{ @csrf_field() }}
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for='name'>Class Name </label>
                                        <input type='name' class="form-control" id='name' name='name'
                                            required placeholder="Name"value={{ $course->name }}>
                                    </div>
                                    <div class="form-group">
                                        <label for='description'>Description </label>
                                        <input type='description' class="form-control" id='description'
                                            name='description' required
                                            placeholder="Description"value={{ $course->description }}>
                                    </div>
                                    <div class="form-group">
                                        <label for='Status'>Status </label>
                                        <select type='status' class="form-control" id='status' name='status'>
                                            <option {{ $course->status === 'active' ? 'selected' : '' }} value="active">
                                                Active</option>
                                            <option value="inactive"
                                                {{ $course->status === 'inactive' ? 'selected' : '' }}>
                                                Inactive</option>
                                            <option
                                                value="pending"{{ $course->status === 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                        </select>
                                    </div>




                                </div>


                                <div class="card-footer">
                                    <x-button type='submit' label='Update Course' class="btn-block" />
                                </div>
                            </form>
                        </div>



                    </div>

                </div>

            </div>
        </section>

    </div>
</x-layouts.app>
