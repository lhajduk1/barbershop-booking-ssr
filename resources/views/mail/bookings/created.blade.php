<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Created</title>
</head>
<body style="margin:0; padding:0; width:100%; background-color:#080807; color:#f5f5f4; -webkit-text-size-adjust:100%;">
    <div style="display:none; max-height:0; overflow:hidden; mso-hide:all;">We have received your booking. Your appointment details are inside.</div>
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#080807" style="width:100%; background-color:#080807; font-family:Arial, Helvetica, sans-serif;">
        <tr>
            <td align="center" style="padding:32px 12px;">
                <!--[if mso]><table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0"><tr><td><![endif]-->
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%; max-width:600px; table-layout:fixed; border:1px solid #3c3420; background-color:#0f0e0c;">
                    <tr>
                        <td style="padding:25px 24px; border-top:3px solid #d4af37; border-bottom:1px solid #3c3420; color:#e8ca72; font-size:12px; font-weight:bold; letter-spacing:3px; line-height:22px; text-transform:uppercase; overflow-wrap:anywhere; word-wrap:break-word;">{{ config('app.name', 'Barbershop') }}</td>
                    </tr>
                    <tr>
                        <td style="padding:36px 24px 28px;">
                            <p style="margin:0 0 18px; color:#d4af37; font-size:10px; font-weight:bold; line-height:18px; letter-spacing:2px; text-transform:uppercase;">A moment for yourself</p>
                            <h1 style="margin:0; color:#f5f5f4; font-family:Georgia, 'Times New Roman', serif; font-size:36px; font-weight:normal; line-height:42px;">Your booking<br>has been <em style="color:#e8ca72; font-weight:normal;">received.</em></h1>
                            <p style="margin:26px 0 10px; color:#e7e5e4; font-size:15px; line-height:25px; overflow-wrap:anywhere; word-wrap:break-word;">Hello {{ $booking->customer_first_name }},</p>
                            <p style="margin:0; color:#a8a29e; font-size:14px; line-height:24px;">Thank you for choosing {{ config('app.name', 'Barbershop') }}. We have received your reservation request. Here is a summary of your appointment.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 24px 28px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#211e17" style="width:100%; table-layout:fixed; background-color:#211e17; border:1px solid #4a4028;">
                                <tr>
                                    <td style="padding:24px 20px 0; color:#e8ca72; font-size:10px; font-weight:bold; line-height:18px; letter-spacing:2px; text-transform:uppercase;">Appointment #{{ $booking->id }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 20px 24px;">
                                        <h2 style="margin:0; color:#f5f5f4; font-family:Georgia, 'Times New Roman', serif; font-size:27px; font-weight:normal; line-height:35px; overflow-wrap:anywhere; word-wrap:break-word;">{{ $booking->service?->name ?? 'Your service' }}</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0 20px 24px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" aria-label="Appointment details" style="width:100%; table-layout:fixed; font-size:13px; line-height:22px;">
                                            <tr>
                                                <th scope="row" width="32%" align="left" valign="top" style="padding:13px 8px 13px 0; border-top:1px solid #443d2e; color:#a8a29e; font-weight:normal;">Date</th>
                                                <td align="right" style="padding:13px 0; border-top:1px solid #443d2e; color:#e7e5e4;">{{ $booking->starts_at->copy()->setTimezone(config('app.timezone'))->format('d M Y') }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" align="left" valign="top" style="padding:13px 8px 13px 0; border-top:1px solid #443d2e; color:#a8a29e; font-weight:normal;">Time</th>
                                                <td align="right" style="padding:13px 0; border-top:1px solid #443d2e; color:#e7e5e4;">{{ $booking->starts_at->copy()->setTimezone(config('app.timezone'))->format('H:i') }} &ndash; {{ $booking->ends_at->copy()->setTimezone(config('app.timezone'))->format('H:i') }}<br><span style="color:#a8a29e; font-size:11px; overflow-wrap:anywhere;">{{ config('app.timezone') }}</span></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" align="left" valign="top" style="padding:13px 8px 13px 0; border-top:1px solid #443d2e; color:#a8a29e; font-weight:normal;">Duration</th>
                                                <td align="right" style="padding:13px 0; border-top:1px solid #443d2e; color:#e7e5e4;">{{ $booking->duration_minutes }} min</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" align="left" valign="top" style="padding:13px 8px 13px 0; border-top:1px solid #443d2e; color:#a8a29e; font-weight:normal;">Barber</th>
                                                <td align="right" style="padding:13px 0; border-top:1px solid #443d2e; color:#e7e5e4; overflow-wrap:anywhere; word-wrap:break-word;">{{ $booking->employee ? trim($booking->employee->first_name.' '.$booking->employee->last_name) : 'To be assigned' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" align="left" valign="middle" style="padding:20px 8px 0 0; border-top:1px solid #66522c; color:#e7e5e4; font-weight:normal;">Service price</th>
                                                <td align="right" style="padding:20px 0 0; border-top:1px solid #66522c; color:#e8ca72; font-family:Georgia, 'Times New Roman', serif; font-size:30px; line-height:36px; overflow-wrap:anywhere;">${{ number_format($booking->price_cents / 100, 2, ',', ' ') }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @if (filled($booking->notes))
                        <tr>
                            <td style="padding:0 24px 28px;">
                                <h2 style="margin:0 0 10px; color:#e8ca72; font-size:11px; font-weight:bold; line-height:20px; letter-spacing:2px; text-transform:uppercase;">Your notes</h2>
                                <p style="margin:0; color:#a8a29e; font-size:14px; line-height:24px; white-space:pre-line; overflow-wrap:anywhere; word-wrap:break-word;">{{ $booking->notes }}</p>
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td align="center" style="padding:25px 24px; border-top:1px solid #3c3420;">
                            <p style="margin:0; color:#e8ca72; font-family:Georgia, 'Times New Roman', serif; font-size:20px; font-style:italic; line-height:28px;">A little time. A lasting impression.</p>
                            <p style="margin:12px 0 0; color:#a8a29e; font-size:11px; line-height:19px;">Please keep this email for your appointment details.</p>
                        </td>
                    </tr>
                </table>
                <!--[if mso]></td></tr></table><![endif]-->
            </td>
        </tr>
    </table>
</body>
</html>
