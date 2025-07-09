<x-admin-layout>
    <div x-data="{ show: false }" x-init="$nextTick(() => show = true)">

        <div x-show="show" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 -translate-y-5" x-transition:enter-end="opacity-100 translate-y-0">
            <h1 class="text-2xl font-bold text-white font-heading">Dashboard</h1>
            <p class="text-gray-400">Visão geral do estado atual do WOWNATOR.</p>
        </div>

        <div x-show="show" x-transition:enter="transition ease-out duration-500 delay-100" x-transition:enter-start="opacity-0 translate-y-5" x-transition:enter-end="opacity-100 translate-y-0" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mt-6">
            <div class="bg-stone-800/70 backdrop-blur-sm p-4 rounded-lg text-center"><p class="text-3xl font-bold text-green-400">{{ $stats['users'] }}</p><p class="text-sm text-stone-400">Utilizadores</p></div>
            <div class="bg-stone-800/70 backdrop-blur-sm p-4 rounded-lg text-center"><p class="text-3xl font-bold text-green-400">{{ $stats['characters'] }}</p><p class="text-sm text-stone-400">Personagens</p></div>
            <div class="bg-stone-800/70 backdrop-blur-sm p-4 rounded-lg text-center"><p class="text-3xl font-bold text-green-400">{{ $stats['mounts'] }}</p><p class="text-sm text-stone-400">Montarias</p></div>
            <div class="bg-stone-800/70 backdrop-blur-sm p-4 rounded-lg text-center"><p class="text-3xl font-bold text-green-400">{{ $stats['skills'] }}</p><p class="text-sm text-stone-400">Habilidades</p></div>
            <div class="bg-stone-800/70 backdrop-blur-sm p-4 rounded-lg text-center"><p class="text-3xl font-bold text-green-400">{{ $stats['zones'] }}</p><p class="text-sm text-stone-400">Zonas</p></div>
            <div class="bg-stone-800/70 backdrop-blur-sm p-4 rounded-lg text-center"><p class="text-3xl font-bold text-green-400">{{ $stats['quotes'] }}</p><p class="text-sm text-stone-400">Citações</p></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">
            
            <div x-show="show" x-transition:enter="transition ease-out duration-500 delay-200" x-transition:enter-start="opacity-0 -translate-y-5" x-transition:enter-end="opacity-100 translate-y-0" class="lg:col-span-1 bg-stone-800/70 backdrop-blur-sm p-6 rounded-lg shadow">
                <h2 class="text-xl font-bold text-white font-heading border-b border-stone-700 pb-2 mb-4">Desafio de Hoje</h2>
                @if($challenge)
                    <div class="space-y-4">
                        @php
                            $targets = ['character', 'zone', 'mount', 'skill', 'quote'];
                        @endphp
                        @foreach($targets as $type)
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-stone-400">{{ ucfirst($type) }}</p>
                                    <p class="font-semibold">{{ $challenge->{$type}->name ?? $challenge->{$type}->text }}</p>
                                </div>
                                <form action="{{ route('admin.dashboard.reroll') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="type" value="{{ $type }}">
                                    <button type="submit" class="text-xs bg-orange-600 text-white font-bold py-1 px-2 rounded hover:bg-orange-500 transition">Reroll</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-stone-400">Nenhum desafio foi gerado para hoje.</p>
                @endif
            </div>

            <div x-show="show" x-transition:enter="transition ease-out duration-500 delay-300" x-transition:enter-start="opacity-0 -translate-y-5" x-transition:enter-end="opacity-100 translate-y-0" class="lg:col-span-2 bg-stone-800/70 backdrop-blur-sm p-6 rounded-lg shadow">
                <h2 class="text-xl font-bold text-white font-heading border-b border-stone-700 pb-2 mb-4">Taxa de Acerto Hoje (%)</h2>
                @if($challenge)
                    <canvas id="guessesChart"></canvas>
                @else
                    <p class="text-stone-400">Sem dados para exibir.</p>
                @endif
            </div>
        </div>
    </div>

    @if($challenge)
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('guessesChart').getContext('2d');
            const chartData = @json($chartData);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: '% de Acertos',
                        data: chartData.data,
                        backgroundColor: 'rgba(34, 197, 94, 0.5)',
                        borderColor: 'rgba(34, 197, 94, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: { color: '#a8a29e' }
                        },
                        x: {
                            ticks: { color: '#a8a29e' }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
    </script>
    @endif
</x-admin-layout>
