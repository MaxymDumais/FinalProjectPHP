@extends('layout.app')
@section('content')
<div class="aList">
    @if($vehicleTypes->count() == 0)
            <h1>Liste des types de véhicules (Aucun type de véhicule existante)</h1>
            <p>Liste des types de véhicules vide... Les types de véhicules que vous ajouterez s'afficheront ici</p>
    @else
    <h1>Liste des types de véhicules ({{ $vehicleTypes->count() < 2 ? $vehicleTypes->count() . ' type de véhicule' : $vehicleTypes->count() . ' types de véhicules' }})</h1>    
    <table class="table">
        <thead>
            <tr class="aInfoColumn">
                <td>Code</td>
                <td>Description</td>
                <td></td>
                        <td><button class="btn" type="submit">Vider la liste</button></td>
            </tr>
        </thead>
        <tbody>
            @foreach($vehicleTypes as $vt)
            <tr class="aColumn">
                <td>{{ $vt->code}}</td>
                <td>{{ $vt->description}}</td>
                        <td><button class="btn" type="submit">Modifier</button></td>
                    <td><button class="btn">Supprimer</button></td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

<div class="formular">
    <h1>Création d'un type de véhicule</h1>
    <form method="post" action="{{ route('addVehicleType')}}">
        @csrf
                <label for="code">Code : </label>
                <input type="text" name="code">
                <label for="description">Description : </label>
                <input type="text" name="description">
                <button class="btn" type="submit">Créer</button>
    </form>
</div>
@endsection