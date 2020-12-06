@extends('layouts.main_layout', ['title' => 'Marcar Avaliações'])

@section('content')
    <script>
        var form = document.getElementById('schedule-form');

        function processForm(){
            let uc = document.getElementById('uc').value;
            let type = document.getElementById('type').value;
            let epoch = document.getElementById('epoch').value;

            if( uc === "default" || type === "default" || epoch === "default") {
                document.getElementById('dark-overlay').style.display = "flex";
                return false;
            } else {
                return true;
            }

        }

    </script>
    @include('layouts.modal')
    @include('layouts.topbar', ['topbar_title' => 'Docente - ' .  session('_user_content')->name])
    <div class="container-wrapper">
        <div class="bottom-top-wrapper">
            <h4 class="page-title">Marcar Avaliação</h4>
            <div>
                <form action="/teachers/schedule" method="POST" onsubmit="return processForm();" id="schedule-form">
                    @csrf
                    <div class="row" style="height: 36px">
                        <div class="col-md-4" style="width: 100%;">
                            <select class="col-12 input-backgound" id="uc" required name="uc">
                                <option disabled selected value="default">Unidade Curricular</option>
                                @foreach($ucsnames as $ucname)
                                    <option value="{{ $ucname->id }}">{{ $ucname->name_uc }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="col-12 input-backgound" id="type" required name="type">
                                <option disabled selected value="default">Tipo de avaliação</option>
                                @foreach($assesstype as $type)
                                    <option value="{{ $type->id }}">{{ $type->name_assessment_type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="col-12 input-backgound" required id="epoch" name="epoch">
                                <option disabled selected value="default">Época</option>
                                <@foreach($epochs as $epoch)
                                    <option value="{{ $epoch->id }}">{{ $epoch->name_epoch }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row" style="height: 36px; margin-top: 25px;  margin-bottom: 25px">
                        <div class="col-md-2">
                            <input class="col-12 input-backgound" style="margin: 0" type="text" id="room" name="room"
                                   placeholder="Sala" required/>
                        </div>
                        <div class="col-md-2">
                            <input class="col-12 input-backgound" type="time" name="time" required/>
                        </div>
                        <div class="col-md-4">
                            <input class="col-12 input-backgound" type="date" name="date" required/>
                        </div>
                        <div class="col-md-4">
                            <button class="col-12 btn-schedule" type="submit" id="submit" value="submit">
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

                    @foreach($assessments as $assessment)
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
                                @if($assessment->hasBeenDone && $assessment->gradesLaunched)
                                    <form method="GET" action="/teachers/assessments/results/{{ $assessment->id }}">
                                        @csrf
                                        <button type="submit"
                                                class="state-complete" style="text-decoration: none">
                                            NOTAS LANÇADAS
                                        </button>
                                    </form>
                                @elseif(!$assessment->hasBeenDone)
                                    <span class="state-inprogress">POR REALIZAR</span>
                                @else
                                    <form method="GET" action="/teachers/assessments/evaluate/{{ $assessment->id }}">
                                        @csrf
                                        <button type="submit"
                                            class="state-clickable" style="text-decoration: none">
                                            LANÇAR
                                        </button>
                                    </form>

                                @endif
{{--                               TODO: this row--}}

                            </td>
                        </tr>
                    @endforeach

{{--                    @foreach($assessments as $assessment)--}}
{{--                        --}}
{{--                    @endforeach--}}
{{--                    <tr class="tr-top">--}}
{{--                        <td class="td-first">--}}
{{--                            Sistemas Operativos--}}
{{--                        </td>--}}
{{--                        <td class="td-center">--}}
{{--                            Frequência--}}
{{--                        </td>--}}
{{--                        <td class="td-center">--}}
{{--                            Normal--}}
{{--                        </td>--}}
{{--                        <td class="td-center">--}}
{{--                            S8--}}
{{--                        </td>--}}
{{--                        <td class="td-center">--}}
{{--                            17/12/2020--}}
{{--                        </td>--}}
{{--                        <td class="td-center important">--}}
{{--                            17--}}
{{--                        </td>--}}
{{--                    </tr>--}}
                </table>
            </div>
        </div>
    </div>

@endsection
