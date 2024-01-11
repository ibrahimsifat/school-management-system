<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader :$title home='Home' url='admin/dashboard' pageTitle="Create Subject" />

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
                                            required placeholder="Name"value={{ old('name') }}>
                                    </div>
                                    <div class="form-group">
                                        <label for='description'>Description </label>
                                        <input type='description' class="form-control" id='description'
                                            name='description' required
                                            placeholder="Description"value={{ old('description') }}>
                                    </div>
                                    <div class="form-group">
                                        <label for='Types'>Type </label>
                                        <select id="Types" class="form-control" id='types' name='type'
                                            value={{ old('types') }}>
                                            <option value="practical">Practical</option>
                                            <option value="ًworkshop">Workshop</option>
                                            <option value="theory">Theory</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for='Status'>Status </label>
                                        <select type='status' class="form-control" id='status' name='status'
                                            value={{ old('status') }}>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                            <option value="pending">Pending</option>
                                        </select>
                                    </div>




                                </div>


                                <div class="card-footer">
                                    <x-button type='submit' label='Create Subject' class="btn-block" />
                                </div>
                            </form>
                        </div>



                    </div>

                </div>

            </div>
        </section>

    </div>
</x-layouts.app>
