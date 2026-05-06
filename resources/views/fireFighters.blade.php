@extends('layout.app')
@section('content')
<div class="aList">
    <h1>Sélectionnez une caserne : </h1>   
    <form method="get" action="route('fireFightersPage', $idFireStation)">
        <select name="idFireStation" id="idFireStation" onchange="window.location.href='{{ url('FireStations') }}/' + this.value + '/FireFighters'">
                @foreach ($fireStations as $selectedFireStation)
                    <option value="{{ $selectedFireStation->id }}" {{ request('idFireStation') == $selectedFireStation->id ? 'selected' : '' }}>
                        {{ $selectedFireStation->name}}
                    </option>
                @endforeach
        </select>
    </form>
</div>    
<div class="aList">
    @if($fireFighters->count() == 0)
            <h1>Liste des pompiers (Aucun pompier existant)</h1>
            <p>Liste des pompiers vide pour cette caserne... Les pompiers que vous ajouterez s'afficheront ici</p>
    @else
    <h1>Liste des pompiers ({{ $fireFighters->count() < 2 ? $fireFighters->count() . ' pompier' : $fireFighters->count() . ' pompiers' }})</h1>    
    <table class="table">
        <thead>
            <tr class="aInfoColumn">
                <td>Matricule</td>
                <td>Grade</td>
                <td>Nom</td>
                <td>Prénom</td>
                <td>Caserne</td>
                <td></td>
                <td><button class="btn" type="submit">Vider la liste</button></td>
            </tr>
        </thead>
        <tbody>
            @foreach($fireFighters as $ff)
            <tr class="aColumn">
                <td>{{ $ff->matricule}}</td>
                <td>{{ $ff->grade->description}}</td>
                <td>{{ $ff->lastName}}</td>
                <td>{{ $ff->firstName}}</td>
                <td>{{ $ff->fireStation->name}}</td>
                    <td><button class="btn" type="submit">Modifier</button></td>
                    <td><button class="btn">Supprimer</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection