<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader :$title home='Home' url='admin/dashboard' pageTitle="Update AssignSubject" />

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
                                            required placeholder="Name"value={{ $assignSubject->name }}>
                                    </div>
                                    <div class="form-group">
                                        <label for='Status'>Status </label>
                                        <select type='status' class="form-control" id='status' name='status'>
                                            <option {{ $assignSubject->status === 'active' ? 'selected' : '' }}
                                                value="active">
                                                Active</option>
                                            <option value="inactive"
                                                {{ $assignSubject->status === 'inactive' ? 'selected' : '' }}>
                                                Inactive</option>
                                            <option
                                                value="pending"{{ $assignSubject->status === 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for='Course'>Course </label>
                                        <select type='course' class="form-control" id='course' name='course_id'
                                            value={{ old('course') }}>
                                            @foreach ($courses as $course)
                                                <option value={{ $course->id }}
                                                    {{ $assignSubject->course_id == $course->id ? 'selected' : '' }}>
                                                    {{ $course->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Subject </label>
                                        <div class="ml-3 ">
                                            @foreach ($subjects as $subject)
                                                @php
                                                    $checked = '';
                                                @endphp

                                                @foreach ($getAssignSubjectId as $subjectAssign)
                                                    @if ($subjectAssign->subject_id == $subject->id)
                                                        @php
                                                            $checked = 'checked';
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <label class="d-block">
                                                    <input for='Subject' type="checkbox"name='subject_id[]'
                                                        value={{ $subject->id }} {{ $checked }}>
                                                    {{ $subject->name }}</label>
                                            @endforeach
                                        </div>
                                    </div>



                                </div>


                                <div class="card-footer">
                                    <x-button type='submit' label='Update AssignSubject' class="btn-block" />
                                </div>
                            </form>
                        </div>



                    </div>

                </div>

            </div>
        </section>

    </div>
</x-layouts.app>
