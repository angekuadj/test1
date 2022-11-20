@php $editing = isset($salle) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="nom"
            label="Nom"
            :value="old('nom', ($editing ? $salle->nom : ''))"
            maxlength="255"
            placeholder="Nom"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="qte"
            label="Qte"
            :value="old('qte', ($editing ? $salle->qte : ''))"
            max="255"
            placeholder="Qte"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
