<div class="col-span-1">
    <label for="{{ $name }}" class="block text-sm font-semibold text-gray-600 mb-2">{{ $label }}</label>
    <input 
        type="{{ $type ?? 'text' }}" 
        name="{{ $name }}" 
        id="{{ $name }}" 
        value="{{ old($name, $value ?? '') }}" 
        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 text-gray-700"
    >
    @error($name)
        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
    @enderror
</div>
