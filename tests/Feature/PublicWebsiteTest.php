<?php

namespace Tests\Feature;

use App\Models\CapitalRecord;
use App\Models\InventoryItem;
use App\Models\User;
use App\Filament\Pages\Dashboard;
use App\Filament\Widgets\StatsOverview;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PublicWebsiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads_and_hides_out_of_stock_products(): void
    {
        InventoryItem::factory()->create([
            'item_name' => 'Available Cocoa',
            'sku' => 'TEST-COCOA',
            'quantity_in_stock' => 4,
        ]);
        InventoryItem::factory()->create([
            'item_name' => 'Available Apples',
            'sku' => 'TEST-APPLES',
            'quantity_in_stock' => 20,
        ]);
        InventoryItem::factory()->create([
            'item_name' => 'Unavailable Beans',
            'sku' => 'TEST-BEANS',
            'quantity_in_stock' => 0,
        ]);

        $this->get('/')->assertOk()
            ->assertSee('rel="icon" type="image/x-icon" href="'.asset('favicon.ico').'"', false)
            ->assertSee('rel="icon" type="image/png" sizes="32x32" href="'.asset('images/logo.png').'"', false)
            ->assertSee('rel="apple-touch-icon" href="'.asset('images/logo.png').'"', false)
            ->assertSee('src="'.asset('images/logo.png').'" alt="Integritas Mogul logo"', false)
            ->assertSeeInOrder(['Available Apples', 'Available Cocoa'])
            ->assertSee('Available Cocoa')
            ->assertDontSee('Unavailable Beans');
    }

    public function test_investors_page_shows_only_public_records_and_totals(): void
    {
        CapitalRecord::factory()->create([
            'shareholder_name' => 'Public Investor One',
            'share_class' => 'Ordinary',
            'allocated_shares' => 200,
            'total_investment' => 1250000,
            'is_public' => true,
        ]);
        CapitalRecord::factory()->create([
            'shareholder_name' => 'Public Investor Two',
            'share_class' => 'Preference',
            'allocated_shares' => 50,
            'total_investment' => 350000,
            'is_public' => true,
        ]);
        CapitalRecord::factory()->create([
            'shareholder_name' => 'Private Investor Secret',
            'share_class' => 'Internal',
            'allocated_shares' => 88888,
            'total_investment' => 9876543.21,
            'is_public' => false,
        ]);

        $this->get('/investors')->assertOk()
            ->assertSee('Public Investor One')
            ->assertSee('Public Investor Two')
            ->assertSee('₦1,600,000.00')
            ->assertSee('250')
            ->assertDontSee('Private Investor Secret')
            ->assertDontSee('₦9,876,543.21')
            ->assertDontSee('88,888')
            ->assertSee('Investor Relations / Capital Inquiry')
            ->assertSee('mailto:makinde.m.treasure@gmail.com?subject=Investor%20Inquiry%20-%20Integritas%20Mogul%20Company%20Global%20Ltd', false)
            ->assertSee('capital-inquiry-dialog', false)
            ->assertSee('capital-inquiry-form', false)
            ->assertSee('fixed inset-0 z-50', false)
            ->assertSee('bg-black/50', false)
            ->assertSee('mailto:makinde.m.treasure@gmail.com" class=', false)
            ->assertSee("const inquiry = String(formData.get('message')).trim();", false)
            ->assertSee("encodeURIComponent('Investor Inquiry - ' + name)", false)
            ->assertSee("encodeURIComponent(inquiry + '\\n\\nFrom: ' + name + ' (' + email + ')')", false)
            ->assertSee('window.location.href = mailtoUrl;', false)
            ->assertSee('Portal Login')
            ->assertSee('href="'.url('/admin').'"', false);
    }

    public function test_about_page_displays_the_company_story_mission_and_hubs(): void
    {
        $this->get('/about')->assertOk()
            ->assertSee('About Us | Integritas Mogul Company Global Ltd')
            ->assertSee('Building Sustainable Agricultural Trade &amp; Local Supply Chains', false)
            ->assertSee('Empowering Nigerian agribusiness through transparent sourcing, reliable distribution, and strategic capital allocation.')
            ->assertSee('Who We Are')
            ->assertSee('bridging the gap between local agricultural production, commercial supply, and strategic investment.')
            ->assertSee('Akure Hub')
            ->assertSee('Ifo Hub')
            ->assertSee('Operational Integrity')
            ->assertSee('Supply Chain Excellence')
            ->assertSee('Value Creation')
            ->assertSee('Leadership &amp; Corporate Governance', false)
            ->assertSee('long-term shareholder value')
            ->assertDontSee('Founder')
            ->assertSee('Official Contact Email')
            ->assertSee('mailto:makinde.m.treasure@gmail.com', false)
            ->assertSee('Direct Line / WhatsApp')
            ->assertSee('+234 911 529 4177')
            ->assertSee('Akure (Ondo State) &amp; Ifo (Ogun State), Nigeria', false);
    }

    public function test_produce_page_groups_available_stock_and_public_navigation_has_no_admin_link(): void
    {
        InventoryItem::factory()->create([
            'item_name' => 'Akure Low Cocoa',
            'sku' => 'PRODUCE-AK-LOW',
            'location' => 'Akure',
            'quantity_in_stock' => 6,
            'unit_price' => 12500,
            'image_path' => 'inventory/akure-low-cocoa.jpg',
        ]);
        InventoryItem::factory()->create([
            'item_name' => 'Ifo Fresh Maize',
            'sku' => 'PRODUCE-IF-IN',
            'location' => 'Ifo',
            'quantity_in_stock' => 24,
            'unit_price' => 8750,
        ]);
        InventoryItem::factory()->create([
            'item_name' => 'Cocoa Beans',
            'sku' => 'PRODUCE-COCOA',
            'location' => 'Akure',
            'quantity_in_stock' => 32,
            'unit_price' => 14200,
        ]);
        InventoryItem::factory()->create([
            'item_name' => 'Hidden Empty Stock',
            'sku' => 'PRODUCE-OUT',
            'location' => 'Ifo',
            'quantity_in_stock' => 0,
        ]);

        $this->get('/produce')->assertOk()
            ->assertSee('Our Produce')
            ->assertSee('Akure Hub')
            ->assertSee('Ifo Hub')
            ->assertSee('Akure Low Cocoa')
            ->assertSee('Ifo Fresh Maize')
            ->assertSee('Low stock')
            ->assertSee('In stock')
            ->assertSee('₦12,500.00')
            ->assertSee('₦8,750.00')
            ->assertSee(asset('storage/inventory/akure-low-cocoa.jpg'), false)
            ->assertSee(config('produce_photos.items.Cocoa Beans.url'))
            ->assertSee('Aude')
            ->assertSee(config('produce_photos.default.url'))
            ->assertSee('Zhao Yangjun')
            ->assertSee('https://wa.me/2349115294177?text=Hello%20Integritas%20Mogul%2C%20I%20would%20like%20to%20purchase%20Akure%20Low%20Cocoa%20%28SKU%3A%20PRODUCE-AK-LOW%29', false)
            ->assertSee('Order via WhatsApp')
            ->assertDontSee('Hidden Empty Stock')
            ->assertSee(route('home'), false)
            ->assertSee(route('about'), false)
            ->assertSee(route('produce'), false)
            ->assertSee(route('investors'), false)
            ->assertDontSee('href="'.url('/admin').'"', false);
    }

    public function test_admin_routes_require_authentication(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');

        $admin = User::factory()->create(['email' => 'admin@integritas.test']);

        InventoryItem::factory()->create([
            'quantity_in_stock' => 2,
            'unit_price' => 100,
        ]);
        CapitalRecord::factory()->create(['total_investment' => 250000]);

        $this->actingAs($admin)
            ->get('/admin')
            ->assertOk()
            ->assertSee('Main website')
            ->assertSee('href="/"', false);

        $this->assertContains(StatsOverview::class, app(Dashboard::class)->getWidgets());

        Livewire::actingAs($admin)->test(StatsOverview::class)
            ->assertSee('Total Inventory Items')
            ->assertSee('Total Inventory Value')
            ->assertSee("\u{20A6}200.00")
            ->assertSee('Total Investors / Shareholders')
            ->assertSee('Total Capital Raised / Contributions')
            ->assertSee("\u{20A6}250,000.00");

        $this->actingAs($admin)->get('/admin/inventory-items')->assertOk();
        $this->actingAs($admin)->get('/admin/capital-records')->assertOk();
    }

    public function test_admin_login_page_links_back_to_the_public_homepage(): void
    {
        $this->get('/admin/login')
            ->assertOk()
            ->assertSee('Back to Main Website')
            ->assertSee(route('home'), false);
    }
}