@props(['options', 'parent' => false])
<select @class([
    'form-select mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600 w-full' => !$parent,
]) {{ $attributes }} @if ($parent)
    data-parent="true"
    data-tags="true"
    style="display: none;"
    @endif>
    @foreach ($options as $key => $value)
        <option value="{{ $value->id }}">{{ $value->place }} - Mesa: {{ $value->table }}</option>
    @endforeach
</select>
