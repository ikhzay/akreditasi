<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title }}</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">


    <div class="middle-box text-center animated fadeInDown">
        <h3>Link - Tree</h3>
        <hr>
        @foreach ($dataMenu as $menu)
            <div class="dropdown mt-2" style="">

                <a style="color: aliceblue;"
                    class=" @foreach ($dataSubmenu as $icon_menu) @if ($menu->id_menu == $icon_menu->id_menu) dropdown-toggle @endif @endforeach"
                    @if ($menu->link == '') href="#" id="dropdownMenuLink{{ $menu->id_menu }}"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @else href='{{ $menu->link }}' @endif>
                    {{ $menu->nama_menu }}
                </a>

                @foreach ($dataSubmenu as $submenu)
                    @if ($menu->id_menu == $submenu->id_menu)
                        <div class="dropdown-content" aria-labelledby="dropdownMenuLink{{ $menu->id_menu }}">

                            @foreach ($dataSubmenu as $submenu)
                                @if ($menu->id_menu == $submenu->id_menu)
                                    <a class="" href='{{ $submenu->link_submenu }}' target="_blank">
                                        {{ $submenu->nama_submenu }}</a>
                                @endif
                            @endforeach


                        </div>
                    @endif
                @endforeach
            </div>
            <div class="divider">
                <hr>
            </div>
        @endforeach






    </div>

    <!-- Mainly scripts -->
    <script src=" {{ asset('js/jquery-3.1.1.min.js') }} "></script>
    <script src=" {{ asset('js/popper.min.js') }} "></script>
    <script src=" {{ asset('js/bootstrap.js') }} "></script>

</body>

</html>
