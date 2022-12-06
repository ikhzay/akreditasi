@extends('app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Instrument</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Daftar Instrument</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Instrument</a>
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
                                <textarea class="form-control" id="EditorElement" placeholder="Masukkan Element" name="element"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Descriptor</label>
                                <textarea class="form-control" id="EditorDescriptor" placeholder="Masukkan Descriptor" name="descriptor"></textarea>
                            </div>
                        {{-- <button type="button" class="btn btn-white" data-dismiss="modal">Close</button> --}}
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
