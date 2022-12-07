<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title }}</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet"> --}}
    <script src="{{ asset('js/alert.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/balloon/ckeditor.js"></script> --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>
</head>

<body>
    <div id="wrapper">
        @include('template.sidebar')

        <div id="page-wrapper" class="gray-bg">
            @include('template.header')
            <div class="wrapper wrapper-content">
                @yield('content')
            </div>
            <div class="footer">
                {{-- <div class="float-right">
                    10GB of <strong>250GB</strong> Free.
                </div> --}}
                <div>
                    <strong>Copyright</strong> Link - Tree &copy; 2022
                </div>
            </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src={{ asset('js/jquery-3.1.1.min.js') }}></script>
    <script src={{ asset('js/popper.min.js') }}></script>
    <script src={{ asset('js/bootstrap.js') }}></script>
    <script src={{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}></script>
    <script src={{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}></script>

    <!-- Custom and plugin javascript -->
    <script src={{ asset('js/inspinia.js') }}></script>
    <script src={{ asset('js/plugins/pace/pace.min.js') }}></script>

     <!-- SUMMERNOTE -->
     {{-- <script src={{ asset('js/plugins/summernote/summernote-bs4.js') }}></script> --}}
     {{-- <script src=""></script> --}}
     {{-- <script>
         $(document).ready(function(){
             $('.summernote').summernote();
        });
     </script> --}}




    <!-- jQuery UI -->
    <script src={{ asset('js/plugins/jquery-ui/jquery-ui.min.js') }}></script>
    {{-- select2 --}}

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- datatable --}}

    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>

    <!-- Page-Level Scripts -->

    <script>
        // Upgrade button class name
        $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';

        $(document).ready(function() {
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,

            });

        });
    </script>

    <script>
        $(document).ready(function() {
            // console.log("ready!");
            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });
        });
    </script>

    {{-- CKEditor --}}
    <script>
        ClassicEditor.create( document.querySelector( '#EditorElement' ) ).catch( error => {
            console.error( error );
        });
        ClassicEditor.create( document.querySelector( '#EditorDescriptor' ) ).catch( error => {
            console.error( error );
        });
        ClassicEditor.create( document.querySelector( '#EditorSangatBaik' ) ).catch( error => {
            console.error( error );
        });
        ClassicEditor.create( document.querySelector( '#EditorBaik' ) ).catch( error => {
            console.error( error );
        });
        ClassicEditor.create( document.querySelector( '#EditorCukupBaik' ) ).catch( error => {
            console.error( error );
        });
        ClassicEditor.create( document.querySelector( '#EditorTidakBaik' ) ).catch( error => {
            console.error( error );
        });
    </script>

    @if (session()->has('success'))
        <script>
            swal("Berhasil!", "{{ session('success') }}", "success");
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            swal("Gagal!", "{{ session('error') }}", "error");
        </script>
    @endif
    @if (Request::is('menu'))
        <script>
            function buttonModalEditMenu(params) {
                console.log(params);
                $('#ModalEditRuangan').modal('show');
                $("#formModalIdMenu").val(params.id_menu);
                $("#formModalNamaMenu").val(params.nama_menu);
                $("#formModalIdLink").val(params.link);
            }
        </script>
    @endif
    
    @if (Request::is('submenu'))
        <script>
            function buttonModalEditSubMenu(params) {
                // console.log(params);
                $('#ModalEditRuangan').modal('show');
                $("#idSubmenu").val(params.id_submenu);
                // $("#formModalIdmenu").val(params.id_menu);
                document.getElementById('formModalIdmenu').value = params.id_menu;

                $("#formModalJudul").val(params.nama_submenu);
                $("#formModalLink").val(params.link_submenu);
            }
        </script>
    @endif
    @if (Request::is('kriteria'))
        <script>
            function buttonModalEditKriteria(params) {
                console.log(params);
                $('#ModalEditKriteria').modal('show');
                $("#formModalIdKriteria").val(params.id);
                $("#formModalKriteria").val(params.kriteria);
                $("#formModalDeskripsi").val(params.deskripsi);
            }
        </script>
    @endif
    @if (Request::is('instrument'))
        <script>
            function buttonModalEditKriteria(params) {
                console.log(params);
                $('#ModalEditKriteria').modal('show');
                $("#formModalIdKriteria").val(params.id);
                $("#formModalKriteria").val(params.kriteria);
                $("#formModalDeskripsi").val(params.deskripsi);
            }
        </script>
    @endif

</body>

</html>
