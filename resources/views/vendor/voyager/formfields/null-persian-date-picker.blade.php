@php
    $gregorianDate = $oldDate;
    $rowFieldJalali = 'date_'.$dateField;
@endphp
<input class="observer-example form-control"
       id="date_{{ $dateField }}"
       placeholder="تاریخ شروع"
       value="{{ $gregorianDate }}">

<input class="observer-example-alt form-control" type="hidden" name="{{ $dateField }}" id="date_{{ $dateField }}_alt"
       placeholder="تاریخ شروع"
       value="">


@push('javascript')

    <script>
        $('document').ready(function ()  {
            var tmpAlt = '{{$rowFieldJalali}}' ;
            $('#'+tmpAlt).persianDatepicker({
                altFormat: 'X',
                observer: true,
                initialValue: true,
                initialValueType: 'gregorian' ,
                format: 'YYYY/MM/DD',
                altField: '#'+tmpAlt + '_alt',
                timePicker: {
                    enabled: false,
                    meridiem: {
                        enabled: false
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

                if (month.length < 2)
                    month = '0' + month;
                if (day.length < 2)
                    day = '0' + day;
                var date = new Date();
                date.toLocaleDateString();

                return [year, month, day].join('-')+' 00:00:00';
            };

        });

    </script>
@endpush
