@extends('layouts.main_layout', ['title' => 'Marcar Avaliações'])

@section('content')
    @include('layouts.topbar', ['topbar_title' => 'Docente - ' . 'Foo Bar'])
    <div class="container-wrapper">
        <div class="bottom-top-wrapper">
            <h4 class="page-title">Marcar Avaliação</h4>
            <div>
                <form>

                    <div class="row" style="height: 36px">
                        <div class="col-md-4" style="width: 100%;">
                            <select class="col-12" id="uc" name="uc">
                                <option disabled selected value="default">Unidade Curricular</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="col-12" id="type" name="type">
                                <option disabled selected value="default">Tipo de avaliação</option>
                                <option value="exam">Exame</option>
                                <option value="freq">Frequência</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="col-12" id="uc" name="uc">
                                <option disabled selected value="default">Época</option>
                                <option value="normal">Normal</option>
                                <option value="rec">Recurso</option>
                                <option value="special">Especial</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="height: 36px; margin-top: 25px;  margin-bottom: 25px">
                        <div class="col-md-2">
                            <input class="col-12" style="margin: 0" type="text" id="room" name="room"
                                   placeholder="Sala"/>
                        </div>
                        <div class="col-md-2">
                            <input class="col-12" type="time"/>
                        </div>
                        <div class="col-md-4">
                            <input class="col-12" type="date"/>
                        </div>
                        <div class="col-md-4">
                            <button class="col-12 btn-schedule" type="submit" name="submit" id="submit" value="submit">
                                MARCAR
                            </button>
                        </div>
                    </div>


                </form>
            </div>

            <h4 class="page-title page-title-teachers">Avaliações Marcadas</h4>
            <div class="teachers-table-wrapper">
                <table class="teachers-table">
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
