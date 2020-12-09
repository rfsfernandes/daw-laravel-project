<div class="topbar">
    <div class="container-wrapper">
        <table style="width: 100%; height: 100%">
            <tr>
                <td>
                    <h5>{{ $topbar_title }}</h5>
                </td>
                <td style="text-align: right">
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="btn"><strong>LOGOUT</strong><i class="fa fa-sign-out"
                                                                                    aria-hidden="true"></i></button>
                    </form>
                </td>
            </tr>
        </table>

    </div>
</div>
