@extends('layouts.main_layout', ['title' => 'Avaliações'])
@section('content')

    <div id="dark-overlay" class="dark-overlay">
        <div class="dialog">
            <div class="dialog-text">
                <h4 class="font-weight">Deseja inscrever-se na seguinte avaliação?</h4>
                <div>
                    <p><span class="font-weight">Unidade curricular: </span>Coisas</p>
                    <p><span class="font-weight">Tipo de avaliação: </span>Coisas</p>
                    <p><span class="font-weight">Época: </span>Coisas</p>
                </div>
            </div>

            <div class="dialog-btn-container">
                <button class="dialog-btn cancel">CANCELAR</button>
                <button class="dialog-btn confirm">INSCREVER</button>
            </div>

        </div>
    </div>
    @include('layouts.topbar', ['topbar_title' => 'Estudante - ' . session('_user_content')->name])
    <div class="container-wrapper">
        <div class="bottom-top-wrapper">
            <h4 class="page-title">Avaliações</h4>
            <div class="info">
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
