@extends('app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Instrument</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Daftar Instrument</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Tables</a>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        {{-- <h5>Menu</h5> --}}
                        <form id="form-filter" role="form">
                            @csrf
                            <div class="form-row align-items-center">
                              <div class="col-auto">
                                <label class="sr-only" for="kriteria">Kriteria</label>
                                <input type="text" class="form-control mb-2" id="kriteria" placeholder="Kriteria">
                              </div>
                              <div class="col-auto">
                                <label class="sr-only" for="nilai">Nilai</label>
                                <input type="text" class="form-control mb-2" id="nilai" placeholder="Nilai">
                              </div>
                              <div class="col-auto">
                                <button type="submit" class="btn btn-success mb-2" id="">Filter</button>
                              </div>
                            </div>
                        </form>
                    </div>
                    <div class="ibox-content" style=" min-height: calc(100vh - 244px); ">
                        <button class="btn btn-lg btn-primary mb-3 mt-1" data-toggle="modal" data-target="#uploadCSV"> Uplaod</button>
                        <a href="/tambah_instrument" class="btn btn-lg btn-primary mb-3 mt-1" >Tambah Instrument</a>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                    <tr>
                                        {{-- <th class="text-center">No</th> --}}
                                        <th class="text-center">No. Urut</th>
                                        <th class="text-center">Jenis</th>
                                        <th class="text-center">No. Butir</th>
                                        <th class="text-center">Bobot</th>
                                        <th class="text-center">Element</th>
                                        <th class="text-center">Deskriptor</th>
                                        <th class="text-center">Nilai</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            {{-- <td class="text-center">{{ $loop->iteration }}</td> --}}
                                            <td class="text-center">{{ $item->no_urut }}</td>
                                            <td class="text-center">{{ $item->jenis }}</td>
                                            <td class="text-center">{{ $item->no_butir }}</td>
                                            <td class="text-center">{{ $item->bobot }}</td>
                                            <td class="text-center">{!!$item->element!!}</td>
                                            <td class="text-center">{!!$item->descriptor!!}</td>
                                            <td class="text-center">{{$item->nilai}}</td>
                                            {{-- <td class="text-center">
                                                <a href="{{ $item->link }}" target="_blank"> {{ $item->link }} </a>
                                            </td> --}}
                                            <td class="text-center" style="width: 153px">
                                                <div style="display:flex;">
                                                    {{-- <button class="btn btn-sm btn-info " type="button"
                                                        onclick="buttonModalEditKriteria({{ $item }})"><i
                                                            class="fa fa-paste"></i> Edit</button> --}}
                                                    <a href="/edit_instrument/{{ $item->id }}" class="btn btn-sm btn-info "><i
                                                        class="fa fa-paste"></i> Edit</a>
                                                    <form action="/hapus_instrument" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                                        <button class="btn btn-sm btn-danger ml-2" type="submit"
                                                            onclick="return confirm('Are you sure? The Submenus will be deleted also')"><i
                                                                class="fa fa-trash"></i> Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal inmodal" id="myModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated fadeIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <h4 class="modal-title">Tambah Instrument</h4>
                </div>
                <div class="modal-body bg-white">
                    <form role="form" method="post" action="/tambah_instrument">
                        @csrf
                        <div class="form-group">
                            <label>Kriteria</label>
                            {{-- <input class="form-control" type="text" name="kriteria" required autocomplete="off"> --}}
                            <select class="js-example-basic-single form-control" style="width: auto" name="kriteria_id" required>
                                @foreach ($dataKriteria as $item)
                                    @if ($item->link == '')
                                        <option value="{{ $item->id }}"> {{ $item->deskripsi }}</option>
                                    @endif
                                @endforeach
                            </select>
                            {{-- @error('kriteria')
                                <script>
                                    swal("Oppss!", "Nama menu telah tersedia!", "error");
                                </script>
                            @enderror --}}
                        </div>
                        <div class="form-group">
                            <label>Jenis</label>
                            <input class="form-control" type="text" name="jenis" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>No. Urut</label>
                            <input class="form-control" type="text" name="no_urut" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>No. Butir</label>
                            <input class="form-control" type="text" name="no_butir" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Bobot</label>
                            <input class="form-control" type="text" name="bobot" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Element</label>
                            <div id="hmm">
                                <p>This is some sample content.</p>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Apply</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal inmodal" id="ModalEditKriteria" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated fadeIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <h4 class="modal-title">Edit Menu</h4>
                </div>
                <div class="modal-body bg-white">

                    <form role="form" method="post" action="/edit_kriteria">
                        @csrf
                        <div class="form-group">
                            <label>Kriteria</label>
                            <input type="hidden" name="id" id="formModalIdKriteria">
                            <input class="form-control" type="text" name="kriteria" id="formModalKriteria" required
                                autocomplete="off" >
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <input class="form-control" id="formModalDeskripsi" type="text" name="deskripsi" autocomplete="off">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"
                        onclick="return confirm('Are you sure?')">Apply</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="uploadCSV" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import CSV</h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body">
                <form action="import_instrument" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Kriteria</label>
                        <select class="js-example-basic-single form-control" style="width: auto" name="kriteria_id" required>
                            @foreach ($dataKriteria as $item)
                                @if ($item->link == '')
                                    <option value="{{ $item->id }}"> {{ $item->deskripsi }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input type="file" name="file" class="form-control">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script>
        $('#form-filter').submit(function(e) {
            e.preventDefault();
            var kriteria = document.getElementById('kriteria').value;
            var nilai = document.getElementById('nilai').value;
            console.log(kriteria);
            console.log(nilai);
            $.ajax({
                method:'GET',
                url: "/filterInstrument/"+kriteria+"/"+nilai,
                type:'json',
                contentType: false,
                processData: false,
                success: (response) => {
                    console.log(response);
                    // if (response) {
                    //     this.reset();
                    //     swal("Sukses", "Dokumen berhasil di upload", "success");
                    // }
                },
                error: function(response){
                    // console.log("error");
                    $('#file-input-error').text(response.responseJSON.message);
                }
           });
        });
    </script>
@endsection
