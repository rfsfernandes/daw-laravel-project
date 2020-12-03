@extends('layouts.main_layout', ['title' => 'Login'])

@section('content')
    <div class="d-flex justify-content-center">
        <div class="container login-form">
            <div class="row">
                <div class="form-container">
                    <img class="col-12" src="{{URL::asset('/img/Logo-IPBejaI.png')}}" alt="ipbeja logo">

                    <form method="POST" action="">
                        <label class="col-12 login-label" for="email">Email na instituição:</label>
                        <input class="col-12 login-input" type="email" id="email" name="email" value="" required>

                        <label class="col-12 login-label" for="password" style="margin-top: 35px">Password:</label>
                        <input class="col-12 login-input" type="password" id="password" name="password" value=""
                               required>
                        <div class="col-12">
                            <input class="login-input-remember" type="checkbox" id="remember-me" name="remember-me"
                                   value="false">
                            <label class="login-label-remember" for="remember-me">Relembrar email</label>
                        </div>
                        <div class="col-12 button-wrapper-center">
                            <button class="login-btn" type="submit" value="submit">ENTRAR</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
