<x-filament::card>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <h2 class="text-xl font-bold">{{ $this->getData()['gallery_items'] }}</h2>
            <p>Gallery Items</p>
        </div>
        <div>
            <h2 class="text-xl font-bold">{{ $this->getData()['news_items'] }}</h2>
            <p>News Items</p>
        </div>
        <div>
            <h2 class="text-xl font-bold">{{ $this->getData()['products'] }}</h2>
            <p>Products</p>
        </div>
        <div>
            <h2 class="text-xl font-bold">{{ $this->getData()['services'] }}</h2>
            <p>Services</p>
        </div>
        <div>
            <h2 class="text-xl font-bold">{{ $this->getData()['categories'] }}</h2>
            <p>Categories</p>
        </div>
    </div>
</x-filament::card>
