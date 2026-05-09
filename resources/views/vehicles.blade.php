@extends('layout.app')
@section('content')
<div class="aList">
    <h1>Sélectionnez une caserne : </h1>   
    <form method="get" action="route('vehiclesPage', $idFireStation)">
        <select name="idFireStation" id="idFireStation" onchange="window.location.href='{{ url('FireStations') }}/' + this.value + '/Vehicles'">
                @foreach ($fireStations as $selectedFireStation)
                    <option value="{{ $selectedFireStation->id }}" {{ request('idFireStation') == $selectedFireStation->id ? 'selected' : '' }}>
                        {{ $selectedFireStation->name}}
                    </option>
                @endforeach
        </select>
    </form>
</div>    
<div class="aList">
    @if($vehicles->count() == 0)
            <h1>Liste des véhicules (Aucun véhicule existant)</h1>
            <p>Liste des véhicules vide pour cette caserne... Les véhicules que vous ajouterez s'afficheront ici</p>
    @else
    <h1>Liste des véhicules ({{ $vehicles->count() < 2 ? $vehicles->count() . ' véhicule' : $vehicles->count() . ' véhicules' }})</h1>    
    <table class="table">
        <thead>
            <tr class="aInfoColumn">
                <td>Numéro d'identification</td>
                <td>Immatriculation</td>
                <td>Année de début de service</td>
                <td>Marque</td>
                <td>Modèle</td>
                <td>Type de véhicule</td>
                <td></td>
                        <td><button class="btn" type="submit">Vider la liste</button></td>
            </tr>
        </thead>
        <tbody>
            @foreach($vehicles as $v)
            <tr class="aColumn">
                <td>{{ $v->identificationNumber}}</td>
                <td>{{ $v->registration}}</td>
                <td>{{ $v->startYear}}</td>
                <td>{{ $v->brand}}</td>
                <td>{{ $v->model}}</td>
                <td>{{ $v->vehicleType->description}}</td>
                    <td><button class="btn" type="submit">Modifier</button></td>
                    <td><button class="btn">Supprimer</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

<div class="formular">
    <h1>Ajout d'un véhicule</h1>
    <form method="post" action="{{ route('addVehicle')}}">
        @csrf
                <label for="identificationNumber">Numéro d'identification : </label>
                <input type="number" name="identificationNumber" required>

                <label for="registration">Immatriculation : </label>
                <input type="text" name="registration" maxlength="7" required>

                <label for="startYear">Année de début de service : </label>
                <input type="number" name="startYear" required>

                <label for="brand">Marque : </label>
                <input type="text" name="brand" maxlength="100" required>

                <label for="model">Modèle : </label>
                <input type="text" name="model" maxlength="100" required>
                
                <label for="idVehicleType">Type de véhicule : </label>
                <select name="idVehicleType" id="idVehicleType">
                @foreach ($vehicleTypes as $vt)
                    <option value="{{ $vt->id }}">
                        {{ $vt->description }}
                    </option>
                @endforeach
                </select>
                <button class="btn" type="submit">Créer</button>

                <input type="hidden" name="idFireStation" value="{{ $fireStation->id }}">
    </form>
</div>
@endsection