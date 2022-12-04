@extends('app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Aset</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a>Daftar Aset</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Edit Aset</strong>
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
                        <h5>Edit aset : {{ $dataAset->nama }}</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <div class="form-group">
                                <label>Ruangan</label>
                                <select class="js-example-basic-single form-control" style="width: auto" name="idRuangan"
                                    required>
                                    @foreach ($dataRuangan as $item)
                                        <option value="{{ $item->id_ruangan }}"> {{ $item->nama_ruangan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kode Aset</label>
                                <input class="form-control" type="text" name="kode" required
                                    value="{{ $dataAset->kode_aset }}">
                                @error('kode')
                                    <script>
                                        swal("Oppss!", "Kode aset telah tersedia!", "error");
                                    </script>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nama Aset</label>
                                <input class="form-control" type="text" name="nama" value="{{ $dataAset->nama }}">
                            </div>
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input class="form-control" type="number" name="jumlah" value="{{ $dataAset->jumlah }}">
                            </div>
                            <div class="form-group">
                                <label>lokasi</label>
                                <input class="form-control" type="text" name="lokasi" value="{{ $dataAset->lokasi }}">
                            </div>
                            <div class="form-group">
                                <label>Kondisi</label>
                                <input class="form-control" type="text" name="kondisi" value="{{ $dataAset->kondisi }}">
                            </div>
                            <div class="form-group">
                                <label>Tahun Pengadaan</label>
                                <select id="id_tahun_pengadaan" name="tahun_pengadaan" class="form-control"></select>
                            </div>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="hidden" value="{{ $dataAset->foto_aset }}" name="fotoLama">
                                    <input id="id_foto" type="file" name="foto" accept="image/*"
                                        class="custom-file-input" onchange="cekFoto()">
                                    <label class="custom-file-label" for="id_foto">Foto Aset</label>
                                </div>
                            </div>
                            @if (old('foto'))
                                <img class="img-priview rounded mt-2" width="150" id="priviewFoto">
                            @else
                                <img src="{{ asset('storage/' . $dataAset->foto_aset) }}" class="img-priview rounded mt-2"
                                    width="150" id="priviewFoto">
                            @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
