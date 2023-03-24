<x-app-layout>
    <div class="p-4 bg-white rounded-lg shadow-xs">
        <div class="mt-4 mb-4">
            <h2 class="text-2xl font-bold">Acortar Link</h2>
            <form action="{{ route('sms.link') }}" method="post" id="form-link" enctype="multipart/form-data">
                @csrf
                <div class="flex mt-2">
                    <input type="text" name="url" id="url"
                        class="border border-gray-400 px-4 py-2 mr-4 rounded-lg w-full" placeholder="Link">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Acortar</button>
                </div>
                <div class="flex mt-2">
                    <input type="text" name="short_link" id="short_link"
                        class="border border-gray-400 px-4 py-2 mr-4 rounded-lg w-full bg-gray-100 text-gray-400 cursor-not-allowed"
                        placeholder="Link Acortado" readonly>
                    <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-lg"
                        id="copy">Copiar</button>
                </div>
            </form>
        </div>
        <div class="mt-4 mb-4">
            <h2 class="text-2xl font-bold">Enviar SMS</h2>
            <form action="{{ route('sms.store') }}" method="post">
                @csrf
                <div class="flex mt-2">
                    <select name="option_send" id="option_send"
                        class="border border-gray-400 px-4 py-2 mr-4 rounded-lg w-full">
                        <option value="1">Coordinadores</option>
                        <option value="2">Lideres</option>
                        <option value="3">Votantes</option>
                        <option value="0">Todos</option>
                    </select>
                </div>
                <div class="flex flex-col mt-2">
                    <textarea name="message" id="message" cols="30" rows="10"
                        class="border border-gray-400 px-4 py-2 mr-4 rounded-lg w-full" placeholder="Mensaje"></textarea>
                    <div class="flex justify-end">
                        <span id="counter">0</span>
                        <span>/180</span>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Enviar</button>
                </div>
                @if ($errors->any())
                    <div class="mt-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-500">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>
    </div>
    <script>
        const message = document.getElementById('message');
        const counter = document.getElementById('counter');
        message.addEventListener('keyup', () => {
            counter.innerHTML = message.value.length;
        });

        const formLink = document.getElementById('form-link');
        const link = document.getElementById('url');
        const shortLink = document.getElementById('short_link');
        const copy = document.getElementById('copy');

        //if url is empty disable button
        link.addEventListener('keyup', () => {
            if (link.value.length > 0) {
                formLink.querySelector('button[type="submit"]').disabled = false;
            } else {
                formLink.querySelector('button[type="submit"]').disabled = true;
            }
        });

        formLink.addEventListener('submit', (e) => {
            e.preventDefault();
            //if url is empty do nothing
            if (link.value.length == 0) {
                return;
            }
            $.ajax({
                url: '{{ route('sms.link') }}',
                method: 'POST',
                data: new FormData(formLink),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                //add loading animation here
                beforeSend: function() {
                    formLink.querySelector('button[type="submit"]').disabled = true;
                },

                success: function(response) {

                    shortLink.value = response?.data?.short_url;

                },
                error: function(response) {
                    console.log("error", response);
                }
            });
        });

        copy.addEventListener('click', () => {
            shortLink.select();
            document.execCommand('copy');
        });
    </script>
</x-app-layout>
