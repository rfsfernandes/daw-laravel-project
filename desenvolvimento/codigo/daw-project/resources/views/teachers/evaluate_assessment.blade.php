@extends('layouts.main_layout', ['title' => 'Marcar Avaliações'])

@section('content')
    @include('layouts.topbar', ['topbar_title' => 'Docente - ' . 'Foo Bar'])
    <div class="container-wrapper">
        <div class="bottom-top-wrapper">
            <h4 class="page-title">Lançar Avaliações</h4>
            <div class="info-teachers">
                <p><span class="font-weight">Nome do aluno: </span>Coisas</p>
                <p><span class="font-weight">Número do aluno: </span>Coisas</p>
                <p><span class="font-weight">Curso: </span>Coisas</p>
            </div>
            <div class="students-table-wrapper">
                <table class="students-table">
                    <tr class="tr-top">
                        <th class="th-center">
                            Unidade Curricular
                        </th>
                        <th class="th-center">
                            Tipo de Avaliação
                        </th>
                        <th class="th-center">
                            Época
                        </th>
                        <th class="th-center">
                            Sala
                        </th>
                        <th class="th-center">
                            Data
                        </th>
                        <th class="th-center">
                            Estado
                        </th>
                    </tr>
                    <?php

                    ?>
                    <tr class="tr-top">
                        <td class="td-first">
                            Sistemas Operativos
                        </td>
                        <td class="td-center">
                            Frequência
                        </td>
                        <td class="td-center">
                            Normal
                        </td>
                        <td class="td-center">
                            S8
                        </td>
                        <td class="td-center">
                            17/12/2020
                        </td>
                        <td class="td-center important">
                            17
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

@endsection
