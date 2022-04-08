<li><span style="font-weight: {{ $child_account->type == 'header' ? '700' : 'normal' }}">{{ $child_account->name }}</span></li>
@if ($child_account->accounts)
    <ul>
        @foreach ($child_account->accounts as $childAccount)
            @include('accounting.coa.child_account', ['child_account' => $childAccount])
        @endforeach
    </ul>
@endif
