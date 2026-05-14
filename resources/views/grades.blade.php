@extends('layout.app')
@section('content')
<div class="aList">
    @if($grades->count() == 0)
        <h1>Liste des grades (Aucun grade existant)</h1>
        <p>Liste des grades vide... Les grades que vous ajouterez s'afficheront ici</p>
    @else
       <h1>Liste des grades ({{ $grades->count() < 2 ? $grades->count() . ' grade' : $grades->count() . ' grades' }})</h1>
       <table class="table"> 
            <thead>
                <tr class="aInfoColumn">
                    <td>Description</td>
                    <form action="{{ route('clearListGrade') }}" method="POST" onsubmit="return confirm('Supprimer la liste des grades ?')">
                    @csrf
                    @method('DELETE')
                        <td><button class="btn" type="submit">Vider la liste</button></td>
                    </form>
                </tr>
            </thead>
            <tbody>
                @foreach($grades as $g)
                <tr class="aColumn">
                    <td>{{ $g->description }}</td>
                    <form action="{{ route('deleteGrade', $g->id) }}" method="POST" onsubmit="return confirm('Supprimer ce grade ?')">
                    @csrf
                    @method('DELETE')
                        <td><button class="btn" type="submit">Supprimer</button></td>
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table> 
    @endif
</div>

<div class="formular">
    <h1>Création d'un grade</h1>

    <form method="post" action="{{ route('addGrade') }}">
    @csrf
            <label for="name">Description : </label>
            <input type="text" name="description" maxlength="200" required>
            
            <button class="btn" type="submit">Créer</button>
    </form>
</div>
@endsection