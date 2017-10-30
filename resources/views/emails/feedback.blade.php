<b>Имя:</b> {{ $name }} <br/>
<b>E-mail:</b> {{ $email }} <br/>
<b>Сообщение:</b> {{ $text }} <br/>
<b>IP-адрес:</b> {{ $ip_address }} <br/>
<b>Дата:</b> {{ \Carbon\Carbon::now()->format('d.m.Y H:m:s') }} <br/>