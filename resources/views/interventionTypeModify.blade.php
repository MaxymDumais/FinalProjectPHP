@extends('layout.app')
@section('content')
<div class="formular">
    <h1>Modification d'un type d'intervention</h1>

    <form method="post" action="{{ route('modifyInterventionType', ['id' => $interventionType->id]) }}">
    @csrf
        <label for="interventionNumber">Numéro d'intervention : </label>
        <input type="text" name="interventionNumber" value="{{ $interventionType->interventionNumber}}" readonly>

        <label for="description">Description : </label>
        <input type="text" name="description" value="{{ $interventionType->description}}">

        <button class="btn" type="submit">Modifier</button>
        <button type="button" class="btn" onclick="window.history.back()">Annuler</button>
    </form>
</div>
@endsection