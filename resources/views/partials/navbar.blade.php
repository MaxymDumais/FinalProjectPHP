@php
    $firstFireStationId = \App\Models\FireStation::value('id');
    $firstCaptainId = \App\Models\FireFighter::whereHas('grade', function ($query) {$query->where('description', 'Capitaine');})->value('id');
@endphp

<ul class="navbar">
    <img src="{{ asset('../../pictures/firefighter logo.png') }}" alt="Logo" class="logo">
    <li><a href="{{ route('fireStationsPage') }}">Liste des casernes</a></li>
    <li><a href="{{ ($firstFireStationId && $firstCaptainId) ? route('interventionFilesPage', [$firstFireStationId, $firstCaptainId]) : '#' }}">Liste des interventions</a></li>
    <li><a href="{{ route('interventionTypesPage') }}">Liste des types d'interventions</a></li>
    <li><a href="{{ route('gradesPage') }}">Liste des grades</a></li>
    <li><a href="{{$firstFireStationId ? route('fireFightersPage', $firstFireStationId) : '#' }}">Liste des pompiers</a></li>
        <li><a href="{{$firstFireStationId ? route('vehiclesPage', $firstFireStationId) : '#' }}">Liste des véhicules</a></li>
    <li><a href="{{ route('vehicleTypesPage') }}">Liste des types de véhicules</a></li>

</ul>
