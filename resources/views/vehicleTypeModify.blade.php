@extends('layout.app')
@section('content')
<div class="formular">
    <h1>Modification d'un type de véhicule</h1>

    <form method="post" action="{{ route('modifyVehicleType', ['id' => $vehicleType->id]) }}">
    @csrf
        <label for="code">Code : </label>
        <input type="text" name="code" value="{{ $vehicleType->code}}" readonly>

        <label for="description">Description : </label>
        <input type="text" name="description" value="{{ $vehicleType->description}}" maxlength="100" required>

        <button class="btn" type="submit">Modifier</button>
        <button type="button" class="btn" onclick="window.history.back()">Annuler</button>
    </form>
</div>
@endsection