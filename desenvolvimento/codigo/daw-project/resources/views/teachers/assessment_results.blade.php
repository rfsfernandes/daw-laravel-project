@extends('layouts.main_layout', ['title' => 'Resultado da Avaliação'])

@section('content')
    @include('layouts.topbar', ['topbar_title' => 'Docente - ' . 'Foo Bar'])
    <div class="container-wrapper">
        <div class="bottom-top-wrapper">
            @include('layouts.arrow_and_info', ['title' => 'Resultado da Avaliação'])
            <form>
                <div class="students-table-wrapper">
                    <table class="students-table">
                        <colgroup>
                            <col span="1" style="width: 60%;">
                            <col span="1" style="width: 20%;">
                            <col span="1" style="width: 20%;">
                        </colgroup>

                        <tr class="tr-top">
                            <th class="th-center">
                                Nome do aluno
                            </th>
                            <th class="th-center">
                                Número de aluno
                            </th>
                            <th class="th-center">
                                Nota
                            </th>
                        </tr>
                        @foreach($final as $var)
                            <tr class="tr-top">
                                <td class="td-first">
                                    {{$var->name}}
                                </td>
                                <td class="td-center">
                                    {{$var->id}}
                                </td>
                                <td class="td-center">
                                    {{$var->value}}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </form>
        </div>
    </div>

@endsection
