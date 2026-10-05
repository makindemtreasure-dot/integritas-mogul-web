@extends('layouts.app')

@section('title', 'Investors | INTEGRITAS MOGUL')

@section('content')
    <section class="bg-forest text-white">
        <div class="mx-auto max-w-7xl px-5 py-14 sm:px-8 sm:py-20">
            <p class="text-xs font-bold uppercase text-leaf">Ownership &amp; capital</p>
            <h1 class="font-display mt-3 max-w-3xl text-4xl leading-tight sm:text-5xl">Confidence starts with clarity.</h1>
            <p class="mt-5 max-w-2xl leading-7 text-white/75">Public shareholder allocations and investment totals for INTEGRITAS MOGUL COMPANY GLOBAL LTD.</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-5 py-12 sm:px-8">
        <div class="grid gap-px border border-ink/10 bg-ink/10 sm:grid-cols-2">
            <div class="bg-white p-6 sm:p-8">
                <p class="text-xs font-bold uppercase text-muted">Total public investment</p>
                <p class="font-display mt-3 text-3xl text-forest sm:text-4xl">₦{{ number_format((float) $totalInvestment, 2) }}</p>
            </div>
            <div class="bg-white p-6 sm:p-8">
                <p class="text-xs font-bold uppercase text-muted">Total public shares</p>
                <p class="font-display mt-3 text-3xl text-forest sm:text-4xl">{{ number_format($totalShares) }}</p>
            </div>
        </div>

        <div class="mt-12 flex flex-col gap-4 border-b border-ink/15 pb-6 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-bold uppercase text-forest">Public register</p>
                <h2 class="font-display mt-2 text-3xl">Shareholder records</h2>
            </div>
            <p class="text-sm text-muted">{{ $records->count() }} public {{ \Illuminate\Support\Str::plural('record', $records->count()) }}</p>
        </div>

        @if ($records->isEmpty())
            <p class="py-12 text-sm text-muted">No public shareholder records are currently available.</p>
        @else
            <div class="hidden grid-cols-[minmax(0,2fr)_1fr_1fr_1fr] gap-4 py-4 text-xs font-bold uppercase text-muted sm:grid">
                <span>Shareholder</span><span>Share class</span><span>Allocated shares</span><span class="text-right">Investment</span>
            </div>
            <div class="divide-y divide-ink/10 border-b border-ink/10">
                @foreach ($records as $record)
                    <article class="grid grid-cols-2 gap-4 py-5 sm:grid-cols-[minmax(0,2fr)_1fr_1fr_1fr] sm:items-center">
                        <h3 class="col-span-2 font-semibold sm:col-span-1">{{ $record->shareholder_name }}</h3>
                        <div><span class="sm:hidden text-xs text-muted">Class &middot; </span>{{ $record->share_class }}</div>
                        <div><span class="sm:hidden text-xs text-muted">Shares &middot; </span>{{ number_format($record->allocated_shares) }}</div>
                        <div class="text-right font-semibold">₦{{ number_format((float) $record->total_investment, 2) }}</div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

    <section class="mx-auto max-w-7xl px-5 pb-16 sm:px-8">
        <div class="grid gap-6 bg-ink px-6 py-8 text-white sm:grid-cols-[1fr_auto] sm:items-center sm:px-9 sm:py-10">
            <div>
                <p class="text-xs font-bold uppercase text-leaf">Investor relations</p>
                <h2 class="font-display mt-2 text-2xl sm:text-3xl">Investor Relations / Capital Inquiry</h2>
                <p class="mt-3 max-w-2xl leading-6 text-white/70">Connect with us to discuss capital participation, shareholder information, or a potential partnership.</p>
            </div>
            <button type="button" id="open-capital-inquiry" class="min-h-11 border border-citrus px-5 py-3 text-sm font-semibold text-white transition hover:bg-citrus hover:text-ink">Start an inquiry</button>
        </div>
        <p class="mt-4 text-sm text-muted">Prefer email? <a href="mailto:makinde.m.treasure@gmail.com?subject=Investor%20Inquiry%20-%20Integritas%20Mogul%20Company%20Global%20Ltd" class="font-semibold text-forest underline decoration-citrus underline-offset-4">Email Investor Relations</a></p>
        <p class="mt-3 text-xs text-muted">Company team? <a href="{{ url('/admin') }}" class="font-medium text-forest/80 underline decoration-ink/20 underline-offset-4 hover:text-forest">Portal Login</a></p>
    </section>

    <dialog id="capital-inquiry-dialog" aria-labelledby="capital-inquiry-title" class="fixed inset-0 z-50 m-0 h-full max-h-none w-full max-w-none items-center justify-center bg-black/50 p-4 text-ink backdrop:bg-transparent open:flex">
        <div class="max-h-[calc(100dvh-2rem)] w-full max-w-xl overflow-y-auto border border-ink/15 bg-paper shadow-xl">
            <div class="flex items-start justify-between gap-5 border-b border-ink/10 px-6 py-5">
                <div>
                    <p class="text-xs font-bold uppercase text-forest">Investor relations</p>
                    <h2 id="capital-inquiry-title" class="font-display mt-2 text-2xl">Capital inquiry</h2>
                </div>
                <button type="button" id="close-capital-inquiry" aria-label="Close inquiry dialog" class="grid h-9 w-9 shrink-0 place-items-center border border-ink/15 text-xl hover:bg-white">&times;</button>
            </div>
            <form id="capital-inquiry-form" class="space-y-4 px-6 py-6">
                <p class="text-sm leading-6 text-muted">Complete the details below. Your email application will open with a message addressed to our Investor Relations team.</p>
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700" for="inquiry-name">Your name</label>
                    <input id="inquiry-name" name="name" required autocomplete="name" class="mt-1 block min-h-11 w-full border border-ink/20 bg-white px-3 py-2 text-ink focus:border-forest focus:outline-none" />
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700" for="inquiry-email">Your email</label>
                    <input id="inquiry-email" name="email" type="email" required autocomplete="email" class="mt-1 block min-h-11 w-full border border-ink/20 bg-white px-3 py-2 text-ink focus:border-forest focus:outline-none" />
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700" for="inquiry-message">Inquiry</label>
                    <textarea id="inquiry-message" name="message" rows="4" required class="mt-1 block w-full border border-ink/20 bg-white px-3 py-2 text-ink focus:border-forest focus:outline-none"></textarea>
                </div>
                <div class="flex flex-wrap items-center gap-3 pt-2">
                    <button type="submit" class="min-h-11 bg-forest px-5 py-3 text-sm font-semibold text-white hover:bg-ink">Continue by email</button>
                    <button type="button" id="cancel-capital-inquiry" class="min-h-11 px-4 py-3 text-sm font-semibold text-muted hover:bg-white">Cancel</button>
                </div>
                <p class="text-sm leading-6 text-muted">If your email app does not open, <a href="mailto:makinde.m.treasure@gmail.com" class="font-semibold text-forest underline decoration-citrus underline-offset-4">open your email app directly</a>.</p>
            </form>
        </div>
    </dialog>

    <script>
        const inquiryDialog = document.getElementById('capital-inquiry-dialog');
        const inquiryForm = document.getElementById('capital-inquiry-form');

        document.getElementById('open-capital-inquiry').addEventListener('click', () => inquiryDialog.showModal());
        document.getElementById('close-capital-inquiry').addEventListener('click', () => inquiryDialog.close());
        document.getElementById('cancel-capital-inquiry').addEventListener('click', () => inquiryDialog.close());
        inquiryForm.addEventListener('submit', (event) => {
            event.preventDefault();

            const formData = new FormData(inquiryForm);
            const name = String(formData.get('name')).trim();
            const email = String(formData.get('email')).trim();
            const inquiry = String(formData.get('message')).trim();
            const mailtoUrl = `mailto:makinde.m.treasure@gmail.com?subject=${encodeURIComponent('Investor Inquiry - ' + name)}&body=${encodeURIComponent(inquiry + '\n\nFrom: ' + name + ' (' + email + ')')}`;

            window.location.href = mailtoUrl;
        });
    </script>
@endsection