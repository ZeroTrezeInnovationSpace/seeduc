@extends('layouts.attendanceList') 
@section('content')
  <br>
  <div style="text-align: center;">
    <h2>Lista de Presença</h2>
    <h5>{{$subscriptions[0]->name}}</h5>
  </div>
  <br>
  <table class="table table-bordered" >
    <thead>
      <tr>
        <th scope="col">Nome</th>
        <th scope="col">CPF</th>
        <th scope="col">Email</th>
        <th scope="col">Assinatura</th>
      </tr>
    </thead>
    <tbody>
      @foreach($subscriptions as $subscription)
      <tr>
        <td scope="row" name="user_name">{{ $subscription->username }}</td>
        <td scope="row" name="user_cpf">{{ $subscription->CPF }}</td>
        <td scope="row" name="user_email">{{ $subscription->email }}</td>
        <td scope="row" name="sign"></td>
      </tbody>
      @endforeach
    </table>
  @endsection
