@extends('layouts.main_layout', ['title' => 'Resultado da Avaliação'])

@section('content')

    <div id="dark-overlay" class="dark-overlay">
        <div class="dialog">
            <form method="POST" action="/teachers/assessments/results/{{ $assessment_id }}"
                  style="flex: 1; width: 100%">
                @csrf
                <div class="dialog-text">
                    <h4 class="font-weight">Deseja inscrever-se na seguinte avaliação?</h4>
                    <div style="display: flex">
                        <p class="font-weight" style="flex: 1;height: 30px; margin: auto">Nota que pretende
                            atribuir:</p>
                        <input style="flex: 1; width: 50%" class="grade-input"
                               type="number" max="20"
                               min="0" id="grade"
                               name="grade"
                               placeholder="0-20"
                               required>
                    </div>
                </div>
                <input hidden id="enrollment_id" name="enrollment_id">
                <div class="dialog-btn-container">
                    <button type="button" onclick="cancel()" class="dialog-btn cancel">CANCELAR</button>
                    <button type="submit" class="dialog-btn confirm" style="flex: 1">EDITAR</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        let overlay = document.getElementById('dark-overlay');
        let enrollment_id_input = document.getElementById('enrollment_id');
        let grade_input = document.getElementById('grade');

        function showModalEdit(inscription_id, grade) {
            grade_input.value = grade;
            enrollment_id_input.value = inscription_id;
            overlay.className = "show";
            overlay.style.display = "flex";
        }

        function cancel() {
            overlay.style.display = "none";
        }

    </script>

    @include('layouts.topbar', ['topbar_title' => 'Docente - ' . 'Foo Bar'])

    <div class="container-wrapper">
        <div class="bottom-top-wrapper">
            @include('layouts.arrow_and_info', ['title' => 'Resultado da Avaliação'])
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
                        <th class="th-center">

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
                            <td>
                                <button onclick="showModalEdit('{{ $var->id_inscription }}', '{{ $var->value }}' )"
                                        class="edit-btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection
