@php $editing = isset($reservation) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="salle_id" label="Salle">
            @php $selected = old('salle_id', ($editing ? $reservation->salle_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Salle</option>
            @foreach($salles as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="classe_id" label="Classe" required>
            @php $selected = old('classe_id', ($editing ? $reservation->classe_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Classe</option>
            @foreach($classes as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
