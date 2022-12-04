<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href={{ asset('css/bootstrap.min.css') }} rel="stylesheet">
    <link href={{ asset('font-awesome/css/font-awesome.css') }} rel="stylesheet">
    <link href={{ asset('css/animate.css') }} rel="stylesheet">
    <link href={{ asset('css/style.css') }} rel="stylesheet">
    <link href={{ asset('css/custom.css') }} rel="stylesheet">
    <link href={{ asset('css/mycss.css') }} rel="stylesheet">


    <link rel="shortcut icon" type="image/png" href="https://pkl.if.unram.ac.id/assets/img/fav.png" sizes="16x16" />
</head>

<body id="page-top" class="landing-page">
    <div class="navbar-wrapper">
        <nav class="navbar navbar-default navbar-fixed-top navbar-expand-md" role="navigation">
            <div class="container">
                <a class="navbar-brand" href="/">PSTI</a>
                <div class="navbar-header page-scroll">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse justify-content-end" id="navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="page-scroll" href="#page-top">Beranda</a></li>
                        <li><a class="page-scroll" href="#contact">Kontak</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <section class="container features">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1><span class="mb-4" style="font-weight: bold; color:#29375B; "> Link - Tree</span> </h1>
                {{-- <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. </p> --}}
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-3 text-center wow fadeInLeft">
            </div>
            <div class="col-md-6 text-center  animated fadeInRight">
                <?php $status = true; $tutup = true; $tanda=0; ?>
                <div id="accordion">
                    @foreach ($dataMenu as $menu)
                        @if ($status)
                            <?php $status = false; ?>
                        @else
                </div>
                @endif
                <a
                    @if ($menu->link == '') href="#" data-toggle="collapse" data-target="#collapse{{ $menu->id_menu }}" aria-expanded="true" aria-controls="collapse{{ $menu->id_menu }}"
                            @else
                                href="{{ $menu->link }}" onclick="window.open('{{ $menu->link }}', '_blank')" @endif>
                    <div class="mycss mb-4" id="heading{{ $menu->id_menu }}">
                        {{ $menu->nama_menu }}
                        @if ($menu->link == '')
                            <i class="fa fa-chevron-right"></i>
                        @endif
                    </div>
                </a>

                @foreach ($dataSubmenu as $submenu)
                    @if ($menu->id_menu == $submenu->id_menu)
                        @if( $tanda != $menu->id_menu)
                        <div id="collapse{{ $menu->id_menu }}" class="collapse mb-2"
                            aria-labelledby="heading{{ $menu->id_menu }}" data-parent="#accordion">
                        @endif
                            <a href="{{ $submenu->link_submenu }}" target="_blank">
                                <div class="mycss_content mb-4">
                                    {{ $submenu->nama_submenu }}
                                </div>
                            </a>
                            <?php $tanda = $menu->id_menu ?>
                    @endif
                @endforeach
                @endforeach
            </div>
            </div>


        </div>
        <div class="col-md-3 text-center wow fadeInRight">
        </div>
        </div>

    </section>

    <section id="contact" class="gray-section contact">
        <div class="container">
            <div class="row m-b-lg">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1> Hubungi Kami </h1>
                </div>
            </div>
            <div class="row m-b-lg">
                <div class="col-lg-3"></div>
                <div class="col-lg-3 col-lg-offset-3">
                    <address> Jl. Majapahit No. 62, Mataram<br /> NTB (Nusa Tenggara Barat) <br /><br /> <abbr
                            title="Telegram Chat"><i class="fa fa-paper-plane-o"></i></abbr>&nbsp;&nbsp;<a
                            href="https://t.me/unrampustikhelp">Help Desk</a> (chat)<br /> <abbr
                            title="Telegram Channel"><i class="fa fa-bullhorn"></i></abbr>&nbsp;&nbsp;<a
                            href="https://t.me/unramnews">UNRAM News</a> (channel)<br /> </address>
                </div>
                <div class="col-lg-4">
                    <p class="text-color"> Jika memiliki pertanyaan atau mengalami kendala selama proses pengisian
                        silakan menghubungi kami melalui beberapa jalur yang tertera. </p>
                    <p class="text-color"> Untuk <strong>Help Desk</strong> bisa dihubungi melalui Telegram (hanya
                        Chat). </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8 col-lg-offset-2 text-center m-t-lg m-b-lg">
                    <p><strong>&copy; 2020 &mdash; Teknik Informatika Universitas Mataram</strong></p>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </section>

    <script src={{ asset('js/jquery-2.1.1.js') }}></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src={{ asset('js/bootstrap.min.js') }}></script>
    <script src={{ asset('js/inspinia.js') }}></script>
    <script src={{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}></script>
    <script src={{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}></script>
    <script src={{ asset('js/plugins/pace/pace.min.js') }}></script>
    <script src={{ asset('js/plugins/wow/wow.min.js') }}></script>

    <script src={{ asset('js/myjs.js') }}></script>
    <script src={{ asset('js/beranda.js') }}></script>


</body>

</html>
