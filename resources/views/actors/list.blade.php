@extends('layout.master')
@section('header')
    @parent
@endsection

@section('content')
    <h1>Actors List</h1>
    @if (empty($actors))
        <FONT COLOR="red">No se ha encontrado ningún actor</FONT>
    @else
        <div align="center">
            <table border="1">
                <tr>
                    @foreach ($actors as $actor)
                        @foreach (array_keys($actor) as $key)
                            <th>{{ $key }}</th>
                        @endforeach
                    @break
                @endforeach
            </tr>

            @foreach ($actors as $actor)
                <tr>
                    <td>{{ $actor['id'] }}</td>
                    <td>{{ $actor['name'] }}</td>
                    <td>{{ $actor['surname'] }}</td>
                    <td>{{ $actor['birthdate'] }}</td>
                    <td>{{ $actor['country'] }}</td>
                    <td><img src={{ $actor['img_url'] }} style="width: 100px; heigth: 120px;" /></td>
                </tr>
            @endforeach
        </table>
    </div>
@endif
@endsection

@section('footer')
@parent
@endsection
