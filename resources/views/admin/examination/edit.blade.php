<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader :$title home='Home' url='admin/dashboard' pageTitle="Update Examination" />

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    @php
                        $status = ['active', 'inactive', 'pending'];
                        $types = ['general', 'test', 'special', 'private', 'other'];
                    @endphp
                    <div class="col-md-10 mx-auto">

                        <div class="card card-secondary">
                            @include('utils._messages')
                            <form action="" method="POST">
                                {{ @csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for='name'>Subject Name <x-form.required-icon /></label>
                                        <input type='name' class="form-control" id='name' name='name'
                                            required placeholder="Name" value={{ old('name', $examination->name) }}>
                                    </div>
                                    <div class="form-group">
                                        <label for='note'>Note </label>
                                        <textarea type='note' class="form-control" id='note' name='note' placeholder="Note"
                                            value={{ old('note', $examination->note) }}></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for='Types'>Types <x-form.required-icon /></label>
                                        <select class="form-control" id='type' name='type' required>
                                            @foreach ($types as $typeOption)
                                                <option value="{{ $typeOption }}"
                                                    {{ $examination->type === $typeOption ? 'selected' : '' }}>
                                                    {{ ucfirst($typeOption) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group ">
                                        <label for='Status'>Status <x-form.required-icon /></label>
                                        <select class="form-control" id='status' name='status' required>
                                            @foreach ($status as $statusOption)
                                                <option value="{{ $statusOption }}"
                                                    {{ old('status', $examination->status) == $statusOption ? 'selected' : '' }}>
                                                    {{ ucfirst($statusOption) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="card-footer">
                                    <x-button type='submit' label='Update Examination' class="btn-block" />
                                </div>
                            </form>
                        </div>



                    </div>

                </div>

            </div>
        </section>

    </div>
</x-layouts.app>
