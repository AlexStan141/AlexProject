<textarea
    name="{{ $name }}"
    placeholder="{{ $placeholder }}"
    rows="{{ $rows }}"
    {{ $required ? 'required' : '' }}
    {{ $attributes->merge(['class' => 'w-200 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-3 py-2 ring-slate-500 ring-1 placeholder:text-slate-500']) }}
>{{ old($name, $value) }}</textarea>

