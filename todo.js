document.addEventListener("DOMContentLoaded", function() {
    // Dieser Event-Listener wartet darauf, dass das DOM vollständig geladen ist, bevor das Skript ausgeführt wird.
    // Dadurch wird sichergestellt, dass der gesamte HTML-Inhalt geladen ist, bevor auf Elemente zugegriffen wird.

    // Definiert die URL, an die API-Anfragen gesendet werden.
    const apiUrl = "todo-api.php";

    // Eine GET-Anfrage wird an die angegebene API-URL gesendet, um die vorhandenen Todo-Elemente abzurufen.
    fetch(apiUrl)
    .then(response => response.json())
    // Wenn die Antwort empfangen und in JSON umgewandelt wurde, wird das folgende Block ausgeführt.
    .then(data => {
        // Holt die Liste, in der die Todos angezeigt werden sollen, aus dem DOM.
        const todoList = document.getElementById('todo-list');
        // Für jedes Element (item) im zurückgegebenen Array von Todos:
        data.forEach(item => {
            // Erstellt ein neues <li>-Element für jedes Todo.
            const li = document.createElement('li');
            // Setzt den Text des <li>-Elements auf den Titel des Todos.
            li.textContent = item.title;
            // Fügt das <li>-Element der Liste hinzu.
            todoList.appendChild(li);
        });
    });

    // Event-Listener für das Formular, der auf den "submit"-Event reagiert.
    document.getElementById('todo-form').addEventListener('submit', function(e) {
        // Verhindert den Standard-Submit-Event, um zu vermeiden, dass die Seite neu geladen wird.
        e.preventDefault();
        // Holt den aktuellen Wert aus dem Textfeld des Formulars (das neue Todo).
        const todoInput = document.getElementById('todo-input').value;

        // Sendet eine POST-Anfrage an die API mit dem neuen Todo-Daten als JSON-Body.
        fetch(apiUrl, {
            method: 'POST', // Definiert die Methode der Anfrage (POST für das Hinzufügen eines neuen Todos).
            headers: {
                'Content-Type': 'application/json' // Setzt den Header, um anzugeben, dass der Body im JSON-Format gesendet wird.
            },
            body: JSON.stringify({ title: todoInput }) // Der Body enthält das neue Todo als JSON-Objekt.
        })
        .then(response => response.json())
        // Wenn die Antwort empfangen und in JSON umgewandelt wurde, wird das folgende Block ausgeführt.
        .then(data => {
            // Holt die Liste, in der die Todos angezeigt werden sollen, aus dem DOM.
            const todoList = document.getElementById('todo-list');
            // Erstellt ein neues <li>-Element für das neue Todo.
            const li = document.createElement('li');
            // Setzt den Text des <li>-Elements auf den Titel des neuen Todos.
            li.textContent = data.title;
            // Fügt das <li>-Element der Liste hinzu.
            todoList.appendChild(li);
        });
    });

});
