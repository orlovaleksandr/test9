@extends('layouts.master')
{{-- Content --}}
@section('content')
    Lead list
<table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline">
    <thead>
        <tr>
            <th>icon</th>
            <th>date</th>
            <th>name</th>
            <th>phone</th>
            <th>email</th>
        </tr>
    </thead>
    <tbody class="parent-table">
    @foreach($leads as $lead)
        <tr data-id="{{$lead['id']}}" onclick="getRow({{$lead['sphere_id']}}, {{$lead['id']}});">
            <td></td>
            <td>{{$lead['date']}}</td>
            <td>{{$lead['name']}}</td>
            <td>{{$lead['phone']['phone']}}</td>
            <td>{{$lead['email']}}</td>
        </tr>
        <tbody class="hidden sub-table" data-subid="{{$lead['id']}}">
            <tr>
                <th>icon</th>
                <td></td>
            </tr>
            <tr>
                <th>date</th>
                <td>{{$lead['date']}}</td>
            </tr>
            <tr>
                <th>name</th>
                <td>{{$lead['name']}}</td>
            </tr>
            <tr>
                <th>phone</th>
                <td>{{$lead['phone']['phone']}}</td>
            </tr>
            <tr>
                <th>email</th>
                <td>{{$lead['email']}}</td>
            </tr>
                @foreach ($lead['sphere_info'] as $sphere)
                    <tr data-label="{{$sphere['_type']}}">
                        <th>{{$sphere['label']}}</th>
                        <td></td>
                    </tr>
                @endforeach

        </tbody>
    @endforeach
    </tbody>
</table>
@stop


<script>
    function getRow(id, lead_id) {
        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: 'lead/row-data/' + id + '/' + lead_id ,
            success: function (data) {

                var parentTable = $('.parent-table tr[data-id='+ lead_id +']') ;

                $subTable = $('tbody[data-subid='+ lead_id +']');
                $subTable.toggleClass('hidden');

                console.log($subTable.children('[data-label="radio"]').children('td'));

                $.each(data, function (key, val) {
                    var your_html = "";
                    your_html += val + ' ';
                    $subTable.children('tr[data-label='+ key +']').children('td').html(your_html);

                 });

            },
            error: function() {

            }
        });
    }
</script>
