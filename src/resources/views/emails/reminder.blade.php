<p>{{ $reservation->user->name }}様</p>
<p>この度はご予約ありがとうございます。以下のご予約を承っておりますので、内容をご確認下さい。</p>
<p>店舗： {{ $reservation->shop->shop_name }}</p>
<p>日時： {{ $reservation->date }}  {{ $reservation->time }}</p>
<p>人数： {{ $reservation->number }}</p>