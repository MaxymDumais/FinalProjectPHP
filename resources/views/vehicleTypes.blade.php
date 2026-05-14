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
                <form action="{{ route('clearListVehicleType') }}" method="POST" onsubmit="return confirm('Supprimer la liste des types de véhicules ?')">
                    @csrf
                    @method('DELETE')
                        <td><button class="btn" type="submit">Vider la liste</button></td>
                </form>
            </tr>
        </thead>
        <tbody>
            @foreach($vehicleTypes as $vt)
            <tr class="aColumn">
                <td>{{ $vt->code}}</td>
                <td>{{ $vt->description}}</td>
                <form action="{{ route('formModifyVehicleType', $vt->id) }}" method="GET">
                        <td><button class="btn" type="submit">Modifier</button></td>
                </form>
                <form action="{{ route('deleteVehicleType', $vt->id) }}" method="POST" onsubmit="return confirm('Supprimer ce type de véhicule ?')">
                    @csrf
                    @method('DELETE')
                    <td><button class="btn">Supprimer</button></td>
                </form>
                
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
                <input type="number" name="code" required>
                
                <label for="description">Description : </label>
                <input type="text" name="description" maxlength="100" required>

                <button class="btn" type="submit">Créer</button>
    </form>
</div>
@endsection