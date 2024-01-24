  <!-- SweetAlert2 -->

  <link rel="stylesheet" href={{ url('public/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}>

  <link rel="stylesheet" href={{ url('public/plugins/toastr/toastr.min.css') }}>


  {{-- @if (!empty(session('success')))
      <div class="btn btn-success swalDefaultSuccess">
          {{ session('success') }}
      </div>
  @endif

  @if (!empty(session('error')))
      <div class="btn btn-success swalDefaultSuccess">
          {{ session('error') }}
      </div>
  @endif
  @if (!empty(session('warning')))
      <div class="btn btn-success swalDefaultSuccess">
          {{ session('warning') }}
      </div>
  @endif
  @if (!empty(session('info')))
      <div class="btn btn-success swalDefaultSuccess">
          {{ session('info') }}
      </div>
  @endif
  @if (!empty(session('secondary')))
      <div class="btn btn-success swalDefaultSuccess">
          {{ session('secondary') }}
      </div>
  @endif
  @if (!empty(session('primary')))
      <div class="btn btn-success swalDefaultSuccess">
          {{ session('primary') }}
      </div>
  @endif
  @if (!empty(session('light')))
      <div class="btn btn-success swalDefaultSuccess">
          {{ session('light') }}
      </div>
  @endif --}}

  <script src={{ url('public/plugins/jquery/jquery.min.js') }}></script>
  <!-- Bootstrap 4 -->
  <script src={{ url('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script>
  <!-- SweetAlert2 -->
  <script src={{ url('public/plugins/sweetalert2/sweetalert2.min.js') }}></script>
  <!-- Toastr -->
  <script src={{ url('public/plugins/toastr/toastr.min.js') }}></script>

  {{-- <script>
          $(function() {
              var Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 1000
              });

              $('.swalDefaultSuccess').click(function() {
                  Toast.fire({
                      icon: 'success',
                      title: 'Lorem ipsum dolor sit amet, df sadipscing elitr.'
                  })
              });
              $('.swalDefaultInfo').click(function() {
                  Toast.fire({
                      icon: 'info',
                      title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                  })
              });
              $('.swalDefaultError').click(function() {
                  Toast.fire({
                      icon: 'error',
                      title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                  })
              });
              $('.swalDefaultWarning').click(function() {
                  Toast.fire({
                      icon: 'warning',
                      title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                  })
              });
              $('.swalDefaultQuestion').click(function() {
                  Toast.fire({
                      icon: 'question',
                      title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                  })
              });

              $('.toastrDefaultSuccess').click(function() {
                  toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
              });
              $('.toastrDefaultInfo').click(function() {
                  toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
              });
              $('.toastrDefaultError').click(function() {
                  toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
              });
              $('.toastrDefaultWarning').click(function() {
                  toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
              });

              $('.toastsDefaultDefault').click(function() {
                  $(document).Toasts('create', {
                      title: 'Toast Title',
                      body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                  })
              });
              $('.toastsDefaultTopLeft').click(function() {
                  $(document).Toasts('create', {
                      title: 'Toast Title',
                      position: 'topLeft',
                      body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                  })
              });
              $('.toastsDefaultBottomRight').click(function() {
                  $(document).Toasts('create', {
                      title: 'Toast Title',
                      position: 'bottomRight',
                      body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                  })
              });
              $('.toastsDefaultBottomLeft').click(function() {
                  $(document).Toasts('create', {
                      title: 'Toast Title',
                      position: 'bottomLeft',
                      body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                  })
              });
              $('.toastsDefaultAutohide').click(function() {
                  $(document).Toasts('create', {
                      title: 'Toast Title',
                      autohide: true,
                      delay: 750,
                      body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                  })
              });
              $('.toastsDefaultNotFixed').click(function() {
                  $(document).Toasts('create', {
                      title: 'Toast Title',
                      fixed: false,
                      body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                  })
              });
              $('.toastsDefaultFull').click(function() {
                  $(document).Toasts('create', {
                      body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
                      title: 'Toast Title',
                      subtitle: 'Subtitle',
                      icon: 'fas fa-envelope fa-lg',
                  })
              });
              $('.toastsDefaultFullImage').click(function() {
                  $(document).Toasts('create', {
                      body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
                      title: 'Toast Title',
                      subtitle: 'Subtitle',
                      image: '../../dist/img/user3-128x128.jpg',
                      imageAlt: 'User Picture',
                  })
              });
              $('.toastsDefaultSuccess').click(function() {
                  $(document).Toasts('create', {
                      class: 'bg-success',
                      title: 'Toast Title',
                      subtitle: 'Subtitle',
                      body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                  })
              });
              $('.toastsDefaultInfo').click(function() {
                  $(document).Toasts('create', {
                      class: 'bg-info',
                      title: 'Toast Title',
                      subtitle: 'Subtitle',
                      body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                  })
              });
              $('.toastsDefaultWarning').click(function() {
                  $(document).Toasts('create', {
                      class: 'bg-warning',
                      title: 'Toast Title',
                      subtitle: 'Subtitle',
                      body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                  })
              });
              $('.toastsDefaultDanger').click(function() {
                  $(document).Toasts('create', {
                      class: 'bg-danger',
                      title: 'Toast Title',
                      subtitle: 'Subtitle',
                      body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                  })
              });
              $('.toastsDefaultMaroon').click(function() {
                  $(document).Toasts('create', {
                      class: 'bg-maroon',
                      title: 'Toast Title',
                      subtitle: 'Subtitle',
                      body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                  })
              });
          });
      </script> --}}

  <script>
      $(document).ready(function() {
          @foreach (['success', 'primary', 'error', 'light', 'warning', 'info'] as $type)
              @if (session()->has($type))
                  var Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 2000
                  });

                  Toast.fire({
                      icon: '{{ $type }}',
                      title: '{{ session($type) }}'
                  });
              @endif
          @endforeach
      });
  </script>
