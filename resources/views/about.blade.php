@extends('layouts.app')

@section('title', 'About Us | Integritas Mogul Company Global Ltd')

@section('content')
    <section class="bg-forest text-white">
        <div class="mx-auto max-w-7xl px-5 py-16 sm:px-8 sm:py-24">
            <p class="text-xs font-bold uppercase text-leaf">About Integritas Mogul</p>
            <h1 class="font-display mt-4 max-w-4xl text-4xl leading-tight sm:text-6xl">Building Sustainable Agricultural Trade &amp; Local Supply Chains</h1>
            <p class="mt-6 max-w-3xl text-base leading-7 text-white/80 sm:text-lg">Empowering Nigerian agribusiness through transparent sourcing, reliable distribution, and strategic capital allocation.</p>
        </div>
    </section>

    <section class="mx-auto grid max-w-7xl gap-8 px-5 py-16 sm:px-8 lg:grid-cols-[1fr_2fr] lg:gap-16">
        <div>
            <p class="text-xs font-bold uppercase text-forest">01 / Our story</p>
            <h2 class="font-display mt-3 text-3xl">Who We Are</h2>
        </div>
        <p class="max-w-3xl text-base leading-8 text-muted">Integritas Mogul Company Global Ltd is a forward-thinking Nigerian enterprise dedicated to bridging the gap between local agricultural production, commercial supply, and strategic investment. Founded on the principles of operational integrity, efficient commodity trade, and community-driven development, we facilitate the flow of high-quality produce across key agricultural hubs in Nigeria.</p>
    </section>

    <section class="border-y border-ink/10 bg-white">
        <div class="mx-auto max-w-7xl px-5 py-16 sm:px-8">
            <div class="mb-9">
                <p class="text-xs font-bold uppercase text-forest">02 / Where we work</p>
                <h2 class="font-display mt-3 text-3xl">Dual-Hub Operational Footprint</h2>
            </div>
            <div class="grid gap-10 md:grid-cols-2 md:gap-16">
                <article class="border-t-2 border-citrus pt-5">
                    <p class="text-xs font-bold uppercase text-muted">Ondo State</p>
                    <h3 class="font-display mt-2 text-2xl">Akure Hub</h3>
                    <p class="mt-4 leading-7 text-muted">Serves as our primary regional sourcing and aggregation center for cocoa, grain, and key produce, leveraging Ondo State's rich agricultural hinterland.</p>
                </article>
                <article class="border-t-2 border-leaf pt-5">
                    <p class="text-xs font-bold uppercase text-muted">Ogun State</p>
                    <h3 class="font-display mt-2 text-2xl">Ifo Hub</h3>
                    <p class="mt-4 leading-7 text-muted">Acts as our strategic processing and distribution gateway, strategically positioning supply streams close to key commercial markets in South-Western Nigeria.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-5 py-16 sm:px-8">
        <div class="mb-9">
            <p class="text-xs font-bold uppercase text-forest">03 / What guides us</p>
            <h2 class="font-display mt-3 text-3xl">Our Mission &amp; Core Pillars</h2>
        </div>
        <div class="divide-y divide-ink/10 border-y border-ink/10">
            <article class="grid gap-3 py-6 sm:grid-cols-[minmax(220px,1fr)_2fr] sm:gap-10">
                <h3 class="font-semibold">Operational Integrity</h3>
                <p class="leading-7 text-muted">Maintaining complete transparency in commodity grading, pricing, stock accounting, and investor reporting.</p>
            </article>
            <article class="grid gap-3 py-6 sm:grid-cols-[minmax(220px,1fr)_2fr] sm:gap-10">
                <h3 class="font-semibold">Supply Chain Excellence</h3>
                <p class="leading-7 text-muted">Ensuring prompt collection, optimal storage condition management, and seamless logistics across our Akure and Ifo facilities.</p>
            </article>
            <article class="grid gap-3 py-6 sm:grid-cols-[minmax(220px,1fr)_2fr] sm:gap-10">
                <h3 class="font-semibold">Value Creation</h3>
                <p class="leading-7 text-muted">Connecting smallholder farmers to scalable markets while offering secure, transparent growth opportunities for capital partners.</p>
            </article>
        </div>
    </section>

    <section class="bg-ink text-white">
        <div class="mx-auto grid max-w-7xl gap-6 px-5 py-14 sm:px-8 md:grid-cols-[1fr_2fr] md:gap-16">
            <div>
                <p class="text-xs font-bold uppercase text-leaf">04 / Stewardship</p>
                <h2 class="font-display mt-3 text-3xl">Leadership &amp; Corporate Governance</h2>
            </div>
            <p class="max-w-3xl leading-8 text-white/75">Company leadership and executive management are committed to building long-term shareholder value through accountable management of capital resources, responsible decision-making, and transparent corporate governance.</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-5 py-14 sm:px-8">
        <div class="grid gap-8 md:grid-cols-[1fr_2fr] md:gap-16">
            <div>
                <p class="text-xs font-bold uppercase text-forest">05 / Get in touch</p>
                <h2 class="font-display mt-3 text-3xl">Contact &amp; Inquiries</h2>
            </div>
            <dl class="grid gap-6 sm:grid-cols-2">
                <div>
                    <dt class="text-xs font-bold uppercase text-muted">Official Contact Email</dt>
                    <dd class="mt-2"><a class="font-semibold text-forest underline decoration-citrus underline-offset-4" href="mailto:makinde.m.treasure@gmail.com">makinde.m.treasure@gmail.com</a></dd>
                </div>
                <div>
                    <dt class="text-xs font-bold uppercase text-muted">Direct Line / WhatsApp</dt>
                    <dd class="mt-2"><a class="font-semibold text-forest underline decoration-citrus underline-offset-4" href="https://wa.me/2349115294177">+234 911 529 4177</a></dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-xs font-bold uppercase text-muted">Hub Locations</dt>
                    <dd class="mt-2 font-semibold">Akure (Ondo State) &amp; Ifo (Ogun State), Nigeria</dd>
                </div>
            </dl>
        </div>
    </section>
@endsection