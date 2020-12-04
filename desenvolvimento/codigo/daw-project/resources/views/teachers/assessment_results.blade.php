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
                        <?php

                        ?>
                        <tr class="tr-top">
                            <td class="td-first">
                                Foo Bar Albuquerque
                            </td>
                            <td class="td-center">
                                123456
                            </td>
                            <td class="td-center">
                                10
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>

@endsection
