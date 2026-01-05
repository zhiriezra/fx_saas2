<x-filament-widgets::widget>
    <div class="p-2">
        <div id="map" style="height: 400px;"></div>
    </div>

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script>
        document.addEventListener('livewire:load', function () {
            const map = L.map('map').setView([9.0820, 8.6753], 6); // Center on Nigeria
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            const agentData = @json($this->getAgentData());
            
            // Add markers for each LGA with agents
            agentData.forEach(location => {
                // You would need to implement a function to get coordinates for each LGA
                // This is a placeholder - you'll need to add actual coordinates
                const coordinates = getCoordinatesForLGA(location.state, location.lga);
                
                if (coordinates) {
                    L.marker(coordinates)
                        .bindPopup(`
                            <strong>${location.lga}, ${location.state}</strong><br>
                            Active Agents: ${location.agent_count}
                        `)
                        .addTo(map);
                }
            });
        });

        // Placeholder function - you'll need to implement this with actual coordinates
        function getCoordinatesForLGA(state, lga) {
            // This should return [latitude, longitude] for the given LGA
            // You might want to store these in a database or use a geocoding service
            return null;
        }
    </script>
    @endpush
</x-filament-widgets::widget> 