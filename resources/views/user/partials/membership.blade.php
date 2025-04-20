<div>
    <h5 class="mb-3">ثبت واریز حق عضویت</h5>

    <form action="{{ route('membership.payment') }}" method="POST" class="mb-4">
        @csrf
        <div class="row g-3 mb-3" style="max-width: 600px;">
            <div class="col-md-6">
                <input type="number" name="amount" class="form-control" placeholder="مبلغ پرداختی (تومان)" required min="10000">
            </div>
            <div class="col-md-6">
                <input type="text" name="reference_id" class="form-control" placeholder="کد رهگیری واریز" required>
            </div>
        </div>
        <button class="btn btn-success px-4" type="submit">ثبت واریز</button>
    </form>

    <h6>سوابق پرداخت:</h6>
    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th>تاریخ</th>
                <th>مبلغ</th>
                <th>کد رهگیری</th>
                <th>وضعیت</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user->membershipPayments as $payment)
                <tr>
                    <td>{{ \Morilog\Jalali\Jalalian::fromDateTime($payment->created_at)->format('Y/m/d') }}</td>
                    <td>{{ number_format($payment->amount) }}</td>
                    <td>{{ $payment->reference_id }}</td>
                    <td>{{ $payment->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
