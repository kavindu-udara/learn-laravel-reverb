<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900"
                    x-data="
                    {userPositions : []}
                "
                    x-init="
                    const channel = Echo.private('app');

                    let width = window.innerWidth;
                    let height = window.innerHeight;
                    
                    channel.listenForWhisper('mousemove', (event) => {

                        const user = userPositions.find(p => p.user.id == event.user.id)

                        if(typeof user == 'undefined') {
                            userPositions.push(event)
                            return;
                        }

                        user.position = {
                                x: event.position.x * width,
                                y: event.position.y * height
                        }

                        console.log(userPositions);

                    })

                    onmousemove = (e) => {
                        channel.whisper('mousemove', {
                            user:{{json_encode(auth()->user()->only('id', 'name'))}},
                            position: {
                            x: e.x / width,
                            y: e.y /height
                            }
                        })
                    }
            ">
                    <template x-for="user in userPositions">
                        <div class="flex items-center bg-blue-500 absolute leading-none space-x-1 h-3" x-bind:style="`left: ${user.position.x}px; top: ${user.position.y}px;`">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="10px" width="10px" version="1.1" id="Capa_1" viewBox="0 0 14.463 14.463" xml:space="preserve">
                                <g>
                                    <path style="fill:#030104;" d="M14.337,0.125c-0.117-0.118-0.295-0.156-0.451-0.098L1.576,4.664   c-0.171,0.064-0.282,0.23-0.275,0.413c0.007,0.184,0.13,0.342,0.304,0.393l3.086,0.915l-4.566,4.566   c-0.167,0.166-0.167,0.436,0,0.602l2.785,2.784c0.166,0.167,0.436,0.167,0.602,0L8.14,9.71l0.851,3.139   c0.049,0.178,0.206,0.305,0.391,0.313s0.354-0.103,0.419-0.274l4.634-12.312C14.494,0.42,14.456,0.243,14.337,0.125z M9.467,11.353   L8.768,8.778C8.729,8.632,8.614,8.516,8.467,8.477S8.163,8.481,8.056,8.588L3.21,13.434l-2.182-2.183L5.799,6.48   c0.106-0.106,0.148-0.26,0.112-0.405C5.874,5.929,5.763,5.813,5.619,5.772L3.061,5.014l10.246-3.859L9.467,11.353z" />
                                </g>
                            </svg>
                            <span class="text-sm font-semibold bg-blue-500" x-text="user.user.name"></span>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>