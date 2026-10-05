@extends('layouts.app')

@section('title', 'Home | INTEGRITAS MOGUL')

@section('content')
    <section class="hero-field relative isolate overflow-hidden text-white">
        <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=2000&q=85" alt="Cultivated fields beneath a broad Nigerian sky" class="absolute inset-0 -z-20 h-full w-full object-cover object-center">
        <div class="absolute inset-0 -z-10 bg-gradient-to-r from-ink/90 via-forest/75 to-forest/25"></div>
        <div class="page-enter mx-auto flex min-h-[390px] max-w-7xl flex-col justify-center px-5 py-16 sm:px-8 lg:min-h-[460px]">
            <p class="mb-5 flex items-center gap-3 text-xs font-bold uppercase text-leaf">
                <span class="h-px w-8 bg-citrus"></span> Akure &middot; Ifo &middot; Nigeria
            </p>
            <h1 class="font-display max-w-3xl text-4xl leading-tight sm:text-6xl">Growing value.<br><span class="text-leaf">Moving it forward.</span></h1>
            <p class="mt-6 max-w-xl text-base leading-7 text-white/85 sm:text-lg">A Nigerian company investing in the strength of local supply, responsible trade and lasting partnerships.</p>
            <a href="#available-stock" class="mt-8 inline-flex w-fit items-center gap-3 border border-white/60 px-5 py-3 text-sm font-semibold transition hover:border-citrus hover:bg-citrus hover:text-ink">
                Explore available stock <span aria-hidden="true">&rarr;</span>
            </a>
        </div>
        <div class="border-t border-white/20 bg-ink/75">
            <div class="mx-auto grid max-w-7xl grid-cols-1 gap-3 px-5 py-4 text-sm text-white/80 sm:grid-cols-3 sm:px-8">
                <p><span class="mr-2 text-citrus">01</span> Locally rooted operations</p>
                <p><span class="mr-2 text-citrus">02</span> Two active locations</p>
                <p><span class="mr-2 text-citrus">03</span> Clear public reporting</p>
            </div>
        </div>
    </section>

    <section id="available-stock" class="page-enter mx-auto max-w-7xl px-5 py-16 sm:px-8">
        <div class="flex flex-col gap-5 border-b border-ink/15 pb-7 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-bold uppercase text-forest">Current availability</p>
                <h2 class="font-display mt-2 text-3xl sm:text-4xl">On the shelves</h2>
            </div>
            <p class="max-w-md text-sm leading-6 text-muted">Browse available and low-stock goods across our Akure and Ifo operations.</p>
        </div>

        @if ($items->isEmpty())
            <div class="py-14 text-center">
                <p class="font-display text-2xl">No stock listed just now.</p>
                <p class="mt-2 text-sm text-muted">Please check back for the latest availability.</p>
            </div>
        @else
            <div class="hidden grid-cols-[minmax(0,2fr)_1fr_1fr_1fr_1fr] gap-4 py-4 text-xs font-bold uppercase text-muted sm:grid">
                <span>Product</span><span>Location</span><span>Available</span><span>Status</span><span class="text-right">Unit price</span>
            </div>
            <div class="divide-y divide-ink/10 border-b border-ink/10">
                @foreach ($items as $item)
                    <article class="grid grid-cols-2 gap-x-4 gap-y-3 py-5 sm:grid-cols-[minmax(0,2fr)_1fr_1fr_1fr_1fr] sm:items-center sm:gap-4">
                        <div class="col-span-2 min-w-0 sm:col-span-1">
                            <h3 class="font-semibold">{{ $item->item_name }}</h3>
                            <p class="mt-1 text-xs text-muted">{{ $item->sku }}</p>
                        </div>
                        <div><span class="sm:hidden text-xs text-muted">Location &middot; </span><span class="font-medium">{{ $item->location }}</span></div>
                        <div><span class="sm:hidden text-xs text-muted">Units &middot; </span>{{ number_format($item->quantity_in_stock) }}</div>
                        <div>
                            <span @class([
                                'inline-flex px-2.5 py-1 text-xs font-semibold',
                                'bg-leaf/25 text-forest' => $item->status === 'in_stock',
                                'bg-citrus/25 text-ink' => $item->status === 'low_stock',
                            ])>{{ $item->status === 'in_stock' ? 'In stock' : 'Low stock' }}</span>
                        </div>
                        <div class="text-right font-semibold">₦{{ number_format((float) $item->unit_price, 2) }}</div>
                    </article>
                @endforeach
            </div>
            <div class="mt-7">{{ $items->links() }}</div>
        @endif
    </section>

    <section class="border-y border-ink/10 bg-white">
        <div class="mx-auto flex max-w-7xl flex-col gap-6 px-5 py-10 sm:flex-row sm:items-center sm:justify-between sm:px-8">
            <div>
                <p class="text-xs font-bold uppercase text-forest">Ownership &amp; capital</p>
                <h2 class="font-display mt-2 text-2xl">A clear view of our public records.</h2>
            </div>
            <a href="{{ route('investors') }}" class="inline-flex w-fit items-center gap-3 border-b-2 border-citrus pb-1 text-sm font-semibold">View investor information <span aria-hidden="true">&rarr;</span></a>
        </div>
    </section>
@endsection