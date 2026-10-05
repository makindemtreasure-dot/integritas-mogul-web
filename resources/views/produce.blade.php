@extends('layouts.app')

@section('title', 'Our Produce | Integritas Mogul Company Global Ltd')

@section('content')
    <section class="bg-forest text-white">
        <div class="mx-auto max-w-7xl px-5 py-14 sm:px-8 sm:py-20">
            <p class="text-xs font-bold uppercase text-leaf">Sourced and supplied with care</p>
            <h1 class="font-display mt-3 text-4xl leading-tight sm:text-5xl">Our Produce</h1>
            <p class="mt-5 max-w-2xl leading-7 text-white/75">Current availability across our Akure and Ifo hubs. Stock and pricing reflect the latest recorded inventory.</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-5 py-14 sm:px-8">
        @if ($items->isEmpty())
            <div class="border-y border-ink/10 py-14 text-center">
                <h2 class="font-display text-2xl">No produce is currently listed.</h2>
                <p class="mt-2 text-sm text-muted">Please check back for updated availability.</p>
            </div>
        @else
            <div class="space-y-14">
                @foreach (['Akure', 'Ifo'] as $location)
                    @php
                        $locationItems = $items->get($location, collect());
                    @endphp
                    @if ($locationItems->isNotEmpty())
                        <section aria-labelledby="{{ strtolower($location) }}-heading">
                            <div class="flex flex-col gap-2 border-b border-ink/15 pb-5 sm:flex-row sm:items-end sm:justify-between">
                                <div>
                                    <p class="text-xs font-bold uppercase text-forest">{{ $location === 'Akure' ? 'Ondo State' : 'Ogun State' }}</p>
                                    <h2 id="{{ strtolower($location) }}-heading" class="font-display mt-2 text-3xl">{{ $location }} Hub</h2>
                                </div>
                                <p class="text-sm text-muted">{{ $locationItems->count() }} listed {{ \Illuminate\Support\Str::plural('product', $locationItems->count()) }}</p>
                            </div>
                            <div class="grid grid-cols-1 items-stretch gap-6 pt-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                                @foreach ($locationItems as $item)
                                    @php
                                        $orderMessage = "Hello Integritas Mogul, I would like to purchase {$item->item_name} (SKU: {$item->sku})";
                                        $orderUrl = 'https://wa.me/2349115294177?text='.rawurlencode($orderMessage);
                                        $fallbackPhoto = config('produce_photos.items.'.$item->item_name, config('produce_photos.default'));
                                    @endphp
                                    <article class="mx-auto flex h-full w-full max-w-sm flex-col overflow-hidden rounded-lg border border-ink/10 bg-white">
                                        @if ($item->image_path)
                                            <div class="w-full h-40 overflow-hidden rounded-t-lg bg-gray-100">
                                                <img src="{{ asset('storage/'.$item->image_path) }}" alt="{{ $item->item_name }}" loading="lazy" style="height: 160px; max-height: 160px; object-fit: cover;" class="w-full h-40 object-cover rounded-t-lg">
                                            </div>
                                        @else
                                            <figure class="overflow-hidden rounded-t-lg">
                                                <div class="w-full h-40 overflow-hidden rounded-t-lg bg-gray-100">
                                                    <img src="{{ $fallbackPhoto['url'] }}" alt="{{ $item->item_name }} produce" loading="lazy" style="height: 160px; max-height: 160px; object-fit: cover;" class="w-full h-40 object-cover rounded-t-lg">
                                                </div>
                                                <figcaption class="px-4 pt-2 text-[10px] text-muted">
                                                    Photo: <a href="{{ $fallbackPhoto['source'] }}" target="_blank" rel="noopener noreferrer" class="underline underline-offset-2">{{ $fallbackPhoto['credit'] }}</a>
                                                    &middot; <a href="{{ $fallbackPhoto['license_url'] }}" target="_blank" rel="noopener noreferrer" class="underline underline-offset-2">{{ $fallbackPhoto['license'] }}</a>
                                                </figcaption>
                                            </figure>
                                        @endif
                                        <div class="flex flex-1 flex-col p-5">
                                            <div class="flex items-start justify-between gap-3">
                                                <div class="min-w-0">
                                                    <h3 class="font-display text-xl">{{ $item->item_name }}</h3>
                                                    <p class="mt-1 text-xs text-muted">SKU: {{ $item->sku }}</p>
                                                </div>
                                                <span class="shrink-0 bg-forest/10 px-2.5 py-1 text-xs font-semibold text-forest">{{ $item->location }}</span>
                                            </div>
                                            <div class="mt-5 flex items-center justify-between gap-3 border-t border-ink/10 pt-4">
                                                <div>
                                                    <p class="text-xs text-muted">Available</p>
                                                    <p class="mt-1 font-semibold">{{ number_format($item->quantity_in_stock) }} units</p>
                                                </div>
                                                <span @class([
                                                    'px-2.5 py-1 text-xs font-semibold',
                                                    'bg-leaf/25 text-forest' => $item->status === 'in_stock',
                                                    'bg-citrus/25 text-ink' => $item->status === 'low_stock',
                                                ])>{{ $item->status === 'in_stock' ? 'In stock' : 'Low stock' }}</span>
                                            </div>
                                            <p class="mt-4 font-semibold">₦{{ number_format((float) $item->unit_price, 2) }} <span class="text-xs font-normal text-muted">per unit</span></p>
                                            <a href="{{ $orderUrl }}" target="_blank" rel="noopener noreferrer" class="mt-5 inline-flex min-h-11 items-center justify-center gap-2 bg-forest px-4 py-3 text-sm font-semibold text-white transition hover:bg-ink focus:outline-none focus:ring-2 focus:ring-citrus focus:ring-offset-2">
                                                <span aria-hidden="true">&#9742;</span> Order via WhatsApp
                                            </a>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </section>
                    @endif
                @endforeach
            </div>
        @endif
    </section>
@endsection