@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h3 class="display-3">Editar cliente #{{ $customer->id }}</h1>
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
                <form method="post" action="{{ route('customer.update', $customer->id) }}">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="first_name">Nome:</label>
                        <input type="text" class="form-control" name="name" value="{{ $customer->name }}" />
                    </div>

                    <div class="form-group">
                        <label for="email">CPF:</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" id="cpf"
                            value="{{ $customer->cpf }}" />
                    </div>
                    <div class="form-group">
                        <label for="city">RG:</label>
                        <input type="text" class="form-control" id="rg" name="rg" id="rg" value="{{ $customer->rg }}" />
                    </div>
                    <div class="form-group">
                        <label for="country">Telefone:</label>
                        <input type="text" class="form-control" id="phone" name="phone" id="phone"
                            value="{{ $customer->phone }}" />
                    </div>
                    <div class="form-group">
                        <label for="job_title">Nascimento:</label>
                        <input type="text" class="form-control" id="birthday" name="birthday"
                            value="{{ $customer->birthday }}" />
                    </div>

                    <div id="addresses">
                        <div class="form-group">
                            @foreach($customer->addresses as $i => $address)
                            <label for="job_title">Endereço ({{ $i+1 }}): <small style="color:red;">Ex. Rua, Numero,
                                    Bairro -
                                    (Separados por ,)</small></label>
                            <input type="text" readonly id="address{{ $i+1 }}" class="form-control"
                                value="{{ $address->street }}, {{ $address->number }}, {{ $address->neighborhood }}"
                                name="address[]" />
                            @endforeach
                        </div>
                    </div>
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
    })();
</script>
@endsection
