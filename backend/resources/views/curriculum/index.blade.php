@extends('voyager::master')

@section('content')
<div class="col-md-12">
    <div class="card">

        <div class="card-body">
        <div class="card-title">
            <h3>Curriculum Recebido</h3>
        </div>
        <table id="curriculum" class="table" style="width:100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Matricula</th>
                <th>Curso</th>
                <th>E-mail</th>
                <th>Curriculum</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($curriculum as $curricu)
            <tr>
                <td>{{$curricu->name}}</td>
                <td>{{$curricu->matricula}}</td>
                <td>{{$curricu->curso}}</td>
                <td>{{$curricu->email}}</td>
                <td><a href="{{$curricu->arquivo}}" target="_blank">Curriculum</a></td>
                <td>
                    @if($curricu->status == 0)
                    <a href="/admin/curriculum/{{$curricu->id}}/aprovar" class="btn btn-success">Aprovar</a>
                    <a href="/admin/curriculum/{{$curricu->id}}/reprovar"class="btn btn-danger">Reprovar</a>
                    @endif
                    @if($curricu->status == 1)
                    <button class="btn btn-success" disabled="disabled">Aprovado</button>
                    <a href="/admin/curriculum/{{$curricu->id}}/reprovar" class="btn btn-danger">Reprovar</a>
                    @endif
                    @if($curricu->status == 2)
                    <a href="/admin/curriculum/{{$curricu->id}}/aprovar" class="btn btn-success">Aprovar</a>
                    <button class="btn btn-danger disable" disabled="disabled">Reprovado</button>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
            $('#curriculum').DataTable();
    } );
</script>

@stop
