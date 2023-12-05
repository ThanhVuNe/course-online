@extends('email.layouts.main')

@section('content')
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
        <tr>
            <td>&nbsp;</td>
            <td class="container">
                <div class="content">
                    <table role="presentation" class="main">
                        <tr>
                            <td class="wrapper">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td>
                                            <p>Hi, {{ $username }}</p>
                                            <p>Did you request to become an instructor? If so, please confirm by clicking
                                                the button below:</p>
                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0"
                                                class="btn btn-primary">
                                                <tbody>
                                                    <tr>
                                                        <td align="left">
                                                            <table role="presentation" border="0" cellpadding="0"
                                                                cellspacing="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td> <a href="{{ $confirmationUrl }}">
                                                                                Confirm
                                                                            </a> </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p>If you have any questions or concerns, please feel free to contact us.</p>
                                            <p>Good luck! Hope it works.</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <div class="footer">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="content-block">
                                    <span class="apple-link">Company Inc, 3 Abbey Road, San Francisco CA 94102</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="content-block powered-by">
                                    Powered by <a href="http://htmlemail.io">HTMLemail</a>.
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </td>
            <td>&nbsp;</td>
        </tr>
    </table>
@endsection
