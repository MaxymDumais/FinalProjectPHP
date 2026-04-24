@extends('layout.app')
@section('content')
    <h1>Liste des casernes de pompiers</h1>
        @if($fireStations->count() == 0)
            <p>La liste des casernes est vide... Les casernes que vous ajouterez s'afficheront ici</p>
        @else

        <table class="table">
            <thead>
                <tr>
                    <td>Nom</td>
                    <td>Adresse</td>
                    <td>Ville</td>
                    <td>Province</td>
                    <td>Téléphone</td>
                    <td></td>
                    <form action="{{ route('clearListFireStation') }}" method="POST" onsubmit="return confirm('Supprimer la liste des casernes ?')">
                    @csrf
                    @method('DELETE')
                        <td><button class="btn" type="submit">Vider la liste</button></td>
                    </form>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($fireStations as $fs)
                <tr>
                    <td>{{ $fs->name }}</td>
                    <td>{{ $fs->address }}</td>
                    <td>{{ $fs->city }}</td>
                    <td>{{ $fs->state->description }}</td>
                    <td>{{ $fs->phone }}</td>
                    <form action="{{ route('formModifyFireStation', $fs->id) }}" method="GET">
                        <td><button class="btn" type="submit">Modifier</button></td>
                    </form>
                    <form action="{{ route('deleteFireStation', $fs->id) }}" method="POST" onsubmit="return confirm('Supprimer cette caserne ?')">
                    @csrf
                    @method('DELETE')
                        <td><button class="btn" type="submit">Supprimer</button></td>
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>

        @endif

        <h1>Création d'une caserne</h1>

    <form method="post" action="{{ route('addFireStation') }}"">
    @csrf
        <label for="name">Nom : </label>
        <input type="text" name="name">
        <label for="address">Adresse : </label>
        <input type="text" name="address">
        <label for="city">Ville : </label>
        <input type="text" name="city">
        <label for="id_state">Province : </label>
        <select name="id_state" id="state">
            @foreach ($states as $state)
                <option value="{{ $state->id }}">
                    {{ $state->description }}
                </option>
            @endforeach
        </select>
        <label for="phone">Numéro de téléphone : </label>
        <input type="text" name="phone">
        <button class="btn" type="submit">Créer</button>
    </form>
@endsection