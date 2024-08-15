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
                    x-data="{
                    dispatched: false,
                    order: null,
                    delivered: false
                }"
                    x-init="
                    Echo.private('users.{{auth()->id()}}')
                    .listen('OrderDispatched', (event) => {
                        console.log(event);
                        order = event?.order
                        dispatched = true
                    })
                        .listen('OrderDelivered', (event) => {
                        console.log(event);
                        order = event?.order
                        delivered = true
                    })
                ">
                    <template x-if="dispatched">
                        <div>
                            Order (# <span x-text="order?.id"></span>) Order has been dispatched
                        </div>
                    </template>
                    <template x-if="delivered">
                        <div>
                            Order (# <span x-text="order?.id"></span>) Order has been delivered
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- 
<script>
    // fix Echo is not define error
    window.Echo = Echo;
    Echo.channel('chat').listen('Example', (event) => {
        console.log(event);
    });

    console.log('hello');
</script> -->