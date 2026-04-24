@extends('layout.app')
@section('content')
    <h1>List of all the available fire stations</h1>

        <table class="table">
            <thead>
                <tr>
                    <td>Nom</td>
                    <td>Adresse</td>
                    <td>Ville</td>
                    <td>Province</td>
                    <td>Téléphone</td>
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
                </tr>
                @endforeach
            </tbody>
        </table>
@endsection