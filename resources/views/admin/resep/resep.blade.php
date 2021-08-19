@extends('admin.master')

@section('title', 'Resep')

@section('extra_css')

    {{ Html::style('admin_assets/component/datatables.net-bs/css/dataTables.bootstrap.min.css') }}

@endsection

@section('content-header')
<h1>
    Resep 
    <small>Halaman resep</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('beranda_admin') }}"><i class="fa fa-home"></i> Beranda</a></li>
    <li class="active"><i class="fa fa-cubes fa-fw"></i> Resep</li>
</ol>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> ERROR!</h4>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                    {{-- <?php error_reporting (E_ALL ^ E_NOTICE); ?> --}}
                @endforeach
            </div>
        @elseif (session()->has('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Success!</h4>
                {{ session('success') }}
            </div>
        @endif
        <div class="box box-primary collapsed-box">
            <div class="box-header">
                <h3 class="box-title">
                    Form Input Resep
                </h3>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-plus"></i>
                </button>
                </div>
            </div>
            <div class="box-body row">
                {!! Form::open(['route' => 'tambah_resep', 'files' => true]) !!}
                <div class="col-sm-6">
                    <div class="form-group has-feedback">
                        {!! Form::label('inp_nama_resep', 'Nama Resep') !!}
                        {!! Form::text('nama_resep',  null, ['id' => 'inp_nama_resep', 'class' => 'form-control']) !!}
                        <span class="help-block"><small>Masukan nama resep tanpa karakter khusus dan angka</small></span>
                    </div>
                    {{-- <div class="form-group has-feedback">
                        {!! Form::label('inp_id_resep', 'Pilih resep') !!}
                        <select name="id_resep" id="inp_id_resep" class="form-control">
                            <option>=== PILIH Resep ===</option>
                            @foreach ($resep as $item)
                                <option value="{{ $item->id_resep }}">{{ $item->nama_resep }}</option>
                            @endforeach
                        </select>
                        <span class="help-block"><small>Silahkan pilih resep yang sesuai</small></span>
                    </div>
                    <div class="form-group has-feedback">
                        {!! Form::label('inp_deskripsi_resep', 'Deskripsi Resep') !!}
                        {!! Form::textarea('deskripsi_resep', null, ['id' => 'inp_deskripsi_resep', 'class' => 'form-control']) !!}
                        <span class="help-block"><small>Silahkan Masukan Deskripsi Resep</small></span>
                    </div>
                </div> --}}
                <div class="col-sm-6">
                    <div class="form-group has-feedback">
                        {!! Form::label('inp_foto_resep', 'Foto Resep') !!}
                        {!! Form::file('foto_resep', ['id' => 'inp_foto_resep', 'class' => 'form-control' , 'style' => 'border: none;', 'accept' => '.jpg, .jpeg, .png']) !!}
                        <span class="help-block"><small>Silahkan pilih foto resep</small></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <button type="submit" id="simpan" name="simpan" value="true" class="btn btn-primary btn-flat pull-right">Simpan Resep</button>
                        <button type="reset" class="btn btn-danger btn-flat">Batal</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">
                    Table Resep
                </h3>
            </div>
            <div class="box-body">
                {{ Form::open(['method' => 'GET']) }}
                <div class="form-group">
                    <label>Filter Data Resep</label>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="resep" class="form-control">
                                <option value>Pilih Resep Masakan...</option>
                                @foreach ($resep as $item)
                                <option value="{{ $item->nama_resep }}">{{ $item->nama_resep }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning">Filter</button>
                            <a class="btn btn-primary" href="{{ route('list_resep') }}">Resep</a>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
                <table class="table table-bordered table-hover" id="table_resep">
                    <thead>
                        <tr>
                            <th>ID Resep</th>
                            <th>Nama Resep</th>
                            <th>Bahan Reaep</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1; ?>
                        @foreach ($resep as $item)
                            <tr>
                                {{-- <td id="id_{{ $counter }}">{{ $item->id_resep }}</td>
                                <td id="nama_{{ $counter }}">{{ $item->nama_masakan  }}</td>
                                <td id="resep_{{ $counter }}">{{ $item->nama_resep  }}</td>
                                <td>
                                    @if($item->stok_barang > 0)
                                        <span class="label bg-green"><i class="fa fa-check fa-fw"></i> Tersedia</span>
                                    @else
                                        <span class="label bg-red"><i class="fa fa-close fa-fw"></i> Tersedia</span>
                                    @endif
                                </td>
                                <td id="tanggal_{{ $counter }}">{{ $item->tanggal_masuk  }}</td>
                                <td> --}}
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                            Action <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="#" class="edit_resep" data-toggle="modal" data-target="#edit_resep" id="{{ $counter }}">
                                                    <i class="fa fa-edit fa-fw"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="hapus_resep" data-toggle="modal" data-target="#hapus_resep" id="{{ $counter }}">
                                                    <i class="fa fa-trash fa-fw"></i> Hapus
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php $counter++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('modal')
<div class="modal modal-default fade" id="edit_resep">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Resep</h4>
            </div>
            {!! Form::open(['id' => 'form_edit_resep', 'method' => 'PUT', 'files' => true]) !!}
                <div class="modal-body row">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            {!! Form::label('inp_edit_nama_resep', 'Nama Resep') !!}
                            {!! Form::text('nama_resep',  null, ['id' => 'inp_edit_nama_resep', 'class' => 'form-control']) !!}
                            <span class="help-block"><small>Masukan nama resep tanpa karakter khusus dan angka</small></span>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('inp_edit_id_resep', 'Pilih Resep') !!}
                            <select name="id_resep" id="inp_edit_id_resep" class="form-control">
                                <option>=== PILIH Resep ===</option>
                                <?php $counter_resep = 1; ?>
                                @foreach ($resep as $item)
                                    <option value="{{ $item->id_resep }}" id="resep{{ $counter_resep }}" class="edit_resep">{{ $item->inp_nama_resep }}</option>
                                <?php $counter_resep++; ?>
                                @endforeach
                            </select>
                            <span class="help-block"><small>Silahkan pilih resep yang sesuai</small></span>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('inp_edit_foto_resep', 'Foto Resep') !!}
                            {!! Form::file('foto_resep', ['id' => 'inp_edit_foto_resep', 'class' => 'form-control' , 'style' => 'border: none;', 'accept' => '.jpg, .jpeg, .png']) !!}
                            <span class="help-block"><small>Silahkan pilih foto resep</small></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group has-feedback">
                            {!! Form::label('inp_edit_deskripsi_resep', 'Deskripsi Resep') !!}
                            {!! Form::textarea('deskripsi_resep', null, ['id' => 'inp_edit_deskripsi_resep', 'class' => 'form-control']) !!}
                            <span class="help-block"><small>Silahkan Masukan Deskripsi resep</small></span>
                        </div>
                        <h3 class="text-center">Foto Resep</h3>
                        {{ Html::image(null, null, ['id' => 'foto_resep', 'class' => 'img-responsive', 'style' => 'margin: 0 auto;']) }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn pull-left" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="simpan" value="true" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal modal-default fade" id="hapus_resep">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Anda Yakin Ingin Melanjutkan ?</h4>
                </div>
                {!! Form::open(['id' => 'form_hapus_resep', 'method' => 'DELETE']) !!}
                    <div class="modal-footer">
                        @csrf
                        <button type="button" class="btn pull-left" data-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan" value="true" class="btn btn-danger">Hapus Resep</button>
                    </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@section('extra_js')

    {{ Html::script('admin_assets/component/datatables.net/js/jquery.dataTables.min.js') }}
    {{ Html::script('admin_assets/component/datatables.net-bs/js/dataTables.bootstrap.min.js') }}
    {{ Html::script('admin_assets/component/ckeditor/ckeditor.js') }}

    <script>
        $(document).ready(function() {
            $('#table_resep').DataTable({
                'lengthChange': false,
                'length': 10,
            })
        })
        CKEDITOR.replace('inp_deskripsi_resep')
        CKEDITOR.replace('inp_edit_deskripsi_resep')

    </script>

@endsection
