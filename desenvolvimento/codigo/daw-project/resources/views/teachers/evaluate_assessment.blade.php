@extends('layouts.main_layout', ['title' => 'Lançar Avaliações'])

@section('content')
    @include('layouts.topbar', ['topbar_title' => 'Docente - ' . 'Foo Bar'])
    <div class="container-wrapper">
        <div class="bottom-top-wrapper">
            @include('layouts.arrow_and_info', ['title' => 'Lançar Avaliações'])
            <form method="POST" action="/teachers/assessments/evaluate/{{ $assessment_id }}">
                @csrf
                <div style="margin-top: 5%">
                    <button class="btn-grade" type="submit">LANÇAR</button>
                </div>
                <div class="students-table-wrapper assessments-top">
                    <table class="students-table assessments-top">
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
                        @foreach($data as $inscription)
                            <tr class="tr-top">
                                <td class="td-first">
                                    {{ $inscription->name }}
                                </td>
                                <td class="td-center">
                                    <input hidden name="user_id[]" value="{{ $inscription->id }}">
                                    <input hidden name="enrollment_id[]" value="{{ $inscription->id_inscription }}">
                                    {{ $inscription->id }}
                                </td>
                                <td class="td-center">
                                    <input class="grade-input" type="number" max="20" min="0" id="grade" name="grade[]"
                                           placeholder="0-20" required>
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </form>
        </div>
    </div>

@endsection
