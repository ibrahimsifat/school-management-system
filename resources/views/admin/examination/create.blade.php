<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader :$title home='Home' url='examinations/dashboard' pageTitle="Create Examination" />
        @php
            $types = ['general', 'test', 'special', 'private', 'other'];
            $status = ['active', 'inactive', 'pending'];
        @endphp
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
                                        <label for='name'>Name <x-form.required-icon /></label>
                                        <input type='name' class="form-control" id='name' name='name'
                                            required placeholder="Name"value={{ old('name') }}>
                                    </div>
                                    <div class="form-group">
                                        <label for='note'>Note </label>
                                        <textarea class="form-control" id='note' name='note' placeholder="Note"value={{ old('note') }}></textarea>
                                    </div>

                                    <div class="form-group">

                                        <label for='Status'>Status <x-form.required-icon /></label>
                                        <select class="form-control" id='status' name='status'>
                                            @foreach ($status as $statusOption)
                                                <option value="{{ $statusOption }}"
                                                    {{ old('status') == $statusOption ? 'selected' : '' }}>
                                                    {{ ucfirst($statusOption) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">

                                        <label for='Type'>Type <x-form.required-icon /></label>
                                        <select class="form-control" id='type' name='type'>
                                            @foreach ($types as $type)
                                                <option value="{{ $type }}"
                                                    {{ old('type') == $type ? 'selected' : '' }}>
                                                    {{ ucfirst($type) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>





                                </div>


                                <div class="card-footer">
                                    <x-button type='submit' label='Create Examination' class="btn-block" />
                                </div>
                            </form>
                        </div>



                    </div>

                </div>

            </div>
        </section>

    </div>
</x-layouts.app>
