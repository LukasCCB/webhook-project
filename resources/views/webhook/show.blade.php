<html>
<head>
    <title>Webhook</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen">

<div class="container mx-auto p-4">

    <!-- Grid layout -->
    <div class="grid grid-cols-3 gap-4 py-12">

        <!-- Lado esquerdo: Lista de webhooks registrados -->
        <div class="col-span-1 bg-gray-800 p-4 rounded-md">
            <h2 class="text-lg font-semibold mb-4">Webhooks Registrados</h2>

            <button type="submit" class="bg-green-500 hover:bg-red-600 text-white px-3 py-2 rounded">
                Integration Demo
            </button>
            <hr class="py-2">

            {{--            <form action="{{ route('webhook.delete', $unique_url) }}" method="POST">--}}
            {{--                @csrf--}}
            {{--                @method('DELETE')--}}
            {{--                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded">Deletar URL--}}
            {{--                </button>--}}
            {{--            </form>--}}

            <ul class="hover:overflow-y-scroll">
                @foreach($webhooks as $webhook)
                    <li class="mb-2">
                        <a href="{{ route('webhook.show', [$webhook->webhookUrl->unique_url, $webhook->id] ) }}"
                           class="text-blue-500 hover:underline">

                            @if($webhook->method === 'POST')
                                <span
                                    class="inline-flex items-center rounded-md bg-yellow-400/10 px-2 py-1 text-xs font-medium text-yellow-500 ring-1 ring-inset ring-yellow-400/20">
                                POST
                            </span>
                            @elseif($webhook->method === 'GET')
                                <span
                                    class="inline-flex items-center rounded-md bg-green-500/10 px-2 py-1 text-xs font-medium text-green-400 ring-1 ring-inset ring-green-500/20">
                                GET
                            </span>
                            @elseif($webhook->method === 'DELETE')
                                <span
                                    class="inline-flex items-center rounded-md bg-red-400/10 px-2 py-1 text-xs font-medium text-red-400 ring-1 ring-inset ring-red-400/20">
                                DELETE
                            </span>
                            @elseif($webhook->method === 'PUT')
                                <span
                                    class="inline-flex items-center rounded-md bg-red-400/10 px-2 py-1 text-xs font-medium text-red-400 ring-1 ring-inset ring-red-400/20">
                                PUT
                            </span>
                            @elseif($webhook->method === 'PATCH')
                                <span
                                    class="inline-flex items-center rounded-md bg-red-400/10 px-2 py-1 text-xs font-medium text-red-400 ring-1 ring-inset ring-red-400/20">
                                PATCH
                            </span>
                            @endif

                            #{{ $webhook->id }} - {{ $selectedWebhook->cf_headers['x-forwarded-for'] }} -
                            {{ $webhook->created_at->diffForHumans() }}
                        </a>
                    </li>
                @endforeach
            </ul>

        </div>

        <!-- Meio para a direita: campos de headers e body -->
        <div class="col-span-2 bg-gray-800 p-4 rounded space-y-4">

            <!-- Headers -->
            <div>
                <h2 class="text-lg font-semibold mb-4">Headers</h2>
                <pre class="bg-gray-700 p-4 truncate rounded hover:overflow-auto hover:overflow-scroll">
                    @if($selectedWebhook)
                        <pre>{{ json_encode(json_decode($selectedWebhook->headers, true), JSON_PRETTY_PRINT) }}</pre>
                    @endif
                </pre>
            </div>

            <!-- Body -->
            <div>
                <h2 class="text-lg font-semibold mb-4">Body</h2>
                <pre class="bg-gray-700 p-4 rounded truncate rounded hover:overflow-auto hover:overflow-scroll">
                    @if($selectedWebhook)
                        <pre>{{ json_encode(json_decode($selectedWebhook->payload, true), JSON_PRETTY_PRINT) }}</pre>
                    @endif
                </pre>
            </div>

        </div>

    </div>

</div>

</body>
</html>
