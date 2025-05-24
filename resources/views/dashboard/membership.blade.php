{{-- ثبت تراکنش جدید --}}
<h5 class="mb-3">ثبت پرداخت جدید</h5>

<form method="POST" action="{{ route('dashboard.membership.submit') }}" enctype="multipart/form-data">
    @csrf

    <div class="row">
        {{-- نوع پرداخت --}}
        <div class="mb-3 col-md-6">
            <label class="form-label">مورد پرداخت</label>
            <select name="payment_type" id="payment_type" class="form-select" required>
                <option value="">انتخاب کنید...</option>
                <option value="membership">حق عضویت سالانه</option>
                <option value="program">برنامه</option>
                <option value="course">دوره</option>
            </select>
        </div>

        {{-- انتخاب آیتم وابسته (برنامه/دوره/سال) --}}
        <div class="mb-3 col-md-6 d-none" id="related_item_wrapper">
            <label class="form-label" id="related_item_label">انتخاب مورد</label>
            <select name="related_item_id" id="related_item" class="form-select" required>
                <option value="">لطفاً ابتدا نوع پرداخت را انتخاب کنید</option>
            </select>
        </div>

        {{-- مبلغ --}}
        <div class="mb-3 col-md-6">
            <label class="form-label">مبلغ (تومان)</label>
            <input type="number" name="amount" class="form-control" required>
        </div>

        {{-- کد پیگیری --}}
        <div class="mb-3 col-md-6">
            <label class="form-label">کد پیگیری</label>
            <input type="text" name="tracking_code" class="form-control" required>
        </div>

        {{-- تاریخ پرداخت --}}
        <div class="mb-3 col-md-6">
            <label class="form-label">تاریخ پرداخت</label>
            <input type="date" name="paid_at" class="form-control" required>
        </div>

        {{-- فایل رسید --}}
        <div class="mb-3 col-md-6">
            <label class="form-label">بارگذاری فایل رسید (اختیاری)</label>
            <input type="file" name="receipt_file" class="form-control" accept=".pdf,image/*">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">ارسال تراکنش</button>
</form>

<hr class="my-5">

{{-- 🔵 وضعیت پرداخت جاری (اگر هست) --}}
<h5 class="mb-3">آخرین وضعیت پرداخت</h5>
@if(isset($latestTransaction))
    <div class="alert alert-info">
        <strong>وضعیت:</strong> {{ $latestTransaction->status }} <br>
        <strong>مبلغ:</strong> {{ number_format($latestTransaction->amount) }} تومان
    </div>
@endif


<hr class="my-5">

{{-- 🟡 تاریخچه تراکنش‌ها --}}
<h5 class="mb-3">تاریخچه پرداخت‌ها</h5>
@if(count($transactions))
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>تاریخ</th>
                    <th>مبلغ</th>
                    <th>نوع پرداخت</th>
                    <th>مورد</th>
                    <th>کد پیگیری</th>
                    <th>وضعیت</th>
                    <th>رسید</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $trx)
                    <tr>
                        <td>{{ jdate($trx->paid_at)->format('Y/m/d') }}</td>
                        <td>{{ number_format($trx->amount) }}</td>
                        <td>{{ $trx->type_label }}</td>
                        <td>{{ $trx->item_title ?? '-' }}</td>
                        <td>{{ $trx->tracking_code }}</td>
                        <td>{{ $trx->status }}</td>
                        <td>
                            @if($trx->receipt_file)
                                <a href="{{ asset('storage/' . $trx->receipt_file) }}" target="_blank">مشاهده</a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>هیچ پرداختی تاکنون ثبت نشده است.</p>
@endif

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const typeSelect = document.getElementById('payment_type');
        const wrapper = document.getElementById('related_item_wrapper');
        const label = document.getElementById('related_item_label');
        const dropdown = document.getElementById('related_item');

        // فرضی: این لیست‌ها از کنترلر Blade به صورت JSON منتقل می‌شن
        const recentPrograms = @json($recentPrograms);
        const recentCourses = @json($recentCourses);
        const membershipYears = @json($membershipYears);

        typeSelect.addEventListener('change', () => {
            const type = typeSelect.value;
            dropdown.innerHTML = '';
            wrapper.classList.remove('d-none');

            if (type === 'membership') {
                label.textContent = 'سال عضویت';
                membershipYears.forEach(year => {
                    dropdown.innerHTML += `<option value="${year}">${year}</option>`;
                });
            } else if (type === 'program') {
                label.textContent = 'برنامه مورد نظر';
                recentPrograms.forEach(item => {
                    dropdown.innerHTML += `<option value="${item.id}">${item.title}</option>`;
                });
            } else if (type === 'course') {
                label.textContent = 'دوره مورد نظر';
                recentCourses.forEach(item => {
                    dropdown.innerHTML += `<option value="${item.id}">${item.title}</option>`;
                });
            } else {
                wrapper.classList.add('d-none');
            }
        });
    });
</script>
@endpush
