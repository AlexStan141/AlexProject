<input type="{{ $type }}" name="{{ $name }}"
    value="{{ is_array(old($name, $value)) ? '' : old($name, $value) }}" placeholder="{{ $placeholder }}"
    {{ $required ? 'required' : '' }}
    {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-3 py-2 ring-slate-500 ring-1 placeholder:text-slate-500']) }}>
