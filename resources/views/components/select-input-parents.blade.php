@props(['options', 'parent' => false, 'exists_id'])
@php
    use App\Enums\EntityParent;
@endphp
<select @class([
    'form-select mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600 w-full select2' => !$parent,
]) {{ $attributes }} @if ($parent)
    data-parent="true"
    data-tags="true"
    style="display: none;"
    @endif>
    @foreach ($options as $value)
        <option value="{{ $value->value }}" {{ $value === $exists_id ? 'selected' : '' }}>
            {{ EntityParent::from($value->value)->getLabelText() }}
        </option>
    @endforeach
</select>
