@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-4 float-left">Clientes</h1>
            <a href="{{ route("customer.create") }}" class="btn btn-warning float-right mt-3">Novo Cliente</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Name</td>
                        <td>Rua</td>
                        <td>Número</td>
                        <td>Bairro</td>
                        <td>CPF</td>
                        <td>RG</td>
                        <td>Nascimento</td>
                        <td>Telefone</td>
                        <td colspan=2>Ações</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                    <tr>
                        <td>{{$customer->id}}</td>
                        <td>{{$customer->name}}</td>
                        <td>
                            @foreach($customer->addresses as $address)
                            <small style="font-size: 10px;">{{ $address->street }}</small><br>
                            @endforeach
                        </td>
                        <td>
                            @foreach($customer->addresses as $address)
                            <small style="font-size: 10px;">{{ $address->number }}</small><br>
                            @endforeach
                        </td>
                        <td>
                            @foreach($customer->addresses as $address)
                            <small style="font-size: 10px;">{{ $address->neighborhood }}</small><br>
                            @endforeach
                        </td>
                        <td>{{ substr($customer->cpf, 0, 10) . '...' }}</td>
                        <td>{{ substr($customer->rg, 0, 10) . '...' }}</td>
                        <td>{{ \Carbon\Carbon::parse($customer->birthday)->format('d/m/Y')}}</td>
                        <td>{{ substr($customer->phone, 0, 8) . '...' }}</td>
                        <td>
                            <a href="{{ route('customer.edit',$customer->id)}}" class="btn btn-primary">Editar</a>
                        </td>
                        <td>
                            <form action="{{ route('customer.destroy', $customer->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Remover</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
            </div>
        </div>
        @endsection
