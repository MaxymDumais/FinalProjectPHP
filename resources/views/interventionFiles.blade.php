@extends('layout.app')
@section('content')
<div class="aList">
<h1>Sélectionnez une caserne : </h1>   
    <form method="get" action="route('interventionFilesPage', $idFireStation)">
        <select name="idFireStation" id="idFireStation" onchange="window.location.href='{{ url('FireStations') }}/' + this.value + '/InterventionFiles'">
                @foreach ($fireStations as $fireStation)
                    <option value="{{ $fireStation->id }}" {{ request('idFireStation') == $fireStation->id ? 'selected' : '' }}>
                        {{ $fireStation->name}}
                    </option>
                @endforeach
        </select>
    </form>
</div>    
<div class="aList">
    @if($interventionFiles->count() == 0)
            <h1>Liste des fiches d'interventions (Aucune fiche d'intervention existante)</h1>
            <p>Liste des fiches d'interventions vide pour cette caserne... Les fiches d'interventions que vous ajouterez s'afficheront ici</p>
    @else
    <h1>Liste des fiches d'interventions ({{ $interventionFiles->count() < 2 ? $interventionFiles->count() . ' intervention' : $interventionFiles->count() . ' interventions' }})</h1>    
    <table class="table">
        <thead>
            <tr class="aInfoColumn">
                <td>Date d'intervention</td>
                <td>Adresse</td>
                <td>Résumé</td>
                <td>Type d'intervention</td>
                <td></td>
                
            </tr>
        </thead>
        <tbody>
            @foreach($interventionFiles as $if)
            <tr class="aColumn">
                <td>{{ $if->dateTimeIntervention}}</td>
                <td>{{ $if->address}}</td>
                <td>{{ $if->summary}}</td>
                <td>{{ $if->interventionType->description}}</td>
                
                
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection