@extends('main')
@section('title', '| Visualização de Pneu')
@section('content')
		<input type="hidden" id="cod" name="cod" value="{{$pneu->cod}}">
	<div class="card">
		<h2 class="card-header text-center">Código: {{$pneu->cod}}</h2>
		<div class="card-body">
			<ul class="list-group">
				<li class="list-group-item"><b>ID: {{$pneu->id}}</b></li>
				<li class="list-group-item"><b>Dia em que foi cadastrado: {{$pneu->created_at->toDateString()}}</b></li>
				<li class="list-group-item"><b>Hora em que foi cadastrado: {{$pneu->created_at->toTimeString()}}</b></li>
			</ul>
			&nbsp;
			<button id="btn" class="btn btn-block btn-primary" onclick="print()">Imprimir novamente</button>
		</div>
	</div>
@endsection
@section('scripts')
	{!! Html::script('js/main.js')!!}
@endsection