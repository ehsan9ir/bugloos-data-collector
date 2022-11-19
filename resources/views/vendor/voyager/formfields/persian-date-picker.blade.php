@php
    $gregorianDate = null;
    if(!is_null($dataTypeContent->{$row->field}))
        $gregorianDate = old($row->field, $dataTypeContent->{$row->field}) ;
    $rowFieldJalali = 'date_'.$row->field;
@endphp
<input class="observer-example form-control"
       id="date_{{ $row->field }}"
       placeholder="{{ $row->getTranslatedAttribute('display_name') }}"
       value="@if(isset($dataTypeContent->{$row->field})){{
       $gregorianDate }}@else{{old($row->field)}}@endif">

<input class="observer-example-alt form-control" type="hidden" name="{{ $row->field }}" id="date_{{ $row->field }}_alt"
       placeholder="{{ $row->getTranslatedAttribute('display_name') }}"
       value="@if( property_exists($row->details, 'format') && !is_null($data->{$row->field}) )
       {{ \Carbon\Carbon::parse($data->{$row->field})->formatLocalized($row->details->format) }}
       @else
       {{old($row->field)}}
       @endif">


@push('javascript')

    <script>
        $('document').ready(function ()  {
            var tmpAlt = '{{$rowFieldJalali}}' ;
            $('#'+tmpAlt).persianDatepicker({
                altFormat: 'X',
                observer: true,
                initialValue: true,
                initialValueType: 'gregorian' ,
                format: 'YYYY/MM/DD HH:mm:ss',
                altField: '#'+tmpAlt + '_alt',
                timePicker: {
                    enabled: true,
                    meridiem: {
                        enabled: true
                    }
                },
                onSelect: function (unix) {
                    var tmp = getDateFormatForPersian(unix);
                    $('#'+tmpAlt+'_alt').val(tmp);
                }
            });

            $('#'+tmpAlt+'_alt').ready(function ()  {
                var unixValue = '{{$gregorianDate}}' ;
                if(unixValue) {
                    var DateTmp = getDateFormatForPersian(unixValue);
                    $('#'+tmpAlt+'_alt').val(DateTmp);
                }
                else {
                    $('#'+tmpAlt+'_alt').val(null);
                }
            });

            function getDateFormatForPersian(date1) {
                var d = new Date(date1),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();
                    hour = d.getHours();
                    minutes = d.getMinutes();
                    seconds = d.getSeconds();

                if (month.length < 2)
                    month = '0' + month;
                if (day.length < 2)
                    day = '0' + day;
                var date = new Date();
                date.toLocaleDateString();

                return [year, month, day].join('-')+' '+hour+':'+minutes+':'+seconds;
            };

        });

    </script>
@endpush
