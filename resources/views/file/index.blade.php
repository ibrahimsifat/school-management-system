<x-layouts.app>
    <div class="content-wrapper">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
        <x-contentHeader title="Admin List" home='Home' url='admin/dashboard' pageTitle="Admin List" />
        <x-file-upload-modal />
        @include('utils._messages')
        <section class="content">
            <div class="container-fluid">
                <div class="row ">
                    <div class="md-col-6 ml-auto mr-3 mb-3"style="text-align: right;">
                        <a href="{{ route('file.create') }}" class="btn btn-primary text-right">Create
                            Admin</a>
                    </div>


                </div>

                <div class="row">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fileUploadModel">
                        Launch demo modal
                    </button>
                </div>
        </section>

    </div>
</x-layouts.app>
