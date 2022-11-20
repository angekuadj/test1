@php $editing = isset($emploi) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="classe_id" label="Classe" required>
            @php $selected = old('classe_id', ($editing ? $emploi->classe_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Classe</option>
            @foreach($classes as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="salle_id" label="Salle" required>
            @php $selected = old('salle_id', ($editing ? $emploi->salle_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Salle</option>
            @foreach($salles as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $emploi->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="Ddebut"
            label="Ddebut"
            :value="old('Ddebut', ($editing ? $emploi->Ddebut : ''))"
            maxlength="255"
            placeholder="Ddebut"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="Dfin"
            label="Dfin"
            :value="old('Dfin', ($editing ? $emploi->Dfin : ''))"
            maxlength="255"
            placeholder="Dfin"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="prof_id" label="Prof" required>
            @php $selected = old('prof_id', ($editing ? $emploi->prof_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Prof</option>
            @foreach($profs as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
