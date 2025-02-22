console.log("chat.js is loaded successfully!");

document.addEventListener("DOMContentLoaded", function () {
    const chatForm = document.getElementById("chatForm");
    const messageInput = document.getElementById("messageInput");
    const chatBox = document.getElementById("chatBox");
    
    chatForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent page reload

        let message = messageInput.value.trim();
        let sender_id = document.getElementById("sender_id")?.value;
        let receiver_id = document.getElementById("receiver_id")?.value;

        console.log("📤 Sending Message:", { message, sender_id, receiver_id });

        if (message === "") {
            alert("⚠ Message cannot be empty!");
            return;
        }

        fetch("/KOOS-12_surveyform/controller/sendMessageController.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams({ message, sender_id, receiver_id })
        })
        .then(response => response.json())
        .then(data => {
            console.log("🔍 Server Response:", data);
            if (data.status === "success") {
                messageInput.value = ""; // Clear input after successful send
                loadMessages(); // Refresh chat after sending
            } else {
                console.warn("❌ Error sending message:", data.error);
            }
        })
        .catch(error => console.error("❌ Fetch Error:", error));
    });

    loadMessages();
});

function loadMessages() {
    let chatBox = document.getElementById("chatBox");
    let sender_id = document.getElementById("sender_id")?.value;
    let receiver_id = document.getElementById("receiver_id")?.value;

    fetch(`/KOOS-12_surveyform/controller/messageController.php?sender_id=${sender_id}&receiver_id=${receiver_id}`)
    .then(response => response.json())
    .then(data => { 
        console.log("🔍 Server Response (messages):", data);

        if (!Array.isArray(data.messages)) {
            console.warn("❌ Expected an array but got:", data);
            return;
        }

        chatBox.innerHTML = ""; // Clear previous messages

        data.messages.forEach(msg => {
            let div = document.createElement("div");
            div.classList.add("chat-message");

            if (msg.sender_id === sender_id) {
                div.classList.add("sender");
            } else {
                div.classList.add("receiver");
            }

            div.innerHTML = `<span>${msg.message}</span>`;
            chatBox.appendChild(div);
        });

        chatBox.scrollTop = chatBox.scrollHeight;
    })
    .catch(error => console.error("❌ Fetch Error:", error));
}

//setInterval(loadMessages, 2000);
