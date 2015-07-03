@extends('store')

@section('cart_content')


    {!! get_flash_message()  !!}

    <div class="container">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Atenção!</strong> Observer os seguintes detalhes:<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <hr>
        @endif

        <main class="main_content">
            <header class="title-section">
                <h1>Fale Conosco:</h1>

                <p class="tagline">Entraremos em contato o mais breve possível!</p>
            </header>

            <div class="row">

                {!! Form::open(['route'=>'contact_create']) !!}

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="name"><span>Nome Completo:</span>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Informe Seu Nome" value="{{ old('name') }}">
                            {{--{!! Form::text('name',null,['class'=>'form-control', 'id'=>"name", 'name'=>"name", 'placeholder'=>"Informe Seu Nome"]) !!}--}}
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="email"><span>Endereço de E-mail:</span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Informe Seu E-mail" value="{{ old('email') }}">
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="subject"><span>Sobre o Que Você Quer Falar?</span>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Assunto:" value="{{ old('subject') }}">
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="phone"><span>Deixe seu Telefone: <small>(somente números)</small></span>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Telefone:" value="{{ old('phone') }}">
                        </label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label>
                        <span>Fale Aqui:</span>
                        <textarea class="form-control" name="contact_here" rows="6" placeholder="Escreva Sua Mensagem:">{{ old('contact_here') }}</textarea>
                    </label>

                    <label>
                        <span>Como encontrou o Site?</span>
                        <select class="form-control" name="how_find_website">
                            <option>Google</option>
                            <option>Yahoo</option>
                            <option>Bing</option>
                            <option>Indicação</option>
                        </select>
                    </label>

                    <div class="form_action">
                        <input class="btn btn-primary" type="reset" value="Limpar Dados"/>
                        <input class="btn btn-primary" type="submit" value="Enviar Dados"/>
                    </div>
                </div>

                {!! Form::close() !!}

            </div>

            <div class="clear"></div>

        </main>
        <br/>

        <p></p>

        <p></p><br/><br/>
    </div>

@stop

@section('styles')
    @parent
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@stop

@section('scripts')
    @parent

    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>

    <script>
        ;(function($)
        {
            'use strict';
            $(document).ready(function()
            {
                // using jQuery Mask Plugin v1.7.5
                // http://jsfiddle.net/d29m6enx/2/
                var maskBehavior = function (val)
                {
                    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
                },
                options = {
                    onKeyPress: function(val, e, field, options)
                    {
                        field.mask(maskBehavior.apply({}, arguments), options);
                    }
                };

                $("#phone").mask(maskBehavior, options);
            });
        })(window.jQuery);
    </script>

@stop