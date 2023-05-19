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
    <link href='https://fonts.googleapis.com/css?family=Lora:500,300' rel='stylesheet' type='text/css'>

    <style>
        .nn{
            font-family: "Lora", sans-serif; 
            font-size: 12px;
        }
    </style>
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
                <h1><span class="mb-4" style="font-weight: bold; color:#29375B; "> Sistem Informasi Akreditasi PSTI</span> </h1>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    @foreach ($data as $item)
                    <div class="ibox mb-0">
                        <div class=" ibox-title">
                            <h5>Kriteria {{$item->kriteria}} {{$item->deskripsi}}</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-down"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content" style="display: none; padding-top: 10px;
                        padding-bottom: 20px; padding-right:0px; padding-left:0px">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Jenis</th>
                                            <th>No. Urut</th>
                                            <th>No. Butir</th>
                                            <th>Bobot</th>
                                            <th>Element</th>
                                            <th>Deskriptor</th>
                                            <th>Sangat Baik</th>
                                            <th>Baik</th>
                                            <th>Cukup</th>
                                            <th>Kurang</th>
                                            <th>Nilai</th>
                                            <th>Skor</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 9px">
                                        @foreach ($item->instrument as $inst)
                                        <tr class="nn gradeX" onclick="showModal({{$inst->id}})">
                                            <td>{{$inst->jenis}}</td>
                                            <td>{{$inst->no_urut}}</td>
                                            <td>{{$inst->no_butir}}</td>
                                            <td>{{$inst->bobot}}</td>
                                            <td>
                                                {!!$inst->element!!}
                                                <button class="btn btn-success" type="button" onclick="showModal({{$inst->id}})">
                                                    Dokumen
                                                    <i class="fa fa-file" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                            <td>{!!$inst->descriptor!!}</td>
                                            <td>{!!$inst->penilaian[0]->deskripsi!!}</td>
                                            <td>{!!$inst->penilaian[1]->deskripsi!!}</td>
                                            <td>{!!$inst->penilaian[2]->deskripsi!!}</td>
                                            <td>{!!$inst->penilaian[3]->deskripsi!!}</td>
                                            <td>{{$inst->nilai}}</td>
                                            <td>{{$inst->skor}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Jenis</th>
                                            <th>No. Urut</th>
                                            <th>No. Butir</th>
                                            <th>Bobot</th>
                                            <th>Element</th>
                                            <th>Deskriptor</th>
                                            <th>Sangat Baik</th>
                                            <th>Baik</th>
                                            <th>Cukup</th>
                                            <th>Kurang</th>
                                            <th>Nilai</th>
                                            <th>Skor</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-3 text-center wow fadeInLeft">
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
                    <p><strong>&copy; 2022 &mdash; Teknik Informatika Universitas Mataram</strong></p>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </section>

    <div class="modal inmodal" id="showDokumen" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated fadeIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <h4 class="modal-title">Dokumen Penunjang</h4>
                </div>
                <div class="modal-body bg-white">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">File</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        <tbody id="dataDokumen"></tbody>
                      </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    {{-- <button type="submit" class="btn btn-primary" id="simpan">Upload</button> --}}
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function showModal($id){
            $('#showDokumen').modal('show');
            console.log("ini id : "+$id);
            var tableData='';
            $.ajax({
                type : 'get',
                url : "{{url('getDocument')}}"+"/"+$id,
                dataType : 'json',
                success : function(data){
                    //'<input class="form-control" type="text" id="nama_guru" value="'+data.data.nama_guru+'">';
                console.log(data.data.length);
                for(i=0;i<data.data.length;i++){

                    content = '';
                    if(data.data[i].nama == null){
                        content = `<a hidden class="btn btn-sm btn-info ml-2 text-white" onclick="openFile('`+data.data[i].nama+`')"><i class="fa fa-eye"></i> Lihat</a>`;    
                    } else {
                        content = `<a class="btn btn-sm btn-info ml-2 text-white" onclick="openFile('`+data.data[i].nama+`')"><i class="fa fa-eye"></i> Lihat</a>`;    
                    }

                    tableData+=`
                        <tr>
                            <th scope="row">`+(i+1)+`</th>
                            <td>`+data.data[i].keterangan+`</td>
                            <td>
                                `+content+`
                            </td>
                        </tr>
                    `;
                }
                $('#dataDokumen').html(tableData);
                    //menampilkan data ke dalam modal
                    // console.log(data);
                }
            });
            //Mengambil data untuk diubah
        }

        function openFile(tes){
            var tarea = tes;
            if (tarea.indexOf("http://") == 0 || tarea.indexOf("https://") == 0) {
                newWindow = window.open(tes, "Window", "status=1,toolbar=1,width=500,height=300,resizable=yes");
            }else{
                newWindow = window.open("{{ url('/storage') }}" + "/fileDocument/" + tes, "Window", "status=1,toolbar=1,width=500,height=300,resizable=yes");
            }

            
            if (window.focus) {
                newWindow.focus()
            }
            return false;
        }        
    </script>

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
