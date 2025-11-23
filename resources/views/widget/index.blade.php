<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket Form Widget</title>
    <style>
        body {

            background: transparent;
            font-family: Arial,sans-serif;
        }
        .widget {
            max-width: 400px;
            border: 2px solid #212121;
            border-radius: 20px;
            padding: 15px;
        }
        .widget-field {
            display: flex;
            flex-direction: column;
        }
        .widget-field label {
            margin-bottom: 5px;
        }
        .widget-field input, .widget-field textarea {
            padding: 10px;
            border: 1px solid #000;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        .widget-field textarea {
            min-height: 100px;
        }

        .widget-btn {
            background: #fff;
            border-radius: 10px;
            padding: 7px 10px;
        }
        .widget-success {
            color: green;
            margin-bottom: 10px;
        }
        .widget-error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="widget">
    <div id="message-widget" class="message-widget" style="display:none"></div>
    <form id="widget-form">
        <div class="widget-field">
            <label>Имя</label>
            <input type="text" name="customer_name" id="customer_name">
        </div>
        <div class="widget-field">
            <label>Телефон</label>
            <input type="text" name="customer_phone" id="customer_phone">
        </div>
        <div class="widget-field">
            <label>Email (необязательно)</label>
            <input type="email" name="customer_email" id="customer_email">
        </div>
        <div class="widget-field">
            <label>Тема</label>
            <input type="text" name="subject"  id="subject">
        </div>
        <div class="widget-field">
            <label>Сообщение</label>
            <textarea name="text" id="text"></textarea>
        </div>

        <button type="submit" class="widget-btn">Отправить</button>

    </form>
    <script>
        let widgetForm = document.getElementById('widget-form');
        let widgetMess = document.getElementById('message-widget');

        document.addEventListener('submit', function (e) {
            e.preventDefault();

            fetch('/api/tickets', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    customer_name: document.getElementById('customer_name').value,
                    customer_email: document.getElementById('customer_email').value,
                    customer_phone: document.getElementById('customer_phone').value,
                    subject: document.getElementById('subject').value,
                    text: document.getElementById('text').value
                })
            })
                .then(response => response.json().then(data => ({ ok: response.ok, data })))
                .then(result => {
                    widgetMess.style.display = 'block';
                    if (!result.ok) {
                        widgetMess.classList.add('widget-error');
                        widgetMess.textContent = result.data.message || 'Ошибка при отправке формы';
                        return;
                    }
                    widgetMess.classList.remove('widget-error');
                    widgetMess.classList.add('widget-success');
                    widgetMess.textContent = 'Отправлено успешно!';
                    widgetForm.reset();
                })
                .catch(() => {
                    widgetMess.textContent = 'Ошибка. Попробуйте позже';
                });
        });
    </script>

</div>
</body>
</html>
