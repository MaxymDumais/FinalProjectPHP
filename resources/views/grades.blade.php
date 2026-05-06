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
                    <td></td>
                        <td><button class="btn" type="submit">Vider la liste</button></td>
                </tr>
            </thead>
            <tbody>
                @foreach($grades as $g)
                <tr class="aColumn">
                    <td>{{ $g->description }}</td>
                        <td><button class="btn" type="submit">Modifier</button></td>
                        <td><button class="btn" type="submit">Supprimer</button></td>
                </tr>
                @endforeach
            </tbody>
        </table> 
    @endif
</div>
@endsection