@extends('layouts.main_layout', ['title' => 'Avaliações'])
@section('content')

    <div id="dark-overlay" class="dark-overlay">
        <div class="dialog">
            <div class="dialog-text">
                <h4 class="font-weight">Deseja inscrever-se na seguinte avaliação?</h4>
                <div>
                    <p><span class="font-weight">Unidade curricular: </span><span id="uc">Coisas</span></p>
                    <p><span class="font-weight">Tipo de avaliação: </span><span id="type">Coisas</span></p>
                    <p><span class="font-weight">Época: </span><span id="epoch">Coisas</span></p>
                </div>
            </div>

            <div class="dialog-btn-container">
                <button onclick="cancel()" class="dialog-btn cancel">CANCELAR</button>
                <form method="POST" action="/students" style="flex: 1; width: 100%">
                    @csrf
                    <button type="submit" class="dialog-btn confirm">INSCREVER</button>
                    <input hidden id="hidden_user" name="user_id">
                    <input hidden id="hidden_assessment" name="assessment_id">
                </form>
            </div>

        </div>
    </div>

    <script>
        let overlay = document.getElementById('dark-overlay');
        let view_uc = document.getElementById('uc');
        let view_type = document.getElementById('type');
        let view_epoch = document.getElementById('epoch');

        let input_user = document.getElementById('hidden_user');
        let input_assessment = document.getElementById('hidden_assessment');

        function showModal(user_id, assessment_id, uc, type, epoch) {
            view_uc.innerHTML = uc;
            view_type.innerHTML = type;
            view_epoch.innerHTML = epoch;
            input_user.value = user_id;
            input_assessment.value = assessment_id;
            overlay.className = "show";
            overlay.style.display = "flex";
        }

        function cancel(){
            overlay.style.display = "none";
        }

    </script>

    @include('layouts.topbar', ['topbar_title' => 'Estudante - ' . $info_user->name ])
    <div class="container-wrapper">
        <div class="bottom-top-wrapper">
            <h4 class="page-title">Avaliações</h4>
            <div class="info">
                <p><span class="font-weight">Nome do aluno: </span>{{ $info_user->name }}</p>
                <p><span class="font-weight">Número do aluno: </span>{{ $info_user->number }}</p>
                <p><span class="font-weight">Curso: </span>{{ $info_user->course }}</p>
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
                    @foreach($info_table as $assessment)
                        <tr class="tr-top tr-content">
                            <td class="td-first">
                                {{$assessment->uc}}
                            </td>
                            <td class="td-center">
                                {{$assessment->assess_type}}
                            </td>
                            <td class="td-center">
                                {{$assessment->epoch}}
                            </td>
                            <td class="td-center">
                                {{$assessment->classroom}}
                            </td>
                            <td class="td-center">
                                {{$assessment->datetime}}
                            </td>
                            <td class="td-center important">
                                @if($assessment->grade && $assessment->enrollment)
                                    <span class="state-clickable">{{ $assessment->grade }}</span>
                                @elseif(!$assessment->grade && $assessment->enrollment)
                                    <span class="state-inprogress">INSCRITO</span>
                                @else

                                    <button onclick="showModal('{{ $assessment->id }}', '{{ $info_user->number }}',
                                        '{{$assessment->uc}}', '{{$assessment->assess_type}}', '{{$assessment->epoch}}', )"
                                            class="state-complete" style="text-decoration: none">
                                        INSCREVER
                                    </button>

                                @endif

                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection
