<div>
    <h3 class="text-xl font-bold mb-3">{{ $foro->titulo }}</h3>

    <div class="mb-4">
        <textarea wire:model="nuevoMensaje"
                  class="w-full border p-2"
                  placeholder="Escribe un mensaje..."></textarea>

        <button wire:click="enviarMensaje"
                class="" style="background-color:#3B0B1A ; color: white; margin: 10px; padding: 10px; border: 5px; border-radius: 10px;">
            Enviar
        </button>
    </div>

    <hr>

    <h4 class="mt-4 font-bold">Mensajes:</h4>

    @foreach($foro->mensajes as $m)
        <div class="border p-3 mt-3 rounded">

            {{-- Nombre del autor --}}
            <p class="font-bold text-blue-700" style="background-color: #3B0B1A; color: white; border-radius: 10px; padding: 10px;">{{ $m['user_name'] }}</p>

            {{-- Contenido --}}
            <p>{{ $m['contenido'] }}</p>

            <div class="flex gap-3 mt-2">

                {{-- Ícono de reacción del usuario --}}
                @php
                    $userReaction = $this->reaccionUsuario($m['reacciones'] ?? []);
                @endphp

                @if($userReaction === 'like')
                    <span class="text-blue-600 text-xl">👍</span>
                @elseif($userReaction === 'love')
                    <span class="text-red-600 text-xl">❤️</span>
                @endif

                {{-- Botones --}}
                <button style="border-radius: 10px; padding: 10px; border: none;" wire:click="reaccionar('{{ $m['mensaje_id'] }}', 'like')">
                    👍 Me gusta
                </button>

                <button style="border-radius: 10px; padding: 10px; border: none;" wire:click="reaccionar('{{ $m['mensaje_id'] }}', 'love')">
                    ❤️ Me encanta
                </button>
            </div>

            <small class="text-gray-500">
                Total reacciones: {{ count($m['reacciones'] ?? []) }}
            </small>
        </div>
    @endforeach
</div>
