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
                <td>{{ $v->grade->registration}}</td>
                <td>{{ $v->startYear}}</td>
                <td>{{ $v->brandt}}</td>
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
@endsection