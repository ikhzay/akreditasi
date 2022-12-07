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
                            <div class="form-group">
                                <label>Penilaian</label>
                                <div class="form-check abc-radio mb-2">
                                    <input class="form-check-input" type="radio" name="radio1" id="radio1" value="4" checked="">
                                    <label class="form-check-label" for="radio1">
                                        Sangat Baik
                                    </label>
                                    <textarea class="form-control" id="EditorSangatBaik" placeholder="Masukkan Deskripsi" name="nilai4"></textarea>
                                </div>
                                <div class="form-check abc-radio mb-2">
                                    <input class="form-check-input" type="radio" name="radio1" id="radio2" value="3" checked="">
                                    <label class="form-check-label" for="radio2">
                                        Baik
                                    </label>
                                    <textarea class="form-control" id="EditorBaik" placeholder="Masukkan Deskripsi" name="nilai3"></textarea>
                                </div>
                                <div class="form-check abc-radio mb-2">
                                    <input class="form-check-input" type="radio" name="radio1" id="radio3" value="2" checked="">
                                    <label class="form-check-label" for="radio3">
                                        Cukup
                                    </label>
                                    <textarea class="form-control" id="EditorCukupBaik" placeholder="Masukkan Deskripsi" name="nilai2"></textarea>
                                </div>
                                <div class="form-check abc-radio">
                                    <input class="form-check-input" type="radio" name="radio1" id="radio4" value="1" checked="">
                                    <label class="form-check-label" for="radio4">
                                        Kurang
                                    </label>
                                    <textarea class="form-control" id="EditorTidakBaik" placeholder="Masukkan Deskripsi" name="nilai1"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
