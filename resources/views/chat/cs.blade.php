
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with Customer Service</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .tailwind-container .chat-box {
            height: 50vh;
            max-height: 50vh;
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <div class="container tailwind-container">
        <h2 class="text-center text-2xl mb-4">Chat with Customer Service</h2>

        <div class="flex flex-wrap">
            @if (Auth::user()->role === 'admin')
                <div class="w-full md:w-1/4 mb-4 md:mb-0">
                    <ul class="list-group">
                        @foreach($users as $user)
                            <li class="list-group-item">
                                <a href="javascript:void(0);" onclick="selectUser({{ $user->id }})">{{ $user->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="{{ Auth::user()->role === 'admin' ? 'w-full md:w-3/4' : 'w-full' }}">
                <div class="chat-box" id="chatBox"></div>
                <textarea id="message" class="form-control mt-2" rows="3" placeholder="Type your message here..."></textarea>
                <input type="file" id="imageInput" class="form-control mt-2" accept="image/*">
                <button class="btn btn-primary" onclick="sendMessage()">Send</button>
            </div>
        </div>
    </div>

    <script>
        let selectedUserId = {{ Auth::user()->role === 'admin' ? 'null' : $admin->id }};
        const chatBox = document.getElementById('chatBox');

        function selectUser(userId) {
            selectedUserId = userId;
            fetchMessages();
        }

        function fetchMessages() {
            if (!selectedUserId) return;

            fetch(`/chat/messages/${selectedUserId}`)
                .then(response => response.json())
                .then(messages => {
                    chatBox.innerHTML = '';

                    messages.forEach(message => {
                        let messageElement = document.createElement('div');
                        let senderName = '';
                        let chatClass = '';

                        if (message.from_user_id == {{ Auth::id() }}) {
                            senderName = 'You';
                            chatClass = 'chat chat-end';
                        } else {
                            senderName = message.sender.role === 'admin' ? 'Admin' : message.sender.name;
                            chatClass = 'chat chat-start';
                        }

                        if (message.message_type === 'text') {
                            messageElement.innerHTML = `
                                <div class="${chatClass}">
                                    <div class="chat-header">
                                        ${senderName}
                                        <time class="text-xs opacity-50">${new Date(message.created_at).toLocaleTimeString()}</time>
                                    </div>
                                    <div class="chat-bubble bg-blue-100 p-2 rounded-md">
                                        <pre>${message.message}</pre>
                                    </div>
                                    <div class="chat-footer text-xs opacity-50">Seen</div>
                                </div>
                            `;
                        } else if (message.message_type === 'image') {
                            messageElement.innerHTML = `
                                <div class="${chatClass}">
                                    <div class="chat-header">
                                        ${senderName}
                                        <time class="text-xs opacity-50">${new Date(message.created_at).toLocaleTimeString()}</time>
                                    </div>
                                    <img src="/storage/${message.message}" class="chat-bubble bg-blue-100 p-2 rounded-md" style="max-width: 100%; max-height: 200px;">
                                    <div class="chat-footer text-xs opacity-50">Seen</div>
                                </div>
                            `;
                        }

                        chatBox.appendChild(messageElement);
                    });

                    chatBox.scrollTop = chatBox.scrollHeight;
                });
        }

        function sendMessage() {
            let messageInput = document.getElementById('message');
            let imageInput = document.getElementById('imageInput');
            let message = messageInput.value;
            let image = imageInput.files[0];

            if (!message && !image) return;
            if (!selectedUserId) return;

            let formData = new FormData();
            formData.append('to_user_id', selectedUserId);
            if (image) {
                formData.append('image', image);
                formData.append('message', ''); // Kosongkan pesan teks jika ada gambar
            } else {
                formData.append('message', message);
            }

            fetch('/chat/send', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'Message Sent!') {
                    messageInput.value = '';
                    imageInput.value = '';
                    fetchMessages();
                }
            });
        }

        // Auto-refresh the chat box every 5 seconds
        setInterval(fetchMessages, 5000);
    </script>
</body>

