@extends('app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Submenu</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Daftar Submenu</a>
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
                    {{-- <div class="ibox-title">
                        <h5>Aset</h5>
                        
                    </div> --}}
                    <div class="ibox-content" style=" min-height: calc(100vh - 244px); ">
                        <button class="btn btn-lg btn-primary mb-3 mt-1" data-toggle="modal" data-target="#myModal"> Tambah
                            Submenu</button>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                id="dataTabelAset">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Parent (Menu)</th>
                                        <th class="text-center">Judul Submenu</th>
                                        <th class="text-center">Link</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataSubmenu as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $item->nama_menu }}</td>
                                            <td class="text-center">{{ $item->nama_submenu }}</td>
                                            <td class="text-center">
                                                <a href="{{ $item->link_submenu }}" target="_blank"> {{ $item->link_submenu }} </a>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button data-toggle="dropdown"
                                                        class="btn btn-primary btn-sm dropdown-toggle">Action </button>

                                                    <ul class="dropdown-menu">
                                                        <button style="border-radius: 3px; color: inherit; line-height: 25px; margin: 4px; text-align: left; font-weight: normal; display: block; padding: 3px 20px; width: 95%;" class="dropdown-item" type="button" onclick="buttonModalEditSubMenu({{ collect($item) }})">
                                                            Edit</button>
                                                        <li>
                                                            <form action="/hapus_submenu" method="post">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $item->id_submenu }}">
                                                                <button
                                                                    style="border-radius: 3px; color: inherit; line-height: 25px; margin: 4px; text-align: left; font-weight: normal; display: block; padding: 3px 20px; width: 95%;"
                                                                    class="dropdown-item" type="submit"
                                                                    onclick="return confirm('Are you sure?')">
                                                                    Hapus</button>
                                                            </form>
                                                        </li>
                                                    </ul>
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
                    <h4 class="modal-title">Tambah Submenu</h4>
                </div>
                <div class="modal-body bg-white">

                    <form role="form" method="post" action="/tambah_submenu">
                        @csrf
                        <div class="form-group">
                            <label>Parent (Menu) </label>
                            <select class="js-example-basic-single form-control" style="width: auto" name="id_menu" required>
                                @foreach ($dataMenu as $item)
                                    @if ($item->link == '')
                                        <option value="{{ $item->id_menu }}"> {{ $item->nama_menu }}</option>
                                    @endif
                                @endforeach
                            </select>
                           
                        </div>
                        <div class="form-group">
                            <label>Judul </label>
                            <input class="form-control" type="text" name="nama_submenu" required>
                             @error('nama_submenu')
                                <script>
                                    swal("Oppss!", "Nama submenu telah tersedia!", "error");
                                </script>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Link</label>
                            <input class="form-control" type="text" name="link_submenu" required>
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
                    <h4 class="modal-title">Edit Submenu</h4>
                </div>
                <div class="modal-body bg-white">

                    <form role="form" method="post" action="/edit_submenu">
                        @csrf
                        <input type="hidden" id="idSubmenu" name="id">
                        <div class="form-group">
                            <label>Parent (Menu) </label>
                            <select class=" form-control" style="width: auto" id="formModalIdmenu"  name="id_menu" required>
                                @foreach ($dataMenu as $item)
                                    @if ($item->link == '')
                                        <option value="{{ $item->id_menu }}"> {{ $item->nama_menu }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Judul </label>
                            <input class="form-control" type="text" id="formModalJudul" name="nama_submenu" required>
                        </div>
                        <div class="form-group">
                            <label>Link</label>
                            <input class="form-control" type="text" id="formModalLink" name="link_submenu" required>
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
@endsection
