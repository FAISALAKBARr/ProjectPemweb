
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with Customer Service</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        .error-message {
            color: red;
            display: none;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }
        .chat-image {
            cursor: pointer;
            max-width: 100%;
            max-height: 200px;
            transition: transform 0.2s;
        }
        .chat-image:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="container tailwind-container">
        <h2 class="text-center text-2xl mb-4">Customer Service</h2>

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
                <div id="error-message" class="error-message">File size exceeds 2MB.</div>

                <div class="button-container">
                    <button class="btn btn-secondary" onclick="window.history.back()">Back</button>
                    <button class="btn btn-primary" onclick="sendMessage()">Send</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedUserId = {{ Auth::user()->role === 'admin' ? 'null' : $admin->id }};
        const chatBox = document.getElementById('chatBox');
        const errorMessage = document.getElementById('error-message');

        function selectUser(userId) {
            selectedUserId = userId;
            fetchMessages();
        }

        function fetchMessages() {
            if (!selectedUserId) return;

            $.ajax({
                url: `/chat/messages/${selectedUserId}`,
                type: 'GET',
                success: function(messages) {
                    chatBox.innerHTML = '';

                    messages.forEach(message => {
                        let messageElement = $('<div></div>');
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
                            messageElement.html(`
                                <div class="${chatClass}">
                                    <div class="chat-header">
                                        ${senderName}
                                        <time class="text-xs opacity-50">${new Date(message.created_at).toLocaleTimeString()}</time>
                                    </div>
                                    <div class="chat-bubble bg-blue-100 p-2 rounded-md">
                                        <pre>${message.message}</pre>
                                    </div>
                                    <div  ${!message.seen ? '<div class="chat-footer text-xs opacity-50">Delivered</div>' : '<div class="chat-footer text-xs opacity-50">Seen</div>'}</div>
                                </div>
                            `);
                        } else if (message.message_type === 'image') {
                            messageElement.html(`
                                <div class="${chatClass}">
                                    <div class="chat-header">
                                        ${senderName}
                                        <time class="text-xs opacity-50">${new Date(message.created_at).toLocaleTimeString()}</time>
                                    </div>
                                    <img src="/storage/${message.message}" class="chat-bubble chat-image bg-blue-100 p-2 rounded-md">
                                    <div  ${!message.seen ? '<div class="chat-footer text-xs opacity-50">Delivered</div>' : '<div class="chat-footer text-xs opacity-50">Seen</div>'}</div>
                                </div>
                            `);
                        }

                        chatBox.appendChild(messageElement[0]);
                    });

                    chatBox.scrollTop = chatBox.scrollHeight;

                    // Add click event to all chat images
                    $('.chat-image').on('click', function() {
                        let imgSrc = $(this).attr('src');
                        window.open(imgSrc, '_blank');
                    });
                }
            });
        }

        function sendMessage() {
            let messageInput = $('#message');
            let imageInput = $('#imageInput');
            let message = messageInput.val();
            let image = imageInput[0].files[0];

            if (!message && !image) return;
            if (!selectedUserId) return;

            if (image && image.size > 2048 * 1024) { // 2MB in bytes
                errorMessage.style.display = 'block';
                return;
            } else {
                errorMessage.style.display = 'none';
            }

            let formData = new FormData();
            formData.append('to_user_id', selectedUserId);
            if (image) {
                formData.append('image', image);
                formData.append('message', ''); // Kosongkan pesan teks jika ada gambar
            } else {
                formData.append('message', message);
            }

            $.ajax({
                url: '/chat/send',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status === 'Message Sent!') {
                        messageInput.val('');
                        imageInput.val('');
                        fetchMessages();
                    }
                }
            });
        }

        // Auto-refresh the chat box every 5 seconds
        setInterval(fetchMessages, 5000);
    </script>
</body>

