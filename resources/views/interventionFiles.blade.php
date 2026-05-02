@extends('layout.app')
@section('content')
<div class="aList">
<h1>Sélectionnez une caserne : </h1>   
    <form method="get" action="route('interventionFilesPage', $idFireStation)">
        <select name="idFireStation" id="idFireStation" onchange="window.location.href='{{ url('FireStations') }}/' + this.value + '/InterventionFiles'">
                @foreach ($fireStations as $selectedFireStation)
                    <option value="{{ $selectedFireStation->id }}" {{ request('idFireStation') == $selectedFireStation->id ? 'selected' : '' }}>
                        {{ $selectedFireStation->name}}
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
                <td>Type d'intervention</td>
                <td>Résumé</td>
                <td></td>
               <form action="{{ route('clearListInterventionFile', $fireStation->id) }}" method="POST" onsubmit="return confirm('Supprimer la liste des fiches d\'interventions ?')">
                    @csrf
                    @method('DELETE')
                        <td><button class="btn" type="submit">Vider la liste</button></td>
                </form>
            </tr>
        </thead>
        <tbody>
            @foreach($interventionFiles as $if)
            <tr class="aColumn">
                <td>{{ $if->dateTimeIntervention}}</td>
                <td>{{ $if->address}}</td>
                <td>{{ $if->interventionType->description}}</td>
                <td>{{ $if->summary}}</td>
                <form action="{{ route('formModifyInterventionFile', [$if->id, $fireStation->id]) }}" method="GET">
                    <td><button class="btn" type="submit">Modifier</button></td>
                </form>
                <form action="{{ route('deleteInterventionFile', $if->id) }}" method="POST" onsubmit="return confirm('Supprimer cette fiche d\'intervention ?')">
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
    <h1>Création d'une fiche d'intervention</h1>
    <form method="post" action="{{ route('addInterventionFile')}}">
        @csrf
                <label for="address">Adresse : </label>
                <input type="text" name="address">
                <label for="idInterventionType">Type d'intervention : </label>
                <select name="idInterventionType" id="idInterventionType">
                @foreach ($interventionTypes as $it)
                    <option value="{{ $it->id }}">
                        {{ $it->description }}
                    </option>
                @endforeach
                </select>
                <label for="summary">Résumé : </label>
                <input type="text" name="summary">
                <button class="btn" type="submit">Créer</button>

                <input type="hidden" name="idFireStation" value="{{ $fireStation->id }}">
    </form>
</div>
@endsection