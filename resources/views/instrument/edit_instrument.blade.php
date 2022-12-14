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
                        <form role="form" method="post" action="/update_instrument">
                            @csrf
                            <input type="hidden" name="id" value="{{ $instrument->id }}">
                            <div class="form-group">
                                <label>Kriteria</label>
                                {{-- <input class="form-control" type="text" name="kriteria" required autocomplete="off"> --}}
                                <select class="js-example-basic-single form-control" style="width: auto" name="kriteria_id" required>
                                    @foreach ($dataKriteria as $item)
                                        @if ($item->id == $instrument->kriteria_id)
                                            <option value="{{ $item->id }}" selected> {{ $item->deskripsi }}</option>
                                        @else
                                            <option value="{{ $item->id }}"> {{ $item->deskripsi }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jenis</label>
                                <input class="form-control" type="text" name="jenis" autocomplete="off" value="{{$instrument->jenis}}">
                            </div>
                            <div class="form-group">
                                <label>No. Urut</label>
                                <input class="form-control" type="text" name="no_urut" autocomplete="off" value="{{$instrument->no_urut}}">
                            </div>
                            <div class="form-group">
                                <label>No. Butir</label>
                                <input class="form-control" type="text" name="no_butir" autocomplete="off" value="{{$instrument->no_butir}}">
                            </div>
                            <div class="form-group">
                                <label>Bobot</label>
                                <input class="form-control" type="text" name="bobot" autocomplete="off" value="{{$instrument->bobot }}">
                            </div>
                            <div class="form-group">
                                <label>Element</label>
                                <textarea class="form-control" id="EditorElement" placeholder="Masukkan Element" name="element">{{$instrument->element }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Descriptor</label>
                                <textarea class="form-control" id="EditorDescriptor" placeholder="Masukkan Descriptor" name="descriptor">{{$instrument->descriptor }}</textarea>
                            </div>
                             
                            <div class="form-group">
                                <label>Dokumen</label><br>
                                <button class="btn btn-lg btn-primary mb-3 mt-1" type="button" onclick="showTambahDokumen()"><i class="fa fa-plus"></i></button>
                                <table class="table table-striped table-bordered table-hover" id="tabelDokumen">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nama Dokumen</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($document as $doc)
                                            <tr id="{{$doc->id}}">
                                                <td>{{$doc->keterangan}}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-danger ml-2 text-white" onclick="hapus({{$doc->id}})"><i
                                                            class="fa fa-trash"></i> Hapus</a>
                                                    <a class="btn btn-sm btn-info ml-2 text-white" onclick="openFile('{{$doc->nama}}')"><i
                                                            class="fa fa-eye"></i> Lihat</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <label>Penilaian</label>
                                <div class="form-check abc-radio mb-2">
                                    <input class="form-check-input" type="radio" name="radio1" id="radio1" value="4" @if ($instrument->nilai==4)checked @endif>
                                    <label class="form-check-label" for="radio1">
                                        Sangat Baik
                                    </label>
                                    <textarea class="form-control" id="EditorSangatBaik" placeholder="Masukkan Deskripsi" name="nilai4">{{$instrument->penilaian[0]->deskripsi }}</textarea>
                                </div>
                                <div class="form-check abc-radio mb-2">
                                    <input class="form-check-input" type="radio" name="radio1" id="radio2" value="3" @if ($instrument->nilai==3)checked @endif>
                                    <label class="form-check-label" for="radio2">
                                        Baik
                                    </label>
                                    <textarea class="form-control" id="EditorBaik" placeholder="Masukkan Deskripsi" name="nilai3">{{$instrument->penilaian[1]->deskripsi }}</textarea>
                                </div>
                                <div class="form-check abc-radio mb-2">
                                    <input class="form-check-input" type="radio" name="radio1" id="radio3" value="2" @if ($instrument->nilai==2)checked @endif>
                                    <label class="form-check-label" for="radio3">
                                        Cukup
                                    </label>
                                    <textarea class="form-control" id="EditorCukupBaik" placeholder="Masukkan Deskripsi" name="nilai2">{{$instrument->penilaian[2]->deskripsi }}</textarea>
                                </div>
                                <div class="form-check abc-radio">
                                    <input class="form-check-input" type="radio" name="radio1" id="radio4" value="1" @if ($instrument->nilai==1)checked @endif>
                                    <label class="form-check-label" for="radio4">
                                        Kurang
                                    </label>
                                    <textarea class="form-control" id="EditorTidakBaik" placeholder="Masukkan Deskripsi" name="nilai1">{{$instrument->penilaian[3]->deskripsi }}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal inmodal" id="tambahDokumen" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated fadeIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <h4 class="modal-title">Tambah Dokumen</h4>
                </div>
                <div class="modal-body bg-white">
                    <form role="form" id="file-upload" enctype="multipart/form-data"    >
                        @csrf
                        <div class="form-group">
                            <label>Dokumen</label>
                            <input class="form-control" type="file" id="inputFile" name="file" required autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <input class="form-control" type="text" id="keterangan" name="keterangan" autocomplete="off">
                        </div>
                        <span class="text-danger" id="file-input-error"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="simpan">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        function showTambahDokumen(){
            $('#tambahDokumen').modal('show');
        }


        var no=0;
        var dataDokumen= [];
        var fm;
        // UPLOAD FILE BARU
        $('#file-upload').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            console.log(formData);
            $('#file-input-error').text('');
            fm+=formData;
            $.ajax({
                type:'POST',
                url: "{{ url('uploadFile') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response) {
                        this.reset();
                        $('#tambahDokumen').modal('hide');
                        // var t = $('#tabelDokumen');
                        // t.row.add(1,response.data.keterangan,'tes');
                        dataDokumen.push(response);
                        // console.log(dataDokumen);
                        var t = document.getElementById("tabelDokumen");
                        var r = document.createElement("TR");
                        for(i=0;i<dataDokumen.length;i++){
                            r.setAttribute('id',dataDokumen[i].data.id);
                            console.log(dataDokumen[i].data.keterangan);
                            r.innerHTML =   `   
                                                
                                                    <input class="form-control" type="hidden" name="id_dok[]" value="`+dataDokumen[i].data.id+`" autocomplete="off">
                                                    <!--<td>`+(i+1)+`</td>-->
                                                    <td>`+dataDokumen[i].data.keterangan+`</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-danger ml-2 text-white" onclick="hapus(`+dataDokumen[i].data.id+`)"><i
                                                                class="fa fa-trash"></i> Hapus</a>
                                                        <a class="btn btn-sm btn-info ml-2 text-white" onclick="openFile('`+dataDokumen[i].data.nama+`')"><i
                                                                class="fa fa-trash"></i> Lihat</a>
                                                    </td>
                                               
                                            `;
                            t.tBodies[0].appendChild(r);
                        }
                        // r.innerHTML =''
                        swal("Sukses", "Dokumen berhasil di upload", "success");
                    }
                },
                error: function(response){
                    // console.log("error");
                    $('#file-input-error').text(response.responseJSON.message);
                }
           });
        });

        function openFile(tes){
            newWindow = window.open("{{ url('/file') }}"+"/"+tes, "Window","status=1,toolbar=1,width=500,height=300,resizable=yes");
            if (window.focus) {newWindow.focus()}
            return false;
        }

        //Hapus Data
        function hapus($id){
            console.log('ini mau ngapus id '+$id);
            var url = "{{url('hapusFile')}}"+"/"+$id;
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: 'DELETE',
                success:function(xhr, ajaxOptions, thrownError){
                    $("#"+$id).remove();
                    // $(this).closest('tr[id]').remove();
                    console.log("ini id :"+$id);
                    swal('Berhasil', 'Data Terhapus', 'success');
                    
                },
                error: function() {
                }
            });
            return false;
        }
    </script>
@endsection
