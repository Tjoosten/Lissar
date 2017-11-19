@component('mail::message')
# Er is een API sleutel verwijderd

Geachte, 

Via deze weg laten wij witten dat de onderstaande API sleutel is verwijderd uit het systeem. 

|                      |                            |
| -------------------- | -------------------------- |
| **Uitgevoerd door:** | {{ $user->name }}          |
| **Service:**         | {{ $dbKey->service }}      |
| **Sleutel:**         | `{{ $dbKey->key }}`        |
<br>

Met vriendelijke groet,<br>
{{ config('app.name') }}
@endcomponent
