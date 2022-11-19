@php $relationshipField = $row->field; @endphp

@if(isset($view) && ($view == 'browse' || $view == 'read'))

    @php
        $relationshipData = (isset($data)) ? $data : $dataTypeContent;
        $model = app($options->model);
        $query = $model::where($options->key,$relationshipData->{$options->meta_key})->first();

    @endphp

    @if(isset($query))
        <p>{{ $query->{$options->label} }}</p>
    @else
        <p>{{ __('voyager::generic.no_results') }}</p>
    @endif

@else

    <select
        class="form-control select2-ajax" name="{{ $options->meta_key }}[]"
        data-get-items-route="{{route('voyager.' . $dataType->slug.'.relation')}}"
        data-get-items-field="{{$row->field}}"
        @if(!is_null($dataTypeContent->getKey())) data-id="{{$dataTypeContent->getKey()}}" @endif
        data-method="{{ !is_null($dataTypeContent->getKey()) ? 'edit' : 'add' }}"
        @if($row->required == 1) required @endif
        multiple >
        @php
            $model = app($options->model);
            $query = $model::where($options->key, old($options->meta_key, $dataTypeContent->{$options->meta_key}))->get();
        @endphp


        @php
        $selected_keys = [];
        $selected_keys = $dataTypeContent->{$options->meta_key};
        $selected_values = app($options->model)->whereIn($options->key, $selected_keys)->pluck($options->label, $options->key);
        @endphp

        @if(!$row->required)
            <option value="">{{__('voyager::generic.none')}}</option>
        @endif

        @foreach ($selected_values as $key => $value)
            <option value="{{ $key }}" selected="selected">{{ $key.' '.$value}}</option>
        @endforeach
    </select>

@endif
