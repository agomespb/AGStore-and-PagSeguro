
@extends('app')

@section('content')
    <div class="container">

        <h2>Atualizar Categoria: {{ $category->name }} </h2>
        <hr>
        <a href="{{ URL::route('categories') }}" class="btn btn-default"><i class="fa fa-chevron-left"></i> Voltar</a>
        <hr>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Observe os erros encontrados.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <hr>
        @endif

        {!! Form::open(['route'=>['update_category', $category->id], 'method'=>'put']) !!}

        <div class="form form-group">

            {!! Form::label('name', 'Nome:') !!}
            {!! Form::text('name',$category->name,['class'=>'form-control']) !!}

        </div>

        <div class="form form-group">

            {!! Form::label('description', 'Descrição:') !!}
            {!! Form::textarea('description', $category->description,['class'=>'form-control']) !!}

        </div>

        <div class="form form-group">

            {!! Form::submit('Salvar Categoria', ['class'=>'btn btn-primary']) !!}

        </div>

        {!! Form::close() !!}

    </div>
@endsection