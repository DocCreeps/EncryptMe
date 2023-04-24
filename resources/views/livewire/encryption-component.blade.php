<div class="flex flex-row space-x-4">
    <div class="w-1/3">
        <form wire:submit.prevent="encrypt">
            @csrf
            <div class="mb-4">
                <label for="input" class="block font-medium mb-2">Texte à chiffrer/déchiffrer :</label>
                <textarea id="input" name="input" class="form-input w-full" rows="5" wire:model="input"></textarea>
            </div>

            <div class="mb-4">
                <label for="mode" class="block font-medium mb-2">Mode de chiffrement :</label>
                <select id="mode" name="mode" class="form-select w-full" wire:model="mode">
                    <option value="cesar">Chiffrement de César</option>
                    <option value="vigenere">Chiffrement de Vigenère</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="key" class="block font-medium mb-2">Clé de chiffrement :</label>
                <input type="text" id="key" name="key" class="form-input w-full" wire:model="key">
            </div>

            <button type="submit" class="btn btn-primary">Chiffrer/Déchiffrer</button>
        </form>
    </div>

    <div class="w-1/3">
        <div class="font-medium mb-2">Résultat :</div>
        <div id="output" class="bg-gray-100 p-4 h-full" wire:loading.remove>
            {{ $output }}
        </div>
        <div class="bg-gray-100 p-4 h-full flex justify-center items-center" wire:loading>
            Chargement...
        </div>
    </div>

    <div class="w-1/3"></div>
</div>

