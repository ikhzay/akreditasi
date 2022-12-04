@extends('app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Menu</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Daftar Menu</a>
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
                        <h5>Menu</h5>
                    </div>
                    <div class="ibox-content" style=" min-height: calc(100vh - 244px); ">
                        <button class="btn btn-lg btn-primary mb-3 mt-1" data-toggle="modal" data-target="#myModal"> Tambah
                            Menu</button>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Judul</th>
                                        <th class="text-center">Link</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataMenu as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $item->nama_menu }}</td>
                                            <td class="text-center">
                                                <a href="{{ $item->link }}" target="_blank"> {{ $item->link }} </a>
                                            </td>
                                            <td class="text-center" style="width: 153px">
                                                <div style="display:flex;">

                                                    <button class="btn btn-sm btn-info " type="button"
                                                        onclick="buttonModalEditMenu({{ $item }})"><i
                                                            class="fa fa-paste"></i> Edit</button>
                                                    <form action="/hapus_menu" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $item->id_menu }}">
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
                    <h4 class="modal-title">Tambah Menu</h4>
                </div>
                <div class="modal-body bg-white">

                    <form role="form" method="post" action="/tambah_menu">
                        @csrf
                        <div class="form-group">
                            <label>Judul</label>
                            <input class="form-control" type="text" name="nama_menu" required autocomplete="off">
                            @error('nama_menu')
                                <script>
                                    swal("Oppss!", "Nama menu telah tersedia!", "error");
                                </script>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Link</label>
                            <input class="form-control" type="text" name="link" autocomplete="off">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure?')">Apply</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal inmodal" id="ModalEditRuangan" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated fadeIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <h4 class="modal-title">Edit Menu</h4>
                </div>
                <div class="modal-body bg-white">

                    <form role="form" method="post" action="/edit_menu">
                        @csrf
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="hidden" name="id" id="formModalIdMenu">
                            <input class="form-control" type="text" name="nama_menu" id="formModalNamaMenu" required
                                autocomplete="off" >
                        </div>
                        <div class="form-group">
                            <label>Link</label>
                            <input class="form-control" id="formModalIdLink" type="text" name="link" autocomplete="off">
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
@endsection
