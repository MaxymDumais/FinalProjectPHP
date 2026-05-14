@extends('layout.app')
@section('content')
<div class="formular">
    <h1>Modification d'un pompier</h1>
    
    <form method="post" action="{{ route('modifyFireFighter', ['id' => $fireFighter->id]) }}">
    @csrf
        <label for="matricule">Matricule : </label>
        <input type="text" name="matricule" value="{{ $fireFighter->matricule}}" readonly>

        <label for="idGrade">Grade : </label>
        <select name="idGrade" id="idGrade">
            @foreach ($grades as $g)
                <option value="{{ $g->id }}" {{ $fireFighter->idGrade == $g->id ? 'selected' : '' }}>
                    {{ $g->description }}
                </option>
            @endforeach
        </select>

        <label for="lastName">Nom : </label>
        <input type="text" name="lastName" value="{{ $fireFighter->lastName}}" maxlength="50" required>

        <label for="firstName">Prénom : </label>
        <input type="text" name="firstName" value="{{ $fireFighter->firstName}}" maxlength="50" required>

        
        <button class="btn" type="submit">Modifier</button>
        <button type="button" class="btn" onclick="window.history.back()">Annuler</button>

        <input type="hidden" name="idFireStation" value="{{ $idFireStation }}">
    </form>
</div>
@endsection