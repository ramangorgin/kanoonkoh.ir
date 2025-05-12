<h5 class="mb-3">ثبت پرداخت جدید</h5>

<form method="POST" action="{{ route('user.payments.store') }}">
    @csrf

    <div class="row mb-3">
        <div class="col-md-4">
            <label>نوع پرداخت</label>
            <select class="form-select" id="type" name="type" required>
                <option value="">انتخاب کنید</option>
                <option value="membership">حق عضویت سال جاری</option>
                <option value="program">هزینه ثبت‌نام در برنامه</option>
                <option value="course">هزینه ثبت‌نام در دوره</option>
            </select>
        </div>

        <div class="col-md-4" id="year-field" style="display:none;">
            <label>سال</label>
            <select class="form-select" name="related_id">
                @foreach(range(jalali()->getYear(), jalali()->getYear() - 5) as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4" id="program-field" style="display:none;">
            <label>انتخاب برنامه</label>
            <select class="form-select" name="related_id">
                @foreach($programs as $program)
                    <option value="program-{{ $program->id }}">{{ $program->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4" id="course-field" style="display:none;">
            <label>انتخاب دوره</label>
            <select class="form-select" name="related_id">
                @foreach($courses as $course)
                    <option value="course-{{ $course->id }}">{{ $course->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 mt-3">
            <label>مبلغ (تومان)</label>
            <input type="number" name="amount" class="form-control" required>
        </div>

        <div class="col-md-4 mt-3">
            <label>کد رهگیری پرداخت</label>
            <input type="text" name="transaction_code" class="form-control" required>
        </div>
    </div>

    <button type="submit" class="btn btn-outline-success">ثبت پرداخت</button>
</form>

<hr class="my-4">

<h5 class="mb-3">سوابق پرداختی</h5>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>نوع</th>
            <th>مورد پرداخت</th>
            <th>مبلغ</th>
            <th>کد رهگیری</th>
            <th>تاریخ ثبت</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payments as $payment)
        <tr>
            <td>
                @if($payment->type == 'membership') حق عضویت @elseif($payment->type == 'program') برنامه @else دوره @endif
            </td>
            <td>{{ $payment->related_id }}</td>
            <td>{{ number_format($payment->amount) }}</td>
            <td>{{ $payment->transaction_code }}</td>
            <td>{{ \Morilog\Jalali\Jalalian::fromDateTime($payment->created_at)->format('Y/m/d') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@push('scripts')
<script>
    $('#type').on('change', function() {
        $('#year-field, #program-field, #course-field').hide();

        if (this.value === 'membership') {
            $('#year-field').show();
        } else if (this.value === 'program') {
            $('#program-field').show();
        } else if (this.value === 'course') {
            $('#course-field').show();
        }
    });
</script>
@endpush
