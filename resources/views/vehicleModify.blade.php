@extends('layout.app')
@section('content')
<div class="formular">
    <h1>Modification d'un pompier</h1>
    
    <form method="post" action="{{ route('modifyVehicle', ['id' => $vehicle->id]) }}">
        @csrf
                <label for="identificationNumber">Numéro d'identification : </label>
                <input type="number" name="identificationNumber" value="{{ $vehicle->identificationNumber}}" readonly>

                <label for="registration">Immatriculation : </label>
                <input type="text" name="registration" maxlength="7" value="{{ $vehicle->registration}}" required>

                <label for="startYear">Année de début de service : </label>
                <input type="number" name="startYear" value="{{ $vehicle->startYear}}" required>

                <label for="brand">Marque : </label>
                <input type="text" name="brand" maxlength="100" value="{{ $vehicle->brand}}" required>

                <label for="model">Modèle : </label>
                <input type="text" name="model" maxlength="100" value="{{ $vehicle->model}}" required>
                
                <label for="idVehicleType">Type de véhicule : </label>
                <select name="idVehicleType" id="idVehicleType">
                @foreach ($vehicleTypes as $vt)
                    <option value="{{ $vt->id }}">
                        {{ $vt->description }}
                    </option>
                @endforeach
                </select>
                <button class="btn" type="submit">Créer</button>

                <input type="hidden" name="idFireStation" value="{{ $idFireStation }}">
    </form>
</div>
@endsection