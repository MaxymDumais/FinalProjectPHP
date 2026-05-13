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
                <form action="{{ route('clearListFireFighter', $fireStation->id) }}" method="POST" onsubmit="return confirm('Supprimer la liste des pompiers ?')">
                    @csrf
                    @method('DELETE')
                        <td><button class="btn" type="submit">Vider la liste</button></td>
                </form>
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
                <form action="{{ route('formModifyFireFighter', [$ff->id, $fireStation->id]) }}" method="GET">
                    <td><button class="btn" type="submit">Modifier</button></td>
                </form>
                <form action="{{ route('deleteFireFighter', $ff->id) }}" method="POST" onsubmit="return confirm('Supprimer ce pompier ?')">
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
    <h1>Ajout d'un pompier</h1>
    <form method="post" action="{{ route('addFireFighter')}}">
        @csrf
                <label for="matricule">Matricule : </label>
                <input type="text" name="matricule" required>
                <label for="idGrade">Grade : </label>
                <select name="idGrade" id="idGrade">
                @foreach ($grades as $g)
                    <option value="{{ $g->id }}">
                        {{ $g->description }}
                    </option>
                @endforeach
                </select>
                <label for="lastName">Nom : </label>
                <input type="text" name="lastName">
                <label for="firstName">Prénom : </label>
                <input type="text" name="firstName">
                
                @if($grades->count() > 0)
                <button class="btn" type="submit">Créer</button>
                @else
                <label>Besoin d'au moins un grade pour créer un pompier</label>
                @endif

                <input type="hidden" name="idFireStation" value="{{ $fireStation->id }}">
    </form>
</div>
@endsection