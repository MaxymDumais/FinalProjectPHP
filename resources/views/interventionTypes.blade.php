@extends('layout.app')
@section('content')
<div class="aList">
    @if($interventionTypes->count() == 0)
            <h1>Liste des types d'interventions (Aucune caserne existante)</h1>
            <p>Liste des types d'interventions vide... Les types d'interventions que vous ajouterez s'afficheront ici</p>
    @else
    <h1>Liste des types d'interventions ({{ $interventionTypes->count() < 2 ? $interventionTypes->count() . ' intervention' : $interventionTypes->count() . ' interventions' }})</h1>    
    <table class="table">
        <thead>
            <tr class="aInfoColumn">
                <td>Numéro d'intervention</td>
                <td>description</td>
                <td></td>
                <td><button class="btn">Vider la liste</button></td>
            </tr>
        </thead>
        <tbody>
            @foreach($interventionTypes as $it)
            <tr class="aColumn">
                <td>{{ $it->interventionNumber}}</td>
                <td>{{ $it->description}}</td>
                <td><td><button class="btn">Modifier</button></td>
                <td><td><button class="btn">Supprimer</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection