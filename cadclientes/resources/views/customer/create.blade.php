@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h3 class="display-3">Novo cliente</h1>
            <div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
                @endif
                <form method="post" action="{{ route('customer.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="first_name">Nome:</label>
                        <input type="text" class="form-control" name="name" />
                    </div>

                    <div class="form-group">
                        <label for="email">CPF:</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" />
                    </div>
                    <div class="form-group">
                        <label for="city">RG:</label>
                        <input type="text" class="form-control" id="rg" name="rg" />
                    </div>
                    <div class="form-group">
                        <label for="country">Telefone:</label>
                        <input type="text" class="form-control" id="phone" name="phone" />
                    </div>
                    <div class="form-group">
                        <label for="job_title">Nascimento:</label>
                        <input type="text" class="form-control" id="birthday" name="birthday" />
                    </div>

                    <div id="addresses">
                        <div class="form-group">
                            <label for="job_title">Endereço (1): <small style="color:red;">Ex. Rua, Numero, Bairro -
                                    (Separados por ,)</small></label>
                            <input type="text" id="address1" required class="form-control" name="address[]" />
                        </div>
                    </div>
                    <div class="form-group">
                        <a id="newInput" class="btn btn-success">Novo endereço</a>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
    </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="{{ asset('js/inputmask.min.js')}}"></script>
<script src="{{ asset('js/jquery.inputmask.min.js')}}"></script>
<script>
    (function() {
        $("#phone").inputmask({
            mask: ['(99) 9999-9999', '(99) 99999-9999'],
            keepStatic: true
            });

        $("#birthday").inputmask({
            mask: ['99/99/9999'],
            keepStatic: true
        });

        $("#rg").inputmask({
            mask: ['99.999.999-9'],
            keepStatic: true
        });

        $("#cpf").inputmask({
            mask: ['999.999.999-99'],
            keepStatic: true
        });

        var counter = 1;
        var btn = document.getElementById('newInput');
        var father = document.getElementById('addresses');

        var addInput = function() {
            counter++;

            var input =
                '<div class="form-group">' +
                    '<label for="adress">Endereço ('+ counter +'): <small style="color:red;"> Ex. Rua, Numero, Bairro -'+
                    '(Separados por ,)</small></label>' +
                    '<input type="text" required id="address' + counter + '" class="form-control" name="address[]" />' +
                '</div>';

            father.insertAdjacentHTML('beforeend', input)
        };

        btn.addEventListener('click', function() {
            addInput();
        }.bind(this));
})();
</script>
@endsection
