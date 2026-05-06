@php
    $firstFireStationId = \App\Models\FireStation::value('id');
@endphp

<ul class="navbar">
    <img src="{{ asset('../../pictures/firefighter logo.png') }}" alt="Logo" class="logo">
    <li><a href="{{ route('fireStationsPage') }}">Liste des casernes</a></li>
    <li><a href="{{ $firstFireStationId ? route('interventionFilesPage', $firstFireStationId) : '#' }}">Liste des interventions</a></li>
    <li><a href="{{ route('interventionTypesPage') }}">Liste des types d'interventions</a></li>
    <li><a href="{{ route('gradesPage') }}">Liste des grades</a></li>
</ul>
