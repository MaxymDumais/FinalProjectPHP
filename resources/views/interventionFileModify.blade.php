@extends('layout.app')
@section('content')
<div class="formular">
    <h1>Modification d'une fiche d'intervention</h1>
    
    <form method="post" action="{{ route('modifyInterventionFile', ['id' => $interventionFile->id]) }}">
    @csrf
        <label for="dateTimeIntervention">Date d'intervention : </label>
        <input type="text" name="dateTimeIntervention" value="{{ $interventionFile->dateTimeIntervention}}" readonly>

        <label for="address">Adresse : </label>
        <input type="text" name="address" maxlength="200" value="{{ $interventionFile->address}}" required>

        <label for="idInterventionType">Type d'intervention : </label>
        <select name="idInterventionType" id="idInterventionType">
            @foreach ($interventionTypes as $it)
                <option value="{{ $it->id }}" {{ $interventionFile->idInterventionType == $it->id ? 'selected' : '' }}>
                    {{ $it->description }}
                </option>
            @endforeach
        </select>

        <label for="summary">Résumé : </label>
        <input type="text" name="summary" value="{{ $interventionFile->summary}}" required>

        <button class="btn" type="submit">Modifier</button>
        <button type="button" class="btn" onclick="window.history.back()">Annuler</button>

        <input type="hidden" name="idFireStation" value="{{ $idFireStation }}">
        <input type="hidden" name="idCaptain" value="{{ $idCaptain }}">
    </form>
</div>
@endsection