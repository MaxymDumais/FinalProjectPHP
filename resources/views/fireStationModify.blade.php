@extends('layout.app')
@section('content')
<div class="formular">
    <h1>Modification d'une caserne</h1>

    <form method="post" action="{{ route('modifyFireStation', ['id' => $fireStation->id]) }}">
    @csrf
        <label for="name">Nom : </label>
        <input type="text" name="name" value="{{ $fireStation->name}}" maxlength="100" readonly>

        <label for="address">Adresse : </label>
        <input type="text" name="address" maxlength="200" value="{{ $fireStation->address}}" required>

        <label for="city">Ville : </label>
        <input type="text" name="city" maxlength="100" value="{{ $fireStation->city}}" required>

        <label for="id_state">Province : </label>
        <select name="id_state" id="id_state">
            @foreach ($states as $state)
                <option value="{{ $state->id }}" {{ $fireStation->id_state == $state->id ? 'selected' : '' }}>
                    {{ $state->description }}
                </option>
            @endforeach
        </select>

        <label for="phone">Téléphone : </label>
        <input type="text" name="phone" maxlength="12" value="{{ $fireStation->phone}}" required>

        <button class="btn" type="submit">Modifier</button>
        <button type="button" class="btn" onclick="window.history.back()">Annuler</button>
    </form>
</div>
@endsection