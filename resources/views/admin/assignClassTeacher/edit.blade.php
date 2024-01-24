<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader :$title home='Home' url='admin/dashboard' pageTitle="Update AssignClassTeacher" />

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
                                        <label for='Status'>Status </label>
                                        <select type='status' class="form-control" id='status' name='status'>
                                            <option {{ $assignClassTeacher->status === 'active' ? 'selected' : '' }}
                                                value="active">
                                                Active</option>
                                            <option value="inactive"
                                                {{ $assignClassTeacher->status === 'inactive' ? 'selected' : '' }}>
                                                Inactive</option>
                                            <option
                                                value="pending"{{ $assignClassTeacher->status === 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for='Course'>Course </label>
                                        <select type='course' class="form-control" id='course' name='course_id'
                                            value={{ old('course') }}>
                                            @foreach ($courses as $course)
                                                <option value={{ $course->id }}
                                                    {{ $assignClassTeacher->course_id == $course->id ? 'selected' : '' }}>
                                                    {{ $course->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Teacher </label>
                                        <div class="ml-3 ">
                                            @foreach ($teachers as $teacher)
                                                @php
                                                    $checked = '';
                                                @endphp

                                                @foreach ($getAssignClassTeacherId as $teacherAssign)
                                                    @if ($teacherAssign->teacher_id == $teacher->id)
                                                        @php
                                                            $checked = 'checked';
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <label class="d-block">
                                                    <input for='Teacher' type="checkbox"name='teacher_id[]'
                                                        value={{ $teacher->id }} {{ $checked }}>
                                                    {{ $teacher->name }}</label>
                                            @endforeach
                                        </div>
                                    </div>



                                </div>


                                <div class="card-footer">
                                    <x-button type='submit' label='Update AssignClassTeacher' class="btn-block" />
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </section>

    </div>
</x-layouts.app>
